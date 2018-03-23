@extends('layouts.content')

@section('pagecontent')
    <div class="row">
        <div class="col">
            <ul class="list-inline">
                <li @if(!isset($params['index'])) class="active" @endif><a href="{{ route('admin.users', array_diff_key($params, ['index'=>'All'])) }}">All</a></li>
                @foreach(range('A', 'Z') as $char)
                    <li @if(isset($params['index']) && $params['index'] == $char) class="active" @endif><a href="{{ route('admin.users', array_merge($params, ['index' => $char])) }}">{{ $char }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @empty($users->count())
        <div class="no-users information">
            <p>You have no users added. Go for it!</p>
        </div>
    @else
        <div class="row">
            <div class="col">
                <div class="users">
                    <table class="table table-striped">
                        <tbody>
                            <thead>
                                <tr>
                                    <th><a href="{{ route('admin.users', array_merge($params, ['sortby' => 'name'])) }}">Name</a></th>
                                    <th><a href="{{ route('admin.users', array_merge($params, ['sortby' => 'authors'])) }}">Authors</a></th>
                                    <th><a href="{{ route('admin.users', array_merge($params, ['sortby' => 'poems'])) }}">Poems</a></th>
                                    <th><a href="{{ route('admin.users', array_merge($params, ['sortby' => 'created_at'])) }}">Date added</a></th>
                                </tr>
                            </thead>
                            @foreach ( $users as $user )
                                <tr>
                                    <td>
                                        <a href="{{ route('user', ['id' => $user->id])}}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->authors->count() }}
                                    </td>
                                    <td>
                                        {{ $user->poems->count() }}
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('j M Y, H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="text-center">
                    {{ $users->appends($params)->links() }}
                </div>
            </div>
        </div>
    @endempty
@endsection
