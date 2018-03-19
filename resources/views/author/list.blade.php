@extends('layouts.content')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    @if (Auth::check())
        <div class="actions">
            <a class="btn btn-primary btn-sm" href="{{ route('author.add') }}">Add</a>
        </div>
    @endif
@endsection

@section('pagecontent')
    @unless(Auth::check())
        Please login to see a list of your authors.
    @else
        @empty( $authors->count() )
          <div class="no-authors information">
            <p>You do not currently have any authors listed. Please add some!</p>
          </div>
        @else
            <div class="row">
                <div class="col">
                    <ul class="list-inline">
                        <li><a href="{{ route('author.list') }}">All</a></li>
                        @foreach(range('A', 'Z') as $char)
                            <li><a href="{{ route('author.list', ['familyname' => $char])}}">{{ $char }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="authors">
                        <ul class="authors__list">
                            @foreach ($authors as $author)
                                <a href="{{ route('author', ['id' => $author->id]) }}">
                                    <li class="authors__list-item">
                                        <span class="author__firstname">{{ $author->firstname }}</span> <span class="author__familyname">{{ $author->familyname }}</span>
                                        @if( $author->getCombinedNames() != $author->getPreferredName() ) <span class="author__preferredname">({{ $author->getPreferredName() }})</span> @endif
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="text-center">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        @endempty
    @endunless
@endsection
