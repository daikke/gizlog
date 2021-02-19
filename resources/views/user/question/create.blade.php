@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.store', 'method' => 'POST']) !!}
      <div class="form-group">
        {!!
          Form::select(
            'tag_category_id',
            $tagCategories,
            null,
            ['placeholder' => 'Select category', 'class' => 'form-control selectpicker form-size-small']
          );
        !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', '', ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    {!! Form::close() !!}
  </div>
</div>

@endsection
