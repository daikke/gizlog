@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {{--  TODO 日報検索機能  --}}
    {!! Form::open(['route' => 'report.index', 'method' => 'GET']) !!}
      {!! Form::month('reporting_time', request()->get('reporting_time'), ['class' => 'form-control']) !!}
      <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    {!! Form::close() !!}
    <a class="btn btn-icon" href="{{ route('report.create') }}"><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reports as $report)
          <tr class="row">
            <td class="col-xs-2">{{ $report->reporting_time->format('m/d(D)') }}</td>
            <td class="col-xs-3">{{ Str::limit($report->title, 30) }}</td>
            <td class="col-xs-5">{{ Str::limit($report->contents, 50) }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('report.show', $report->id) }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  {{ $reports->appends(request()->query())->links() }}
  </div>
</div>

@endsection
