@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <div class="pagetitle">
                    @section('pagetitle')
                        <h1>{{ $pagetitle }}</h1>
                    @show
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <div class="pagecontent">
                    @section('pagecontent')
                        This is the master content section.
                    @show
                </div>
            </div>
        </div>
    </div>
@endsection
