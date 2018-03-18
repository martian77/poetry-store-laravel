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
          <div>
            <ul class="authors">
            @foreach ($authors as $author)
                <a href="{{ route('author', ['id' => $author->id]) }}">
                    <li class="author">
                        <span class="author__firstname">{{ $author->firstname }}</span> <span class="author__familyname">{{ $author->familyname }}</span> <span class="author__preferredname">({{ $author->getPreferredName() }})</span>
                    </li>
                </a>
            @endforeach
          </div>
        @endempty
    @endunless
@endsection
