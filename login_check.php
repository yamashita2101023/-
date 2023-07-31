<?php
session_start();
require_once 'DAO.php';
$dao = new DAO();

$searchArray = $dao->loginTbl($_POST['mail']);
foreach($searchArray as $row){
    if(password_verify($_POST['password'], $row['user_password'])  ==  true){
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['name'] = $row['user_name'];
        header("Location: top.php");
        exit();
}else{
    function func_alert($message){
        echo "<script>alert('$message');</script>";
        //アラートのOKを押したら新規登録画面に移動
        echo "<script>location.href='login.php';</script>";
    }
    func_alert("パスワードが間違っています。");
    }
}
?>