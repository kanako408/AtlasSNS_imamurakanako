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
    <form action="{{ route('follow.toggle', $following->id) }}" method="POST">
      @csrf
      @if (auth()->user()->isFollowing($user))
      <button type="submit" class="btn btn-danger">フォロー解除</button>
      @else
      <button type="submit" class="btn btn-primary">フォローする</button>
      @endif
    </form>
  </div>
</x-login-layout>
