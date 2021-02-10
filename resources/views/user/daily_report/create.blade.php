@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      <div class="form-group form-size-small @if ($errors->has('reporting_time')) has-error @endif">
        {!! Form::date('reporting_time', '', ['class' => 'form-control']) !!}
        @foreach ($errors->get('reporting_time') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        @foreach ($errors->get('title') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('contents')) has-error @endif">
        {!! Form::textarea('contents', '', ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        @foreach ($errors->get('contents') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <button type="submit" class="btn btn-success pull-right">Add</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection
