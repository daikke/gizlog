@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.store', 'method' => 'POST']) !!}
      <div class="form-group @if($errors->has('tag_category_id')) has-error @endif">
        {!!
          Form::select(
            'tag_category_id',
            $tagCategories,
            null,
            ['placeholder' => 'Select category', 'class' => 'form-control selectpicker form-size-small']
          );
        !!}
        @foreach ($errors->get('tag_category_id') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <div class="form-group @if($errors->has('title')) has-error @endif">
        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title']) !!}
        @foreach ($errors->get('title') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('content')) has-error @endif">
        {!! Form::textarea('content', '', ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        @foreach ($errors->get('content') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    {!! Form::close() !!}
  </div>
</div>

@endsection
