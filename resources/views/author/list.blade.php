@extends('page')

@section('content')
    <ul class="authors">
    @foreach ($authors as $author)
        <a href="/author/{{ $author->id }}">
            <li class="author">
                <span class="author__firstname">{{ $author->firstname }}</span> <span class="author__familyname">{{ $author->familyname }}</span> <span class="author__preferredname">({{ $author->getPreferredName() }})</span>
            </li>
        </a>
    @endforeach
@endsection
