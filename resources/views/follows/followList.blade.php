<x-login-layout>
  <div class="container">
    <h1>フォローリスト</h1>
    <div class="user-icons">
      @foreach ($followings as $following)
      <a href="{{ route('user-profile', $following->id) }}">
        <img src="{{ $following->icon_url }}" alt="{{ $following->name }}" class="user-icon">
      </a>
      @endforeach
    </div>
    <!-- フォローリストに表示されたユーザーに対してフォロー/フォロー解除 -->
    <form action="/follow/toggle/{{$following->id}}" method="POST">
      @csrf
      @if (auth()->user()->isFollowing($user))
      <button type="submit" class="btn btn-danger">フォロー解除</button>
      @else
      <button type="submit" class="btn btn-primary">フォローする</button>
      @endif
    </form>
    <h1>フォローしているユーザーの投稿</h1>

    @foreach ($posts as $post)
    <div class="post-item">
      <p>名前：{{ $post->user->username }}</p>
      <p>投稿内容：{{ $post->post }}</p>
      <p>投稿日時：{{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>
    <hr>
    @endforeach
  </div>
</x-login-layout>
