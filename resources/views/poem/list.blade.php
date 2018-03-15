@extends('layouts.content')

@section('pagecontent')
    @unless(Auth::check())
        Please login to see a list of your authors.
    @else
        <ul class="poems">
            @foreach ( $poems as $poem )
                <a href="/poem/{{ $poem->id }}">
                    <li class="poem">
                        <span class="poem__title">{{ $poem->title }}</span> -
                        @if (! empty($poem->authors()->get()))
                            @foreach ($poem->authors()->get() as $author)
                                {{ $author->getPreferredName() }}@if (!$loop->last), @endif
                            @endforeach
                        @else
                            Anon
                        @endif
                    </li>
                </a>
            @endforeach
        </ul>
    @endunless
@endsection
