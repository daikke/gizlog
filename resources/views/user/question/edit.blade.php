@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['question.confirm', $question->id], 'method' => 'POST']) }}
      <div class="form-group  @if($errors->has('tag_category_id')) has-error @endif">
        {!! Form::select('tag_category_id', $tagCategories, $question->tag_category_id, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        @foreach ($errors->get('tag_category_id') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <div class="form-group @if($errors->has('title')) has-error @endif">
        {!! Form::text('title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        @foreach ($errors->get('title') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('content')) has-error @endif">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        @foreach ($errors->get('content') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {{ Form::close() }}
  </div>
</div>

@endsection

