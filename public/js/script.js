$(function () {
  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数へ格納
    var post = $(this).attr('post');
    // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
    var post_id = $(this).attr('post_id');

    // 取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post').text(post);
    // 取得した投稿のidをモーダルの中身へ渡す
    $('.modal_id').val(post_id);
    return false;
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });

  // 削除ボタン(class="js-delete-modal-open")が押されたら
  $('.js-delete-modal-open').on('click', function (event) {
    event.preventDefault(); // デフォルト動作を防ぐ
    // 押されたボタンから投稿のIDを取得し、削除フォームのアクションURLを設定
    var postId = $(this).data('post-id');
    $('#deleteForm').attr('action', `/posts/${postId}`);
    // 削除モーダルの表示
    $('.js-delete-modal').fadeIn();
  });

  // モーダルを閉じるボタン(class="js-delete-modal-close")が押されたら
  $('.js-delete-modal-close').on('click', function () {
    $('.js-delete-modal').fadeOut();
  });

  // 削除ボタンの確認メッセージ
  $('.js-delete-confirm').on('click', function (event) {
    var confirmDelete = confirm("本当に削除しますか？");
    if (!confirmDelete) {
      event.preventDefault(); // キャンセルした場合はフォーム送信を中断
      $('.js-delete-modal').fadeOut(); // モーダルを閉じる
    }
  });

  // アコーディオンメニューの挙動
  $('.menu-toggle').on('click', function () {
    $(this).toggleClass('open');
    $('.menu-content').slideToggle(); // メニューの開閉
  });
});
