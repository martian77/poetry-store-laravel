@extends('page')

@section('content')

    <ul class="poems">
        @foreach ( $poems as $poem )
            <a href="/poem/{{ $poem->id }}">
                <li class="poem">
                    <span class="poem__title">{{ $poem->title }}</span> - <span class="poem__author">{{ $poem->author }}</span>
                </li>
            </a>
        @endforeach
    </ul>
@endsection
