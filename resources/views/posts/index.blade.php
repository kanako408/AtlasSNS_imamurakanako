<x-login-layout>

    <!-- バリデーションエラーメッセージの表示 -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- 投稿フォーム -->

    <div class="post-form">
        <!-- ログインユーザーのアイコンを表示 -->
        <!-- <img src="{{ Auth::user()->icon_path ?? '/path/to/default/icon.png' }}" alt="ユーザーアイコン" class="user-icon"> -->
        <div><img src="{{ Auth::user()->getIconUrlAttribute() ?? asset('images/icon1.png')}}"
                alt="{{ Auth::user()->username }}"
                class="user-icon"></div>
        <!-- 投稿フォーム -->
        <div>
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <!-- <label for="content">投稿内容</label> -->
                    <textarea name="content" id="content" rows="3" class="form-control" placeholder="投稿内容を入力してください" required></textarea>
                </div>

        </div>

        <!-- 投稿ボタン（画像） -->
        <div class="post-action"><button type="submit" class="post-button">
                <img src="/images/post.png" alt="投稿" class="post-image">
            </button>
            </form>
        </div>
    </div>

    <!-- <div class="divider"></div> -->

    <div class="post-list">
        @foreach($posts as $post)
        <div class="post-item">
            <div class="post-item post-block">
                <!-- ユーザーアイコン -->
                <figure>
                    <img src="{{ $post->user->getIconUrlAttribute() ?? asset('images/icon1.png') }}"
                        alt="{{ $post->user->username }}"
                        class="user-icon">
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
                    <!-- 投稿編集ボタン（自分の投稿のみ表示） -->
                    @if($post->user_id === Auth::id())
                    <button type="button" class="edit-button js-modal-open" href="#" post="{{ $post->post }}" post_id="{{ $post->id }}">
                        <img src="/images/edit.png" alt="編集" onmouseover="this.src='/images/edit_h.png'" onmouseout="this.src='/images/edit.png'">
                    </button>
                    @endif
                    <!-- 投稿削除ボタン（自分の投稿のみ表示） -->
                    @if($post->user_id === Auth::id())
                    <button type="button" class="delete-button js-delete-modal-open" data-post-id="{{ $post->id }}">
                        <img src="/images/trash.png" alt="削除" onmouseover="this.src='/images/trash-h.png'" onmouseout="this.src='/images/trash.png'">
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <!-- 編集モーダルの中身 -->
        <div class="modal js-modal">
            <div class="modal__bg js-modal-close"></div>
            <div class="modal__content">
                <form action="{{ route('update') }}" method="POST">
                    <textarea name="upPost" class="modal_post" value=""></textarea>
                    <input type="hidden" name="Id" class="modal_id" value="">
                    <button type="submit">
                        <img src="/images/edit.png" alt="更新ボタン">
                    </button>
                    {{ csrf_field() }}
                </form>
                <!-- <a class="js-modal-close" href="">閉じる</a> -->
            </div>
        </div>



        <!-- 削除確認モーダル -->
        <div class="modal js-delete-modal">
            <div class="delete-modal__bg js-delete-modal-close"></div>
            <div class="delete-modal__content">
                <p>この投稿を削除します。よろしいですか。</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div>
                        <button type="submit" class="btn btn-primary js-delete-confirm">ＯＫ</button>
                </form>
                <button type="button" class="js-delete-modal-close">キャンセル</button>
            </div>
        </div>
    </div>
    </div>
    <!-- </div> -->

</x-login-layout>


<!-- 編集モーダルの中身 ★-->
<!-- <div class="modal js-modal @if ($errors->has('upPost')) open @endif">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <form action="{{ route('update') }}" method="POST">
            @csrf
            @method('PATCH')

            <! バリデーションエラーメッセージ -->
<!-- @if ($errors->has('upPost'))
            <p class="error-message" style="color: red;">{{ $errors->first('upPost') }}</p>
            @endif -->

<!-- 投稿内容 -->
<!-- <textarea name="upPost" class="modal_post" required maxlength="150">
            {{ old('upPost') }}
            </textarea>
            <input type="hidden" name="Id" class="modal_id" value="{{ old('Id') }}"> -->

<!-- <button type="submit">
                <img src="/images/edit.png" alt="更新ボタン">
            </button>
        </form>
    </div>
</div> -->
