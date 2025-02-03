<x-login-layout>

  <!-- <div class="container"> -->
  <div class="update">

    <!-- <h1>プロフィール編集</h1> -->
    <!-- 成功メッセージの表示 -->
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <!-- バリデーションエラーメッセージの表示 -->
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <!-- プロフィール編集フォームをカード状のコンテナで囲む -->
    <div class="profile-card">
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- ファイルを送信する機能がある場合にはフォームにenctype属性の設置も必要 -->
        <!-- ログインユーザーのアイコンを表示 -->
        <img src="{{ Auth::user()->getIconUrlAttribute() }}"
          alt="{{ Auth::user()->username }}"
          class="user-icon">


        {{-- ユーザー名 --}}
        <div class="form-group">
          <label for="username">ユーザー名</label>
          <input type="text" name="username" id="username" class="form-control" value="{{ old('username', Auth::user()->username) }}" required>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
        </div>


        {{-- パスワード --}}
        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>

        {{-- パスワード確認 --}}
        <div class="form-group">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        {{-- 自己紹介文 --}}
        <div class="form-group">
          <label for="bio">自己紹介文</label>
          <textarea name="bio" id="bio" class=".bio-textarea" maxlength="150">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        {{-- アイコン画像 --}}
        <div class="form-group">
          <label for="icon_image">アイコン画像</label>
          <input type="file" name="icon_image" id="icon_image" class="form-control">
          @if (Auth::user()->icon_image)
          <!-- <img src="{{ asset('storage/' . Auth::user()->icon_image) }}" alt="アイコン画像" class="img-thumbnail mt-2" width="150"> -->
          @endif
        </div>

        {{-- 更新ボタン --}}
        <button type="submit" class="btn btn-danger">更新</button>
      </form>
    </div>
  </div>
</x-login-layout>
