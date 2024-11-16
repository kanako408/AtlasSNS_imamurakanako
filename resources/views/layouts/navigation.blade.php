        <div id="head">
            <!-- トップページへのリンク設置 -->
            <h1><a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('images/atlas.png') }}"></a></h1>
            <div id="">
                <div id="">
                    <p>{{ Auth::user()->username }}さん</p>
                </div>
            </div>
            <!-- アコーディオンメニューの追加 -->
            <div class="accordion-menu">
                <button class="menu-toggle">
                    メニュー <span class="arrow">&#9660;</span>
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
        </div>
