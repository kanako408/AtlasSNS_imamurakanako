<x-login-layout>
  <!-- ユーザー情報 -->
  <div class="other-profile">
    <div><img src="{{ $user->getIconUrlAttribute()?? asset('images/icon1.png')}}" alt="{{ $user->username }}" class="user-icon">
    </div>
    <!-- <div class="other-profile-item"> -->
    <div>
      <h1>ユーザー名</h1>
      <h1>自己紹介</h1>
    </div>
    <div>
      <h1>{{ $user->username }}</h1>
      <h1>{{ $user->bio }}</h1>
    </div>
    <!--ボタンを表示 -->
    <div>
      <form action="{{ route('follow.toggle', ['id' => $user->id]) }}" method="POST">
        @csrf
        @if(auth()->user()->isFollowing($user))
        <button type="submit" class="btn btn-danger">フォロー解除</button>
        @else
        <button type="submit" class="btn btn-primary">フォローする</button>
        @endif
      </form>
    </div>
  </div>



  <!-- 投稿一覧 -->
  <div class="post-list">
    @foreach ($posts as $post)
    <div class="post-item">
      <div class="post-item post-block">
        <!-- ユーザーアイコン -->
        <figure>
          <img src="{{ $user->getIconUrlAttribute()?? asset('images/icon1.png')}}" alt="{{ $user->username }}" class="user-icon">
          <!-- <a href="{{ route('user-profile', $post->user->id) }}">
            <img src="{{ $post->user->getIconUrlAttribute() ?? asset('storage/icon1.png') }}"
              alt="{{ $post->user->username }}"
              class="user-icon"></a> -->
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
