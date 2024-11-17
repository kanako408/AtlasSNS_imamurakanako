<x-login-layout>

  @section('content')
  <div class="container">
    <div class="update">

      <h1>プロフィール編集</h1>
      @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

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

        {{-- 自己紹介文 --}}
        <div class="form-group">
          <label for="bio">自己紹介文</label>
          <textarea name="bio" id="bio" class="form-control" maxlength="150">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        {{-- パスワード --}}
        <div class="form-group">
          <label for="password">新しいパスワード</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>

        {{-- パスワード確認 --}}
        <div class="form-group">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        {{-- アイコン画像 --}}
        <div class="form-group">
          <label for="icon_image">アイコン画像</label>
          <input type="file" name="icon_image" id="icon_image" class="form-control">
          @if (Auth::user()->icon_image)
          <img src="{{ asset('storage/' . Auth::user()->icon_image) }}" alt="アイコン画像" class="img-thumbnail mt-2" width="150">
          @endif
        </div>

        {{-- 保存ボタン --}}
        <button type="submit" class="btn btn-primary">保存</button>
      </form>
    </div>
  </div>
  @endsection
</x-login-layout>
