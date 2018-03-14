@extends('page')

@section('pagetitle')
    <h1>{{ $author->getPreferredName() }}</h1>
    @if ( $author->getPreferredName() != $author->getCombinedNames() )
        <h2>({{ $author->getCombinedNames() }})</h2>
    @endif
@endsection

@section('content')
    <div class="author">
        <div class="author__details">
            <li class="author__detail"><span class="detail__label">Born: </span><span class="detail__data">{{ $author->birthdate }}</span></li>
            <li class="author__detail"><span class="detail__label">Died: </span><span class="detail__data">{{ $author->deathdate }}</span></li>
        </div>
        <div class="author__links">
            <h3>Relevant links</h3>
            <ul>
                @foreach ($author->links as $link)
                    <a href="{{ $link }}">
                        <li class="author__link">{{ $link }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
