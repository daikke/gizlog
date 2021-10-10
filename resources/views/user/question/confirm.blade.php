@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ Auth::user()->name }}の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $request->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br($request->content) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    @if ($request->id === null)
      {{ Form::open(['route' => 'question.store']) }}
    @else
      {{ Form::open(['route' => ['question.update', $request->id], 'method' => 'PUT']) }}
    @endif
      @foreach ($request->only(['title', 'content']) as $key => $input)
        <input name="{{ $key }}" type="hidden" value="{{ $input }}">
      @endforeach
      @foreach ($request->tag_category_ids as $id)
        <input name="tag_category_ids[]" type="hidden" value="{{ $id }}">
      @endforeach
      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
    {!! Form::close() !!}
  </div>
</div>

@endsection