<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/sanitize.css" />
    <link
      href="https://fonts.googleapis.com/earlyaccess/kokoro.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>投稿画面</title>
</head>

<body>
  <form action="todo_txt_create.php" enctype="multipart/form-data" method="POST">
    <fieldset>
      <legend>投稿を作成</legend>
      <!-- <a href="todo_txt_read.php">一覧画面</a> -->
      <div class="tokobox">
        <div class="title">
        タイトル：
        </div>
        <div class="input">
        <input type="text" name="workname" class="textarea">
        </div>
      </div>
      <div class="tokobox">
        <div class="title">
        投稿内容：
        </div>
        <div class="input">
          <textarea rows="10" cols="60" name="shosai" class="textarea"></textarea>
        </div>
      </div>
      <div class="tokobox">
        <div class="title">制作年月：
        </div>
        <div class="input">
        <input type="date" name="finishtime">
        </div>
      </div>
      <div class="tokobox">
        <div class="title">作品画像：
        </div>
        <div class="input">
        <input type="file" name="img" accept=".jpg,.jpeg,.png" required>
        </div>
      </div>
      <div class="tokobox">
        <button class="tokobtn">投稿</button>
      </div>
    </fieldset>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    function closeModalAndReload() {
  closeModal();
  location.reload();
}

$(".tokobtn").click(function() {
  closeModalAndReload();
});

</script>


</body>

</html>