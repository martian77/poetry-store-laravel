@extends('layouts.content')

@section('pagecontent')
    @empty( $authors->count() )
        <div class="tag__no-authors">
            <p>No authors have been tagged with this.</p>
        </div>
    @else
        <div class="tag__authors subsection">
            <h3 class="subsection__title">Authors</h3>
            <ul class="authors">
                @foreach( $authors as $author )
                    <a href="{{ route('author', ['id' => $author->id]) }}">
                        <li class="author">
                            <span class="author__firstname">{{ $author->firstname }}</span> <span class="author__familyname">{{ $author->familyname }}</span> <span class="author__preferredname">({{ $author->preferredName }})</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    @endempty

    @empty( $poems->count() )
        <div class="tag__no-poems subsection">
            <p>No poems have been tagged with this.</p>
        </div>
    @else
        <div class="tag__poems subsection">
            <h3 class="subsection__title">Poems</h3>
            <ul class="poems">
                @foreach( $poems as $poem )
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
        </div>
    @endempty
@endsection
