@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['question.update', $question->id], 'method' => 'PUT']) }}
      <div class="form-group">
        {!! Form::select('tag_category_id', $tagCategories, $question->tag_category_id, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::text('title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {{ Form::close() }}
  </div>
</div>

@endsection

