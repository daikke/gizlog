@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {{--  TODO 日報検索機能  --}}
    <form>
      <input type="text" class="form-control">
      <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    </form>
    <a class="btn btn-icon" href=""><i class="fa fa-plus"></i></a>
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
        <tr class="row">
          <td class="col-xs-2"></td>
          <td class="col-xs-3"></td>
          <td class="col-xs-5"></td>
          <td class="col-xs-2"><a class="btn" href=""><i class="fa fa-book"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection
