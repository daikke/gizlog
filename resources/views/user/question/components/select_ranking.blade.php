<div>
  <select name="select_rank_type" id="ranking_area" class="form-control">
    <option value="{{ route('question.ranking.user_questions') }}" @if ($request->routeIs('question.ranking.user_questions')) selected @endif>質問数が多いユーザー</option>
    <option value="{{ route('question.ranking.user_comments') }}" @if ($request->routeIs('ranking.user_comments')) selected @endif>コメント数が多いユーザー</option>
    <option value="{{ route('question.ranking.category_questions') }}" @if ($request->routeIs('ranking.category_questions')) selected @endif>質問数が多いタグ</option>
  </select>
</div>
