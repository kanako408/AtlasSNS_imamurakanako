<x-logout-layout>
  <!-- <div class="container">
    <div class="login-container">
      <p class="login-title">AtlasSNSへようこそ</p> -->
  <!-- <h2>AtlasSNSへようこそ</h2> -->
  <!-- 適切なURLを入力してください -->
  <!-- {!! Form::open(['url' => '〇〇']) !!} -->
  <!-- {!! Form::open(['url' => route('login')]) !!} -->
  <!-- URLにフォームがPOSTされる -->
  <!-- ログインフォーム -->

  <body>
    <header>
      <h1>AtlasSNSへようこそ</h1>
    </header>
    <div id="container">
      <form method="POST" action="{{ route('login') }}">
        @csrf <!-- CSRFトークンの追加 -->

        <!-- <p>AtlasSNSへようこそ</p> -->

        <!-- メールアドレス入力 -->
        <label for="email">メールアドレス</label>
        <input type="text" name="email" class="input" placeholder="メールアドレスを入力">

        <!-- パスワード入力 -->
        <label for="password">パスワード</label>
        <input type="password" name="password" class="input" placeholder="パスワードを入力">

        <!-- ログインボタン -->
        <button type="submit">ログイン</button>
      </form>
      <!-- 新規登録リンク -->
      <p><a href="{{ route('register') }}">新規ユーザーの方はこちら</a></p>

    </div>
  </body>
</x-logout-layout>
