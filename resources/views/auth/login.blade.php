<x-logout-layout>

  <body>
    <div class="login-container">
      <!-- タイトル部分
      <h1>Atlas</h1>
      <h2>Social Network Service</h2> -->

      <!-- フォーム部分 -->
      <div class="login-form">
        <p>AtlasSNSへようこそ</p>
        <form method="POST" action="{{ route('login') }}">
          @csrf <!-- CSRFトークンの追加 -->

          <!-- メールアドレス入力 -->
          <label for="email">メールアドレス</label>
          <input type="text" name="email" id="email" placeholder="メールアドレスを入力" required>

          <!-- パスワード入力 -->
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password" placeholder="パスワードを入力" required>

          <!-- ログインボタン -->
          <button type="submit">ログイン</button>
        </form>
        <!-- 新規登録リンク -->
        <p><a href="{{ route('register') }}">新規ユーザーの方はこちら</a></p>
      </div>

    </div>
  </body>
</x-logout-layout>
