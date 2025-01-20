<x-logout-layout>

  <body>
    <div class="login-container">
      <div class="login-form">
        <div id="clear">
          <p><strong>{{ session('username') }}さん</strong></p>
          <p><strong>ようこそ！AtlasSNSへ！</strong></p>
          <br>
          <p>ユーザー登録が完了しました。</p>
          <p>早速ログインをしてみましょう。</p>

          <form action="{{ route('login') }}">
            <button type="submit">ログイン画面へ</button>
          </form>
          <!-- <p class="btn"><a href="login">ログイン画面へ</a></p> -->
        </div>
      </div>

    </div>
  </body>
</x-logout-layout>
