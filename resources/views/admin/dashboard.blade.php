@extends('layouts.content')

@section('pagecontent')
    <div class="row">
        <div class="col">
            <ul class="admin-functions">
                <li class="admin-function"><a href="/admin/users">User management</a></li>
                <li class="admin-function"><a href="/admin/roles">Roles</a></li>
            </ul>
        </div>
    </div>
@endsection
