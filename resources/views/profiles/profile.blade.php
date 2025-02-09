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
    <div class="profile-list">
      <!-- <div class="update-item"> -->
      <!-- ログインユーザーのアイコン -->
      <img src="{{ Auth::user()->getIconUrlAttribute()?? asset('images/icon1.png')  }}"
        alt="{{ Auth::user()->username }}"
        class="update-user-icon">

      <!-- ファイルを送信する機能がある場合にはフォームにenctype属性の設置も必要 -->
      <!-- プロフィール編集フォーム -->
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf


        {{-- ユーザー名 --}}
        <div class="update-form-group">
          <label for="username">ユーザー名</label>
          <input type="text" name="username" id="username" class="form-control" value="{{ old('username', Auth::user()->username) }}" required>
        </div>



        {{-- メールアドレス --}}
        <div class="update-form-group">
          <label for="email">メールアドレス</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
        </div>


        {{-- パスワード --}}
        <div class="update-form-group">
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>

        {{-- パスワード確認 --}}
        <div class="update-form-group">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        {{-- 自己紹介文 --}}
        <div class="update-form-group">
          <label for="bio">自己紹介文</label>
          <textarea name="bio" id="bio" class=".bio-textarea" maxlength="150">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        {{-- アイコン画像 --}}
        <div class="update-form-group">
          <label>アイコン画像</label>
          <input type="file" name="icon_image" id="icon_image" class="form-control hidden-input">
          <!-- <input type="file" name="icon_image" id="icon_image" class="form-control"> -->
          <label for="icon_image" class="custom-file-label">
            <p>ファイルを選択</p>
          </label>

          @if (Auth::user()->icon_image)
          <img src="{{ asset('storage/' . Auth::user()->icon_image) }}" alt="アイコン画像" class="img-thumbnail mt-2 hide-img" width="150">
          @endif
        </div>

        {{-- 更新ボタン --}}
        <button type="submit" class="profile-list-btn-danger">更新</button>
      </form>
    </div>
  </div>
</x-login-layout>
