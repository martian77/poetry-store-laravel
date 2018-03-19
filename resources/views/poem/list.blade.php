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
            <ul class="poems">
                @foreach ( $poems as $poem )
                    <a href="{{ route('poem', ['id' => $poem->id]) }}">
                        <li class="poem">
                            <span class="poem__title">{{ $poem->title }}</span> -
                            @if (! empty($poem->authors()->get()))
                                @foreach ($poem->authors()->get() as $author)
                                    {{ $author->preferredName }}@if (!$loop->last), @endif
                                @endforeach
                            @else
                                Anon
                            @endif
                        </li>
                    </a>
                @endforeach
            </ul>
        @endempty
    @endunless
@endsection
