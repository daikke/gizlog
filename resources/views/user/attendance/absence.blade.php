@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    <form action="{{ route('attendance.absence.store') }}" method="post">
      @csrf
      <div class="form-group @if ($errors->has('absence_reason')) has-error @endif">
        @if ($errors->has('absence_reason'))
          {{ $errors->first() }}
        @endif
        <textarea class="form-control" placeholder="欠席理由を入力してください。" name="absence_reason" cols="50" rows="10"></textarea>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="登録">
    </form>
  </div>
</div>

@endsection

