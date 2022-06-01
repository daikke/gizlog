@extends ('common.admin')
@section ('content')

<h2 class="brand-header">書籍購入情報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    {!! Form::open(['route' => 'admin.book.csv-bulk-store', 'files' => true]) !!}
      <div class="form-group @if ($errors->has('csv')) has-error @endif">
        {!! Form::file('csv', ['class' => 'form-control']) !!}
        @foreach ($errors->get('csv') as $error)
          <span class="help-block">
            {{ $error }}
          </span>
        @endforeach
        @if(Session::has('message'))
          <span class="help-block">{{ session('message') }}</span>
        @endif
        <button type="submit" class="btn btn-icon"><i class="fa fa-file"></i></button>
      </div>
    {!! Form::close() !!}
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">購入者</th>
          <th class="col-xs-4">書籍タイトル</th>
          <th class="col-xs-2">著者</th>
          <th class="col-xs-2">出版社</th>
          <th class="col-xs-1">価格</th>
          <th class="col-xs-2">購入日</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
          <tr class="row">
            <td class="col-xs-1"><img src="{{ $book->user->avatar }}" class="avatar-img"></td>
            <td class="col-xs-4">{{ $book->title }}</td>
            <td class="col-xs-2">{{ $book->author }}</td>
            <td class="col-xs-2">{{ $book->publisher }}</td>
            <td class="col-xs-1">{{ $book->price }}</td>
            <td class="col-xs-2">{{ $book->purchase_date }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $books->links() }}
  </div>
</div>

@endsection
