@extends ('common.user')
@section ('content')

<h2 class="brand-header">修正申請</h2>
<div class="main-wrap">
  <div class="container">
    <form action="{{ route('modify.store') }}" method="POST">
      @csrf
      <div class="form-group form-size-small @if ($errors->has('registration_date')) has-error @endif">
        @if ($errors->has('registration_date'))
          {{ $errors->first('registration_date') }}
        @endif
        <input class="form-control" name="registration_date" type="date" value="{{ old('registration_date') }}">
      </div>
      <div class="form-group @if ($errors->has('reason')) has-error @endif">
        @if ($errors->has('reason'))
          {{ $errors->first('reason') }}
        @endif
        <textarea class="form-control" placeholder="修正申請の内容を入力してください。" name="reason" cols="50" rows="10">{{ old('reason') }}</textarea>
      </div>
      <input class="btn btn-success pull-right" type="submit" value="申請">
    </form>
  </div>
</div>

@endsection

