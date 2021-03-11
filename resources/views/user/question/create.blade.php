@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'POST']) !!}
      @include('user.question.components.select_category', compact('tagCategories', 'errors'))
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
