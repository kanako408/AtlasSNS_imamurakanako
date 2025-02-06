        <div id="head" class="header-container">
            <!-- トップページへのリンク設置 -->
            <h1><a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('images/atlas.png') }}"></a></h1>
            <!-- ユーザー情報の表示 -->
            <!-- <div id=""> -->
            <div class="menu-group">
                <div class="user-info">
                    <p>{{ Auth::user()->username }}さん</p>
                </div>
                <!-- </div> -->

                <!-- アコーディオンメニューの追加 -->

                <div class="accordion-menu">
                    <button class="menu-toggle">
                        <span class="arrow">&#9660;</span>
                    </button>
                    <div class="menu-content">
                        <ul>
                            <li><a href="{{ route('index') }}">HOME</a></li>
                            <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-button">ログアウト</button>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- ログインユーザーのアイコンを表示 -->
                <!-- <img src="{{ Auth::user()->icon_path ?? '/path/to/default/icon.png' }}" alt="ユーザーアイコン" class="user-icon"> -->
                <img src="{{ Auth::user()->getIconUrlAttribute() }}"
                    alt="{{ Auth::user()->username }}"
                    class="user-icon">
            </div>
        </div>
