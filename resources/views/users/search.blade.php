<x-login-layout>
  <div class="container">
    <h1>ユーザー検索</h1>
    <form action="{{ route('search') }}" method="GET" class="search-form">
      <!-- value="{{ request('search') }}"検索後にフォームに入力した値を保持するための設定 -->
      <input type="text" name="search" value="{{ request('search') }}" placeholder="ユーザー名で検索">
      <button type="submit">
        <img src="{{ asset('images/search.png') }}" alt="検索">
      </button>
    </form>

    @if (request('search'))
    <p>検索ワード: "{{ request('search') }}"</p>
    @endif


    <div class="user-list">
      @foreach ($users as $user)
      <div class="user-item">
        <img src="{{ $user->icon_url }}" alt="{{ $user->name }}" class="user-icon">
        <p>{{ $user->name }}</p>
      </div>
      @endforeach
    </div>
  </div>

</x-login-layout>
