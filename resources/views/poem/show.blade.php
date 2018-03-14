@extends('page')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    <h2>by {{ $poem->author }}</h2>
@endsection

@section('content')
    <div class="poem">
        <div class="poem__body">
            {!! $poem->body !!}
        </div>
        @if (!empty($poem->sources))
            <div class="poem__sources">
                <ul>
                    @foreach($poem->sources as $source)
                        <a href="{{ $source }}">
                            <li>{{ $source }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
