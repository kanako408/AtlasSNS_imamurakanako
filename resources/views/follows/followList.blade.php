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

  </div>

</x-login-layout>
