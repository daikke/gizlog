@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      <div class="form-group form-size-small has-error">
        {!! Form::date('reporting_time', $report->reporting_time, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group has-error">
        {!! Form::text('title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group has-error">
        {!! Form::textarea('contents', $report->contents, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection
