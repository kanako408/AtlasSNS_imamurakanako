<x-login-layout>
  <div class="search">
    <form action="{{ route('search') }}" method="GET" class="search-form">
      <!-- 検索後にフォームに入力した値を保持するための設定 -->
      <input type="text" name="search" value="{{ request('search') }}" placeholder="ユーザー名">
      <button type="submit" class="search-button">
        <img src="{{ asset('images/search.png') }}" alt="検索">
      </button>
      @if (request('search'))
      <p>検索ワード: {{ request('search') }}</p>
      @endif
    </form>

  </div>

  <div class="user-list">
    @foreach ($users as $user)
    <div class="user-item">
      <!-- ユーザーのアイコン -->
      <img src="{{ $user->getIconUrlAttribute()?? asset('images/icon1.png') }}" alt="{{ $user->username }}" class="user-icon">
      <!-- ユーザー名 -->
      <p>{{ $user->username }}</p>
      <!--ボタンを表示 -->

      <form action="{{ route('follow.toggle', ['id' => $user->id]) }}" method="POST">
        @csrf
        @if(auth()->user()->isFollowing($user))
        <button type="submit" class="btn btn-danger">フォロー解除</button>
        @else
        <button type="submit" class="btn btn-primary">フォローする</button>
        @endif</button>
      </form>
    </div>
    @endforeach
  </div>
</x-login-layout>
