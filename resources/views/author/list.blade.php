@extends('layouts.content')

@section('pagecontent')
    @unless(Auth::check())
        Please login to see a list of your authors.
    @else
        <ul class="authors">
        @foreach ($authors as $author)
            <a href="{{ route('author', ['id' => $author->id]) }}">
                <li class="author">
                    <span class="author__firstname">{{ $author->firstname }}</span> <span class="author__familyname">{{ $author->familyname }}</span> <span class="author__preferredname">({{ $author->getPreferredName() }})</span>
                </li>
            </a>
        @endforeach
    @endunless
@endsection
