<div class="form-group">
  <div class="form-group form-inline">
    @foreach ($tagCategories as $id => $tagCategory)
      <label class="checkbox-inline">
        {!! Form::checkbox('tag_category_id[]', $id) !!}
        {{ $tagCategory }}
      </label>
    @endforeach
  </div>
  <div class="has-error">
    <span class="help-block"></span>
  </div>
</div>