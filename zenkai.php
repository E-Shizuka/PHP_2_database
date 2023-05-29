<?php
// ファイルを開く
$file = fopen("data/text.txt", "r");


// オブジェクト配列を格納する変数を初期化
$objects = array();

// ファイルからデータを1行ずつ読み込む
while (($line = fgets($file)) !== false) {
  // 行のデータを半角スペースで分割し、配列に格納
  $data = explode(",", $line);

// 改行文字をトリミングおよび置換
$data = array_map(function($value) {
    return str_replace("\\n", "", trim($value));
}, $data);

// データをオブジェクトに変換して配列に追加
$object = (object) array(
  "workname" => $data[0],
  "shosai" => str_replace("\\n", "<br>", $data[1]),
  "finishtime" => $data[2],
  "img_name_new" => $data[3]
);
$objects[] = $object;

}

// ファイルを閉じる
fclose($file);

// // オブジェクト配列を表示（テスト用）
// var_dump($objects);
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>作品制作日記</title>
  <link rel="canonical" href="#" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/sanitize.css" />
    <link
      href="https://fonts.googleapis.com/earlyaccess/kokoro.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
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
            <iframe src="todo_txt_input.php"></iframe>
          </div>
        </div>
        <h1 class="nikkiP"><legend>制作日記</legend></h1>
    </div>
      <div class="scrollable">
          <div id ="output">
          </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
const objects = <?=json_encode($objects)?>;
console.log(objects);
const htmlElements = [];
for (let i = 0; i <objects.length; i++) {
  const data = objects[i];
  htmlElements.unshift(`
    <div class ="toko">
      <div class ="textDataArea"><h2>タイトル：　${data.workname}</h2></div>
      <div class ="textDataArea" id ="docDateText">${data.shosai}</div>
      <div class ="textDataArea">制作日時：　${data.finishtime}</div>
      <div class = "pictureArea">
      <img src ="/blog/img/${data.img_name_new}"></div>
    </div>
  `);
}
$("#output").html(htmlElements.join(""));


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