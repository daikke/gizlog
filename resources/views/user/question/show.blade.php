@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="" class="avatar-img">
      <p>{{ $question->user->name }}さんの質問&nbsp;&nbsp;({{ $question->tagCategory->name }})</p>
      <p class="question-date">{{ $question->created_at }}</p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ nl2br($question->content) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class="comment-list">
      @foreach ($question->comments as $comment)
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="{{ $comment->user->avatar }}" class="avatar-img">
            <p>{{ $comment->title }}</p>
            <p class="comment-date">{{ $comment->created_at }}</p>
          </div>
          <div class="comment-body">{{ nl2br($comment->content) }}</div>
        </div>
      @endforeach
    </div>
  <div class="comment-box">
    {!! Form::open(['route' => 'comment.store', 'method' => 'POST']) !!}
      <input name="user_id" type="hidden" value="{{ Auth::id() }}">
      <input name="question_id" type="hidden" value="{{ $question->id }}">
      <div class="comment-title">
        <img src="" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body">
        <textarea class="form-control" placeholder="Add your comment..." name="content" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
      </div>
      <div class="comment-bottom">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection