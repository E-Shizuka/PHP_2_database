<?php
//データ受け取れているか確認
// var_dump($_POST);
// exit();

//テキストファイルに保存する処理

// データの受け取り
$finishtime = $_POST["finishtime"];
$workname = $_POST["workname"];
$shosai = $_POST["shosai"];
$img_name = $_FILES["img"]["name"];
$img_tmp = $_FILES["img"]["tmp_name"]; // 一時的なファイルのパス

// 画像を保存するディレクトリのパス
$upload = "./img";

// ファイル名を一意に生成
$uniqid = uniqid();
$img_name_new = $uniqid . "_" . $img_name;

// 画像を移動して保存
if (move_uploaded_file($img_tmp, $upload . "/" . $img_name_new)) {
    echo "画像の保存に成功しました。";
} else {
    echo "画像の保存に失敗しました。";
}



// データを1行で記録
$shosai = str_replace("\n", "\\n", $shosai); // 改行文字を置換
$data = "{$workname},{$shosai},{$finishtime},{$img_name_new},\n";

// ファイルを開く．
//"a" 追加書き込みのみで開く → ファイルがなければ作成
$file = fopen("data/text.txt", "a");

// ファイルをロックする LOCK_EX ロックする LOCK_UN ロック解除
flock($file, LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file, $data);

// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// データ入力画面に移動する
//Location:〜 〜へ移動する
header("Location:todo_txt_input.php");
exit();

