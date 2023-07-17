<?php
session_start();
if(isset($_SESSION['id']) == false  &&
     isset($_SESSION['name']) == false ){
        function func_alert($message){
            echo "<script>alert('$message');</script>";
            //アラートのOKを押したらログイン画面に移動
            echo "<script>location.href='login.php';</script>";
        }
        func_alert("セッションが切れたため、もう一度ログインしなおしてください");
}
//都道府県を変更
require_once 'DAO.php';
$dao = new DAO();
//prefecture_changeの結果を$resultCheckで受け取る
$resultCheck = $dao->prefecture_change((int)$_POST['change_user_prefecture'],$_SESSION['id']);

    //DAO.php(prefecture_change)での処理が完了しているか$resultCheckの数をチェック
    if($resultCheck > 0){
        function func_alert($message){
            echo "<script>alert('$message');</script>";
            //アラートのOKを押したら設定画面に移動
        echo "<script>location.href='setting.php';</script>";
        }
        func_alert("都道府県を変更しました。");
    }else{
        //アラートにはこういう書き方もある　↑とやってることは同じ
        "<script type='text/javascript'>alert('変更が完了できませんでした。一度ログインしなおしてやり直してください。');</script>";
    }
?>