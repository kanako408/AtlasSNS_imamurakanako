<x-login-layout>

  <div class="container">
    <!-- ① フォロワーのアイコン一覧 -->
    <h1>フォロワーリスト</h1>
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

    <hr>

    <!-- ② フォロワーの投稿一覧 -->
    <div class="post-list">
      @foreach ($posts as $post)
      <div class="post-item">
        <!-- ユーザーアイコン（プロフィールページへのリンク） -->
        <a href="{{ route('user-profile', $post->user->id) }}">
          <img src="{{ $post->user->getIconUrlAttribute() ?? asset('storage/icon1.png') }}"
            alt="{{ $post->user->username }}"
            class="user-icon">
        </a>

        <!-- ユーザー名 -->
        <p>{{ $post->user->username }}</p>

        <!-- 投稿内容 -->
        <p>{{ $post->post }}</p>

        <!-- 投稿日時 -->
        <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
      </div>
      <hr>
      @endforeach
    </div>
  </div>

</x-login-layout>
