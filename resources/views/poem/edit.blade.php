@extends('layouts.content')

@section('pagecontent')
    <div class="panel panel-default">
        <div class="panel-heading">
            @empty($poem->id)
                New Poem
            @else
                Editing Poem '{{ $poem->title }}'
            @endempty
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('poem.store') }}">
                {{ csrf_field() }}
                <input name="poem_id" type="hidden" value="{{ empty($poem->id) ? 0 : $poem->id }}" >

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-2 control-label">Title</label>

                    <div class="col-md-8">
                        <input id="title" type="text" class="form-control" name="title" value="{{ !empty(old('title'))?old('title'):$poem->title }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                    <label for="author" class="col-md-2 control-label">First Name</label>

                    <div class="col-md-8">
                        <select id="author" class="form-control" name="author">
                            <option value="">Anonymous</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @if($poem->authors()->find($author->id)) selected @endif>{{ $author->getPreferredName() }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('author'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="body" class="col-md-2 control-label">Body</label>

                    <div class="col-md-8">
                        <textarea id="body" class="form-control" rows="20" name="body" required>
                            {{ !empty(old('body'))?old('body'):$poem->body }}
                        </textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
