<div class="form-group">
  @foreach ($tagCategories as $id => $tagCategory)
    <label class="checkbox-inline">
      {!! Form::checkbox('tag_category_ids[]', $id, $question->tagCategories->pluck('id')->search($id) !== false) !!}
      {{ $tagCategory }}
    </label>
  @endforeach
  <div>
    @foreach ($errors->get('tag_category_ids') as $error)
      <span class="help-block">{{ $error }}</span>
    @endforeach
  </div>
</div>
