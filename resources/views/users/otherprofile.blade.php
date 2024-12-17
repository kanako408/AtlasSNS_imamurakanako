<x-login-layout>
  <div class="container">
    <!-- ユーザー情報 -->
    <div class="user-info">
      <img src="{{ $user->getIconUrlAttribute()}}" alt="{{ $user->username }}" class="user-icon">
      <h2>ユーザー名: {{ $user->username }}</h2>
      <p>自己紹介: {{ $user->bio }}</p>
    </div>

    <!-- フォローボタン -->
    <div class="follow-button">
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
      </form>
      @endif
    </div>

    <!-- 投稿一覧 -->
    <div class="post-list">
      @foreach ($posts as $post)
      <div class="post-item">
        <p><strong>投稿内容:</strong> {{ $post->content }}</p>
        <p><strong>投稿日:</strong> {{ $post->created_at->format('Y-m-d H:i') }}</p>
      </div>
      <hr>
      @endforeach
    </div>
  </div>
</x-login-layout>
