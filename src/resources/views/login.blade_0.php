@if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<p>ログイン画面</p>
<form method="POST" action="{{ route('login') }}">
  @csrf
  <div>
    <label for="email">メールアドレス</label>
    <input id="email" type="email" name="email">
  </div>
  <div>
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password">
  </div>
  <button type="submit">ログイン</button>
  <a href="{{ route('register') }}">ユーザー登録</a>
</form>