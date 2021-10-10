<div class="form-group">
  <div class="form-group form-inline">
    @foreach ($tagCategories as $id => $tagCategory)
      <label class="checkbox-inline">
        {!! Form::checkbox('tag_category_ids[]', $id) !!}
        {{ $tagCategory }}
      </label>
    @endforeach
  </div>
  <div class="has-error">
    @foreach ($errors->get('tag_category_ids') as $error)
      <span class="help-block">{{ $error }}</span>
    @endforeach
  </div>
</div>