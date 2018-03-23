@extends('layouts.content')

@section('pagetitle')
    @parent

    @if ($user->isAn('admin'))
        <h2>Admin</h2>
    @endif
    @can('edit', $user)
        <div class="actions">
            <a class="btn btn-primary btn-sm" href="{{ route('user.edit', ['id' => $user->id]) }}">Edit</a>
        </div>
    @endcan
@endsection

@section('pagecontent')
    Member since {{ $user->created_at->format('j M Y') }}.
@endsection
