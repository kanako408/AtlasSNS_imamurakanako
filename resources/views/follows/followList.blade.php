<x-login-layout>
  <div class="container">
    <h1>フォローリスト</h1>
    <div class="user-icons">
      @foreach ($followings as $following)
      <a href="{{ route('profile', $following->id) }}">
        <img src="{{ $following->icon_url }}" alt="{{ $following->name }}" class="user-icon">
      </a>
      @endforeach
    </div>

    <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
      @csrf
      @if (auth()->user()->isFollowing($user))
      <button type="submit" class="btn btn-danger">フォロー解除</button>
      @else
      <button type="submit" class="btn btn-primary">フォローする</button>
      @endif
    </form>
  </div>
</x-login-layout>
