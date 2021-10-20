@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問一覧</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'question.index', 'method' => 'GET', 'id' => 'question-search-form']) !!}
    <div class="btn-wrapper">
      <div class="search-box">
        <input class="form-control search-form" placeholder="Search words..." name="search_word" type="text" value={{ request()->search_word }}>
        <button type="submit" class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></button>
      </div>
      <a class="btn" href="{{ route('question.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
      <a class="btn" href="{{ route('question.mypage') }}">
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
      <a class="btn" href="{{ route('question.ranking.user_questions') }}">
        <i class="fa fa-trophy" aria-hidden="true"></i>
      </a>
    </div>
    <div class="category-wrap">
      <div class="btn all">all</div>
      @foreach ($tagCategories as $tagCategory)
        <div class="btn {{ $tagCategory->name }}" id="{{ $tagCategory->id }}">{{ $tagCategory->name }}</div>
      @endforeach
      <input id="category-val" name="tag_category_id" type="hidden" value="{{ request()->tag_category_id }}">
    </div>
  {!! Form::close() !!}
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">user</th>
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-1">comments</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr class="row">
            <td class="col-xs-1"><img src="{{ $question->user->avatar }}" class="avatar-img"></td>
            <td class="col-xs-2">{{ $question->tagCategories->implode('name', ' ') }}</td>
            <td class="col-xs-6">{{ $question->title }}</td>
            <td class="col-xs-1"><span class="point-color">{{ $question->comments->count() }}</span></td>
            <td class="col-xs-2">
              <a class="btn btn-success" href="{{ route('question.show', $question->id) }}">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $questions->appends(request()->query())->links() }}
  </div>
</div>

@endsection

