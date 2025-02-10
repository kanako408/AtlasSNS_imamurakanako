<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>
    <div id="side-bar">
      <div id="confirm">
        <p>{{ Auth::user()->username }}さんの</p>
        <div>
          <!-- フォロー数表示 -->
          <div style="display: flex; align-items: center; gap: 50px;">
            <p>フォロー数</p>
            <p>{{ Auth::user()->followings()->count() }}名</p>
          </div>
          <div class="d-grid gap-2">
            <a href="{{ route('follows.followList') }}" class="btn btn-primary" role="button">フォローリスト</a>
          </div>
          <br>
          <!-- フォロワー数表示 -->
          <div style="display: flex; align-items: center; gap: 40px;">
            <p>フォロワー数</p>
            <p>{{ Auth::user()->followers()->count() }}名</p>
          </div>
          <div class="d-grid gap-2">
            <a href="{{ route('follower-list') }}" class="btn btn-primary" role="button">フォロワーリスト</a>
          </div>
          <br>
        </div>
      </div>
      <div class="divider"></div>
      <!-- </div> -->
      <div class="user-search">
        <a href="{{ route('search') }}" class="btn btn-primary">ユーザー検索</a>
      </div>

    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CDN経由で読み込む -->
</body>
<script src="{{ asset('js/script.js') }}"></script>
<!-- JavaScriptファイルのリンクを設置 -->

</html>
