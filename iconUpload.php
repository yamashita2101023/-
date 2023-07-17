<?php
// アイコンのアップロードを処理する
if (isset($_FILES['icon'])) {
    // 
    $icon_data = file_get_contents($_FILES['icon']);

    // header関数でコンテンツの形式が画像であると宣言
    header('Content-type: image/jpg');

    //データを出力
    echo $icon_data;
}
?>
