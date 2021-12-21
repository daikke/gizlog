@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      <div class="form-group form-size-small @if ($errors->has('reporting_time')) has-error @endif">
        {!! Form::date('reporting_time', $report->reporting_time, ['class' => 'form-control']) !!}
        <input type="date" class="form-control"  value="2021-08-10">
        @foreach ($errors->get('reporting_time') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::text('title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        @foreach ($errors->get('title') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <div class="form-group @if ($errors->has('contents')) has-error @endif">
        {!! Form::textarea('contents', $report->contents, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        @foreach ($errors->get('contents') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection
