@extends('layouts.content')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    @if (Auth::check())
        <div class="actions">
            <a class="btn btn-primary btn-sm" href="{{ route('poem.add') }}">Add</a>
        </div>
    @endif
@endsection

@section('pagecontent')
    @unless(Auth::check())
        Please login to see a list of your poems.
    @else
        @empty($poems->count())
            <div class="no-poems information">
                <p>You have no poems added. Go for it!</p>
            </div>
        @else
            <div class="row">
                <div class="col">
                    <div class="poems">
                        <table class="table table-striped">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th><a href="{{ route('poem.list', array_merge($params, ['sortby' => 'title'])) }}">Title</a></th>
                                        <th>Authors</th>
                                        <th><a href="{{ route('poem.list', array_merge($params, ['sortby' => 'rating'])) }}">Rating</a></th>
                                        <th><a href="{{ route('poem.list', array_merge($params, ['sortby' => 'created_at'])) }}">Date added</a></th>
                                    </tr>
                                </thead>
                                @foreach ( $poems as $poem )
                                    <tr>
                                        <td>
                                            <a href="{{ route('poem', ['id' => $poem->id]) }}">
                                                {{ $poem->title }}
                                            </a>
                                        </td>
                                        <td>
                                            @if (! empty($poem->authors()->get()))
                                                @foreach ($poem->authors()->get() as $author)
                                                    <a href="{{ route('author', ['id' => $author->id])}}" >{{ $author->preferredName }}@if (!$loop->last), @endif</a>
                                                @endforeach
                                            @else
                                                Anon
                                            @endif
                                        </td>
                                        <td>
                                            @empty($poem->rating)
                                                -
                                            @else
                                                {{ $poem->rating }}
                                            @endempty
                                        </td>
                                        <td>
                                            {{ $poem->created_at->format('j M Y, H:i') }}
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
                        {{ $poems->appends($params)->links() }}
                    </div>
                </div>
            </div>
        @endempty
    @endunless
@endsection
