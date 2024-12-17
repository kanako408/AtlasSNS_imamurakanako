<x-login-layout>
  <div class="container">
    <h1>ユーザー検索</h1>
    <form action="{{ route('search') }}" method="GET" class="search-form">
      <!-- 検索後にフォームに入力した値を保持するための設定 -->
      <input type="text" name="search" value="{{ request('search') }}" placeholder="ユーザー名で検索">
      <button type="submit">
        <img src="{{ asset('images/search.png') }}" alt="検索">
      </button>
    </form>
    @if (request('search'))
    <p>検索ワード: "{{ request('search') }}"</p>
    @endif
    <div class="user-list">
      @foreach ($users as $user)
      <div class="user-item">
        <!-- ユーザーのアイコン -->
        <img src="{{ $user->getIconUrlAttribute() }}" alt="{{ $user->username }}" class="user-icon">
        <!-- ユーザー名 -->
        <p>{{ $user->username }}</p>
        <!--ボタンを表示 -->
        @if (auth()->user()->isFollowing($user))
        <form action="{{ route('follow.toggle', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="{{ auth()->user()->isFollowing($user) ? 'unfollow-button' : 'follow-button' }}">
            {{ auth()->user()->isFollowing($user) ? 'フォロー解除' : 'フォローする' }}
          </button></button>
        </form>
        @else
        <form action="{{ route('follow.toggle', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="{{ auth()->user()->isFollowing($user) ? 'unfollow-button' : 'follow-button' }}">
            {{ auth()->user()->isFollowing($user) ? 'フォロー解除' : 'フォローする' }}
          </button></button>
        </form>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</x-login-layout>
