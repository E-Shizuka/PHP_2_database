<?php

// DB接続処理

// 各種項目設定
$dbn ='mysql:dbname=service;charset=utf8mb4;port=3306;host=localhost';
//'mysql:dbname=YOUR_DB_NAME;データベース名のみ更新
$user = 'root';
$pwd = '';
//デプロイする時にuserとpwdを記載

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}


// SQL作成&実行
$sql = 'SELECT * FROM data_table ORDER BY updated_at DESC';

$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//「ユーザが入力したデータ」を使用しないので読み込み時はバインド変数不要


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <div class=\"toko\">
      <div class=\"textDataArea\"><h2>{$record["title"]}</h2></div>
      <div class=\"textDataArea\" id=\"docDateText\">{$record["toko"]}</div>
      <div class=\"pictureArea\">
        <img src=\"/service/img/{$record["img_name"]}\">
      </div>
    </div>
  ";
}

// echo "<pre>"; 
// //<pre>はオブジェクトを見やすく表示するためのタグ
// var_dump($result);
// echo "</pre>";
// exit();


?>

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
  <title>blog</title>
</head>

<body>
  <div class="all">
    <div class="fixed-top">
      <div class="a-box">
        <button onclick="openModal()" class="tokoOpnbtn">投稿する</button>
      </div>
      <div class="a-box">
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <!-- モーダルの内容をここに追加 -->
            <iframe src="input.php"></iframe>
          </div>
        </div>
        <h1 class="nikkiP"><legend>おでかけ日記</legend></h1>
    </div>
      <div class="scrollable">
        <div id="output">
          <?= $output ?>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    function openModal() {
  $("#myModal").css("display", "block");
}

function closeModal() {
  $("#myModal").css("display", "none");
}

$(document).ready(function() {
  $(".close").click(function() {
    closeModal();
    location.reload();
  });

});
</script>

</body>

</html>