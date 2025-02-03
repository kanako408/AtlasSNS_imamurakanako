<x-login-layout>
  <!-- ユーザー情報 -->
  <div class="other-profile">
    <div><img src="{{ $user->getIconUrlAttribute()}}" alt="{{ $user->username }}" class="user-icon">
    </div>
    <div>
      <h1>ユーザー名 {{ $user->username }}</h1>
      <h1>自己紹介 {{ $user->bio }}</h1>
    </div>

    <!--ボタンを表示 -->
    <div>
      <form action="{{ route('follow.toggle', ['id' => $user->id]) }}" method="POST">
        @csrf
        @if(auth()->user()->isFollowing($user))
        <button type="submit" class="btn btn-danger">フォロー解除</button>
        @else
        <button type="submit" class="btn btn-primary">フォローする</button>
        @endif</button>
      </form>
    </div>
  </div>
  <!-- <div class="follow-button">
      @if (Auth::user()->follows()->where('followed_id', $user->id)->exists())
      <form action="{{ route('unfollow', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">フォロー解除</button>
      </form>
      @else
      <form action="{{ route('follow', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">フォローする</button>
      </form> -->
  @endif
  </div>

  <!-- 投稿一覧 -->
  <div class="post-list">
    @foreach ($posts as $post)
    <div class="post-item">
      <div class="post-item post-block">
        <!-- ユーザーアイコン -->
        <figure>
          <a href="{{ route('user-profile', $post->user->id) }}">
            <img src="{{ $post->user->getIconUrlAttribute() ?? asset('storage/icon1.png') }}"
              alt="{{ $post->user->username }}"
              class="user-icon"></a>
        </figure>

        <!-- 投稿一覧 -->
        <div class="post-content">
          <!-- ユーザー名 -->
          <div>
            <div class="post-name">{{ $post->user->username }}</div>
          </div>
          <!-- 投稿内容 -->
          <div>{{ $post->post }}</div>
        </div>
        <div>
          <div>{{ $post->created_at->format('Y-m-d H:i') }}</div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-login-layout>
