<x-logout-layout>
  <!-- 適切なURLを入力してください -->
  <!-- {!! Form::open(['url' => '〇〇']) !!} -->

  <!-- {!! Form::open(['url' => route('register')]) !!} -->
  <form method="POST" action="{{ route('register') }}">
    <!-- URLにフォームがPOSTされる -->
    @csrf
    <h2>新規ユーザー登録</h2>

    <label for="username">ユーザー名</label>
    <input type="text" name="username" class="input">

    <label for="email">メールアドレス</label>
    <input type="email" name="email" class="input">

    <label for="password">パスワード</label>
    <input type="password" name="password" class="input">

    <label for="password_confirmation">パスワード確認</label>
    <input type="password" name="password_confirmation" class="input">
    @error('password_confirmation')
    <div class="error">{{ $message }}</div>
    @enderror
    <button type="submit">登録</button>

    <p><a href="{{ route('login') }}">ログイン画面へ戻る</a></p>
  </form>

</x-logout-layout>
