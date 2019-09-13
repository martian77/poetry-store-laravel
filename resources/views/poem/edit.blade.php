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
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $poem->title) }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                    <label for="author" class="col-md-2 control-label">Author</label>

                    <div class="col-md-8">
                        <select id="author" class="form-control" name="author[]" multiple>
                            <option value="">Anonymous</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @if($poem->authors()->find($author->id)) selected @endif>{{ $author->preferredName }}</option>
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
                        <textarea id="body" class="form-control ckeditor" rows="20" name="body">{{ old('body', $poem->body) }}</textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('publicationDate') ? ' has-error' : '' }}">
                    <label for="publicationDate" class="col-md-2 control-label">Year of Publication</label>

                    <div class="col-md-8">
                        <input id="publicationDate" type="text" class="form-control" name="publicationDate" value="{{ old('publicationDate', $poem->publicationDate) }}" >

                        @if ($errors->has('publicationDate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('publicationDate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('copyright') ? ' has-error' : '' }}">
                    <label for="copyright" class="col-md-2 control-label">Copyright</label>

                    <div class="col-md-8">
                        <input id="copyright" type="text" class="form-control" name="copyright" value="{{ old('copyright', $poem->copyright) }}" >

                        @if ($errors->has('copyright'))
                            <span class="help-block">
                                <strong>{{ $errors->first('copyright') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('license') ? ' has-error' : '' }}">
                    <label for="license" class="col-md-2 control-label">License</label>

                    <div class="col-md-8">
                        <input id="license" type="text" class="form-control" name="license" value="{{ old('license', $poem->license) }}" >

                        @if ($errors->has('license'))
                            <span class="help-block">
                                <strong>{{ $errors->first('license') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                    <label for="tags" class="col-md-2 control-label">Tags</label>

                    <div class="col-md-8">
                        <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags', $poem->tagList) }}">
                        <small id="tags-help" class="form-text text-muted">Please separate your tags with a comma e.g. american, female.</small>
                        @if ($errors->has('tags'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <fieldset id="rating">
                    <label for="rating" class="control-label col-md-2">Rating</label>
                    <div class="col-md-2">
                        <input id="rating0" name="rating" type="radio" value="0" @if(0===old('rating', $poem->rating)) checked @endif >
                        <label for="rating0" class="control-label">Not rated</label>
                    </div>
                    @for ($i=1; $i<=5; $i++)
                        <div class="col-md-1">
                            <input id="rating{{ $i }}" name="rating" type="radio" value="{{$i}}" @if($i==old('rating', $poem->rating)) checked @endif >
                            <label for="rating{{ $i }}" class="control-label">{{ $i }}</label>
                        </div>
                    @endfor
                </fieldset>
                <item-sources v-bind:item-sources='@json($poem->sources)'></item-sources>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <button type="submit" class="btn btn-primary">
                            @empty($poem->id)
                                Add poem
                            @else
                                Update poem
                            @endempty
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footerScripts')
    <script src="{{ mix('js/editor.js') }}"></script>
@endsection
