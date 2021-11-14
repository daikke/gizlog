@extends ('common.user')
@section ('content')

<h2 class="brand-header">マイページ</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>学習経過日数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ Auth::user()->avatar }}"></div>
        <p class="study-hour"><span>{{ $attendancesCount }}</span>日</p>
      </div>
    </div>
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ Auth::user()->avatar }}"></div>
        <p class="study-hour"><span>{{ $attendancesTime }}</span>時間</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-3">start time</th>
          <th class="col-xs-3">end time</th>
          <th class="col-xs-2">state</th>
          <th class="col-xs-2">request</th>
        </tr>
      </thead>
      <tbody>
        @foreach($attendances as $attendance)
          <tr class="row @if ($attendance->isAbsence()) absent-row @endif">
            <td class="col-xs-2">{{ $attendance->registration_date }}</td>
            <td class="col-xs-3">
              @if ($attendance->isAbsence())
                -
              @else
                {{ $attendance->start_time }}
              @endif
            </td>
            <td class="col-xs-2">
              @if ($attendance->isAbsence())
                -
              @else
                {{ $attendance->end_time }}
              @endif
            </td>
            <td class="col-xs-3">
              @if ($attendance->isAbsence())
                欠勤
              @elseif ($attendance->isAttendance())
                研修中
              @elseif ($attendance->isLeft())
                出社
              @endif
            </td>
            <td class="col-xs-2">
              @if ($attendance->hasModifyRequests())
                申請中
              @else
                -
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

