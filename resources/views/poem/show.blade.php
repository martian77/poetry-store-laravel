@extends('page')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    <h2>by
        @foreach($poem->authors()->get() as $author)
            <a href="{{ route('author', ['id' => $author->id])}}" >{{ $author->getPreferredName() }}@if (!$loop->last), @endif</a>
        @endforeach
    </h2>
@endsection

@section('content')
    <div class="poem">
        <div class="poem__body">
            {!! $poem->body !!}
        </div>
        <div class="poem__copyright-licensing">
            @if (! empty($poem->publishedDate) )
                <div class="poem__published"><span class="detail__label">Published: </span><span class="detail__data">{{ $poem->publishedDate }}</span></div>
            @endif
            @if (! empty($poem->copyright))
                <div class="poem__copyright"><span class="detail__data">{{ $poem->copyright }}</span></div>
            @endif
            @if (! empty($poem->license))
                <div class="poem__license"><span class="detail__data">{{ $poem->license }}</span></div>
            @endif
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
