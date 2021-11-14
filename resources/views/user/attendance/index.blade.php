@extends ('common.user')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
    @switch($phase)
      @case(App\Services\AttendanceService::UNREGISTERED)
        <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
      @break
      @case(App\Services\AttendanceService::ATTENDANCE)
        <a class="button end-btn" id="register-attendance" href=#openModal>退社時間登録</a>
      @break
      @case(App\Services\AttendanceService::LEFT)
        <a class="button disabled" id="register-attendance" href=#openModal>退社済み</a>
      @break
      @case(App\Services\AttendanceService::ABSENCE)
        <a class="button disabled" id="register-attendance" href=#openModal>欠勤</a>
      @break
      @default
        深刻なエラーが発生しました。
    @endswitch
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('modify.create') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="{{ route('attendance.myPage') }}">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap"><p></p></div>
    <div class="register-btn-wrap">
      @switch($phase)
        @case(App\Services\AttendanceService::UNREGISTERED)
          <form action="{{ route('attendance.store') }}" method="post">
            <input id="time-target" name="start_time" type="hidden" value="">
        @break
        @case(App\Services\AttendanceService::ATTENDANCE)
          <form action="{{ route('attendance.updateTodayAttendance') }}" method="post">
            @method('PUT')
            <input id="time-target" name="end_time" type="hidden" value="">
        @break
        @default
          深刻なエラーが発生しました。
        @endswitch
        @csrf
        <input id="date-target" name="registration_date" type="hidden" value="">
        <a href="#close" class="cancel-btn">Cancel</a>
        <input class="yes-btn" type="submit" value="Yes">
      </form>
    </div>
  </div>
</div>

@endsection

