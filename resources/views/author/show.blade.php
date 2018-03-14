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
        @if (!empty($author->links))
            <div class="subsection author__links">
                <h3 class="subsection__title">Relevant links</h3>
                <ul>
                    @foreach ($author->links as $link)
                        <a href="{{ $link }}">
                            <li class="author__link">{{ $link }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (!empty($author->poems()->get()))
            <div class="subsection author__poems">
                <h3 class="subsection__title">Poems</h3>
                <ul>
                    @foreach($author->poems()->get() as $poem)
                        <a href="{{ route('poem', ['id' => $poem->id])}}" >
                            <li class="poem__link">
                                {{ $poem->title }}
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
