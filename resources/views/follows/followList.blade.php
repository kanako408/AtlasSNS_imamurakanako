<x-login-layout>


  <div class="container">
    <h1>フォローリスト</h1>

    <!-- フォローしているユーザーをアイコンで表示 -->
    <div class="follow-icons">
      @foreach ($followings as $following)
      <a href="{{ route('user-profile', $following->id) }}">
        <img src="{{ $following->icon_url }}" alt="{{ $following->username }}" class="user-icon">
      </a>
      @endforeach
    </div>

    <!-- フォローしているユーザーの投稿一覧 -->
    <div class="post-list">
      @foreach ($posts as $post)
      <div class="post-item">
        <p>名前：{{ $post->user->username }}</p>
        <p>投稿内容：{{ $post->post }}</p>
        <p>投稿日時：{{ $post->created_at->format('Y-m-d H:i') }}</p>
      </div>
      <hr>
      @endforeach
    </div>
  </div>

</x-login-layout>
