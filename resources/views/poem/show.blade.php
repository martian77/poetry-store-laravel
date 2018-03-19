@extends('layouts.content')

@section('pagetitle')
    <h1>{{ $pagetitle }}</h1>
    <h2>by
        @empty($poem->authors()->count())
            Anonymous
        @else
            @foreach($poem->authors()->get() as $author)
                <a href="{{ route('author', ['id' => $author->id])}}" >{{ $author->getPreferredName() }}@if (!$loop->last), @endif</a>
            @endforeach
        @endempty
    </h2>
    @if (Auth::id() == $poem->user->id)
        <div class="actions">
            <a class="btn btn-primary btn-sm" href="{{ route('poem.edit', ['id' => $poem->id]) }}">Edit</a>
        </div>
    @endif
@endsection

@section('pagecontent')
    @unless (Auth::id() == $poem->user->id)
        <div class="message__blocked">Unfortunately, this isn't your poem to view. Try searching online and adding it.</div>
    @else
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
            <div class="rating">
                Rating: @empty($poem->rating) Not rated @else {{ $poem->rating }} @endempty
            </div>
            @if (!empty($poem->sources()->count()))
                <div class="subsection poem__sources">
                    <h3 class="subsection__title">Sources</h3>
                    <ul>
                        @each('source.show', $poem->sources()->get(), 'source')
                    </ul>
                </div>
            @endif
            @if (! empty($poem->tags->count()) )
                <div class="subsection poem__tags">
                    Tags:
                    @foreach ( $poem->tags as $tag )
                        <a href="{{ route('tag', ['normalised' => urlencode($tag->normalized)]) }}">{{ $tag->name }}</a>@if (!$loop->last), @endif</a>
                    @endforeach
                </div>
            @endif
        </div>
    @endunless
@endsection
