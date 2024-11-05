<x-login-layout>


@section('content')
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
@endsection

<div class="post-list">
    @foreach($posts as $post)
        <div class="post-item">
            <!-- ユーザーアイコン、名前、投稿内容、日時 -->
            <img src="{{ $post->user->icon_path ?? '/path/to/default/icon.png' }}" alt="アイコン" class="user-icon">
            <p>{{ $post->user->name }}</p>
            <p>{{ $post->content }}</p>
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>

            <!-- 投稿編集ボタン（自分の投稿のみ表示） -->
            @if($post->user_id === Auth::id())
                <a href="{{ route('posts.edit', $post->id) }}" class="edit-button">編集</a>
            @endif

            <!-- 投稿削除ボタン（自分の投稿のみ表示） -->
            @if($post->user_id === Auth::id())
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">
                        <img src="/images/delete.png" alt="削除" onmouseover="this.src='/images/delete_hover.png'" onmouseout="this.src='/images/delete.png'">
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</div>

</x-login-layout>
