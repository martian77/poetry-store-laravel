<input type="hidden" name="sourceId{{ $counter}}" value="{{ $source->id }}">
<div class="form-group{{ $errors->has('sourceType' . $counter) ? ' has-error' : '' }}">
    <label for="sourceType{{ $counter }}" class="col-md-2 control-label">Source type</label>

    <div class="col-md-8">
        <select id="sourceType{{ $counter }}" type="text" class="form-control" name="sourceType{{ $counter }}">
            <option value="link" @if( (!empty(old('sourceType' . $counter)) && 'link' == old('sourceType' . $counter )) || 'link' == $source->sourceType) selected @endif >Link</option>
            <option value="book" @if( (!empty(old('sourceType' . $counter)) && 'book' == old('sourceType' . $counter )) || 'book' == $source->sourceType) selected @endif >Book</option>
         </select>
        @if ($errors->has('sourceType' . $counter))
            <span class="help-block">
                <strong>{{ $errors->first('sourceType' . $counter) }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('sourceDescription' . $counter) ? ' has-error' : '' }}">
    <label for="sourceDescription{{ $counter }}" class="col-md-2 control-label">
        Detail
    </label>

    <div class="col-md-8">
        <input id="sourceDescription{{ $counter }}" type="text" class="form-control" name="sourceDescription{{ $counter }}" value="{{ !empty(old('sourceDescription' . $counter))?old('sourceDescription' . $counter):$source->description }}" >

        @if ($errors->has('sourceDescription' . $counter))
            <span class="help-block">
                <strong>{{ $errors->first('sourceDescription' . $counter) }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('sourceLink' . $counter) ? ' has-error' : '' }}">
    <label for="sourceLink{{ $counter }}" class="col-md-2 control-label">Link</label>

    <div class="col-md-8">
        <input id="sourceLink{{ $counter }}" type="text" class="form-control" name="sourceLink{{ $counter }}" value="{{ !empty(old('sourceLink' . $counter))?old('sourceLink' . $counter):$source->link }}" >

        @if ($errors->has('sourceLink' . $counter))
            <span class="help-block">
                <strong>{{ $errors->first('sourceLink'.$counter) }}</strong>
            </span>
        @endif
    </div>
</div>
