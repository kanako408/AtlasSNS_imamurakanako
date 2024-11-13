<x-login-layout>


    <!-- 投稿フォーム -->

    <div class="post-form">
        <!-- ログインユーザーのアイコンを表示 -->
        <img src="{{ Auth::user()->icon_path ?? '/path/to/default/icon.png' }}" alt="ユーザーアイコン" class="user-icon">

        <!-- 投稿フォーム -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">投稿内容</label>
                <textarea name="content" id="content" rows="3" class="form-control" placeholder="投稿内容を入力してください" required></textarea>
            </div>

            <!-- 投稿ボタン（画像） -->
            <button type="submit" class="post-button">
                <img src="/images/post.png" alt="投稿" class="post-image">
            </button>
        </form>
    </div>


    <div class="post-list">
        @foreach($posts as $post)
        <div class="post-item">
            <!-- ユーザーアイコン、名前、投稿内容、日時 -->
            <img src="{{ $post->user->icon_path ?? '/path/to/default/icon.png' }}" alt="アイコン" class="user-icon">
            <p>{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>

            <!-- 投稿編集ボタン（自分の投稿のみ表示） -->
            @if($post->user_id === Auth::id())
            <a class="js-modal-open" href="#" post="{{ $post->post }}" post_id="{{ $post->id }}">編集</a>
            @endif
            <!-- 投稿削除ボタン（自分の投稿のみ表示） -->
            @if($post->user_id === Auth::id())
            <button type="button" class="delete-button js-delete-modal-open" data-post-id="{{ $post->id }}">
                <img src="/images/trash.png" alt="削除" onmouseover="this.src='/images/trash-h.png'" onmouseout="this.src='/images/trash.png'">
            </button>
            @endif
        </div>
        @endforeach

        <!-- 編集モーダルの中身 -->
        <div class="modal js-modal">
            <div class="modal__bg js-modal-close"></div>
            <div class="modal__content">
                <form action="{{ route('update') }}" method="POST">
                    <textarea name="upPost" class="modal_post" value=""></textarea>
                    <input type="hidden" name="Id" class="modal_id" value="">
                    <input type="submit" value="更新">
                    {{ csrf_field() }}
                </form>
                <a class="js-modal-close" href="">閉じる</a>
            </div>
        </div>

        <!-- 削除確認モーダル -->
        <div class="modal js-delete-modal">
            <div class="modal__bg js-delete-modal-close"></div>
            <div class="modal__content">
                <p>本当にこの投稿を削除しますか？</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="confirm-delete-button">削除する</button>
                </form>
                <button class="js-delete-modal-close">キャンセル</button>
            </div>
        </div>
    </div>

</x-login-layout>
