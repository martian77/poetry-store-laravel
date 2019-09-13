@extends('layouts.content')

@section('pagecontent')
    <div class="panel panel-default">
        <div class="panel-heading">
            @empty($author->id)
                New Author
            @else
                Editing Author {{ $author->preferredName }}
            @endempty
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('author.store') }}">
                {{ csrf_field() }}
                <input name="author_id" type="hidden" value="{{ empty($author->id) ? 0 : $author->id }}" >

                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label for="firstname" class="col-md-2 control-label">First Name</label>

                    <div class="col-md-8">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $author->firstname) }}" required autofocus>

                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('familyname') ? ' has-error' : '' }}">
                    <label for="familyname" class="col-md-2 control-label">Family Name</label>

                    <div class="col-md-8">
                        <input id="familyname" type="text" class="form-control" name="familyname" value="{{ old('familyname', $author->familyname) }}" required>

                        @if ($errors->has('familyname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('familyname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('preferredName') ? ' has-error' : '' }}">
                    <label for="preferredName" class="col-md-2 control-label">Preferred Name</label>

                    <div class="col-md-8">
                        <input id="preferredName" type="text" class="form-control" name="preferredName" value="{{ old('preferredName', $author->preferredName) }}">

                        @if ($errors->has('preferredName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('preferredName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                    <label for="birthdate" class="col-md-2 control-label">Date of Birth</label>

                    <div class="col-md-8">
                        <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $author->birthdate) }}">

                        @if ($errors->has('birthdate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('deathdate') ? ' has-error' : '' }}">
                    <label for="deathdate" class="col-md-2 control-label">Date of Death</label>

                    <div class="col-md-8">
                        <input id="deathdate" type="date" class="form-control" name="deathdate" value="{{ old('deathdate', $author->deathdate) }}">

                        @if ($errors->has('deathdate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deathdate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    <label for="notes" class="col-md-2 control-label">Notes</label>

                    <div class="col-md-8">
                        <textarea id="notes" class="form-control ckeditor" rows="20" name="notes">{{ old('notes', $author->notes) }}</textarea>

                        @if ($errors->has('notes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('notes') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                    <label for="tags" class="col-md-2 control-label">Tags</label>

                    <div class="col-md-8">
                        <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags', $author->tagList) }}">
                        <small id="tags-help" class="form-text text-muted">Please separate your tags with a comma e.g. american, female.</small>
                        @if ($errors->has('tags'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <item-sources v-bind:item-sources='@json($author->sources)'></item-sources>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            @empty($author->id)
                                Add author
                            @else
                                Update author
                            @endempty
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script src="{{ url(mix('js/editor.js')) }}"></script>
@endsection
