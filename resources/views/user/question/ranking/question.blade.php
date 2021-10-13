@extends ('common.user')
@section ('content')

<h2 class="brand-header">ランキング&nbsp;「質問数が多いユーザー」</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    @include('user.question.components.select_ranking', ['request' => request()])
    <table class="table table-striped">
      <thead>
        <tr class="rows">
          <th class="col-xs-1">Rank</th>
          <td class="col-xs-1"></td>
          <th class="col-xs-2">User</th>
          <th class="col-xs-4">Question Count</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rankings as $rank)
          <tr class="rows">
            <td class="col-xs-1">{{ $rank->rank }}</td>
            <td class="col-xs-1"><img src="{!! $rank->avatar !!}" class="avatar-img"></td>
            <td class="col-xs-2">{{ $rank->name }}</td>
            <td class="col-xs-4">{{ $rank->questions_count }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center">
      {{ $rankings->links() }}
    </div>
  </div>
</div>

@endsection
