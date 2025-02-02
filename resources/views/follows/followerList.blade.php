<x-login-layout>

  <!-- ① フォロワーのアイコン一覧 -->
  <div class="follow">
    <h1>フォロワーリスト</h1>

    <!-- フォローされているユーザーをアイコンで表示 -->
    <div class="follow-icons">
      @foreach ($followers as $follower)
      <!-- プロフィールページへ遷移するリンク -->
      <a href="{{ route('user-profile', $follower->id) }}">
        <img src="{{ $follower->getIconUrlAttribute() ?? asset('storage/icon1.png') }}"
          alt="{{ $follower->username }}"
          class="user-icon">
      </a>
      @endforeach
    </div>
  </div>

  <!-- ② フォロワーの投稿一覧 -->
  <div class="post-list">
    @foreach ($posts as $post)
    <div class="post-item">
      <div class="post-item post-block">
        <!-- ユーザーアイコン（プロフィールページへのリンク） -->
        <figure>
          <a href="{{ route('user-profile', $post->user->id) }}">
            <img src="{{ $post->user->getIconUrlAttribute() ?? asset('storage/icon1.png') }}"
              alt="{{ $post->user->username }}"
              class="user-icon">
          </a>
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
