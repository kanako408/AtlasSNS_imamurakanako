<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  <!-- {!! Form::open(['url' => '〇〇']) !!} -->
   <!-- {!! Form::open(['url' => route('login')]) !!} -->
  <!-- URLにフォームがPOSTされる -->
  <form method="POST" action="{{ route('login') }}">
    @csrf <!-- CSRFトークンの追加 -->

   <p>AtlasSNSへようこそ</p>

   <label for="email">メールアドレス</label>
    <input type="text" name="email" class="input">

    <label for="password">パスワード</label>
    <input type="password" name="password" class="input">

    <button type="submit">ログイン</button>

    <p><a href="{{ route('register') }}">新規ユーザーの方はこちら</a></p>
  </form>
</x-logout-layout>
