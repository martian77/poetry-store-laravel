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
        <div class="row">
            <div class="col">
                <ul class="list-inline">
                    <li @if(!isset($params['index'])) class="active" @endif><a href="{{ route('author.list') }}">All</a></li>
                    @foreach(range('A', 'Z') as $char)
                        <li @if(isset($params['index']) && $params['index'] == $char) class="active" @endif><a href="{{ route('author.list', array_merge($params, ['index' => $char])) }}">{{ $char }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @empty( $authors->count() )
            <div class="row">
                <div class="col">
                    <div class="no-authors information">
                        <p>You do not currently have any authors listed. Please add some!</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col">
                    <div class="authors">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><a href="{{ route('author.list', array_merge($params, ['sortby' => 'name'])) }}" >Name</a></th>
                                    <th><a href="{{ route('author.list', array_merge($params, ['sortby' => 'poems'])) }}" >Total poems</a></th>
                                    <th>Average rating</th>
                                    <th><a href="{{ route('author.list', array_merge($params, ['sortby' => 'created_at'])) }}" >Added</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td class="author__name">
                                            <a href="{{ route('author', ['id' => $author->id]) }}">
                                                {{ $author->firstname }} {{ $author->familyname }}
                                                @if( $author->getCombinedNames() != $author->preferredName )
                                                    ({{ $author->preferredName }})
                                                @endif
                                            </a>
                                        </td>
                                        <td class="author__poems-count">
                                            {{ $author->poems()->count() }}
                                        </td>
                                        <td class="author__average-rating">
                                            {{ $author->getAveragePoemRating() }}
                                        </td>
                                        <td class="author__created-on">
                                            {{ $author->created_at->format('j M Y, H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
