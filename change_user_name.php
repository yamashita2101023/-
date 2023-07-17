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
//ユーザー名変更
require_once 'DAO.php';
$dao = new DAO();
//user_name_changeの結果を$resultCheckで受け取る
$resultCheck = $dao->user_name_change($_POST['Chenge_user_name'],$_SESSION['id']);

    //DAO.php(user_name_change)での処理が完了しているか$resultCheckの数をチェック
    if($resultCheck > 0){
        function func_alert($message){
            echo "<script>alert('$message');</script>";
            //アラートのOKを押したら設定画面に移動
        echo "<script>location.href='setting.php';</script>";
        }
        func_alert("ユーザー名を変更しました。");
    }else{
        //アラートにはこういう書き方もある　↑とやってることは同じ
        "<script type='text/javascript'>alert('変更が完了できませんでした。一度ログインしなおしてやり直してください。');</script>";
    }
?>