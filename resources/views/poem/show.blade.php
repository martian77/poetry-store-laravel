@extends('page')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    <h2>by {{ $poem['author'] }}</h2>
@endsection

@section('content')
    <div class="poem">
        <div class="poem__body">
            @foreach ($poem['lines'] as $line)
                {{ $line }}<br />
            @endforeach
        </div>
        <div class="poem__sources">
            <ul>
                @foreach($poem['sources'] as $source)
                    <a href="{{ $source }}">
                        <li>{{ $source }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
