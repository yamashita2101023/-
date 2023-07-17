<?php
require_once 'DAO.php';
$dao = new DAO();
$mailCount = $dao->insertSeachMail($_POST['email']);
if($mailCount == 0){
    $dao->insertGetTbl($_POST['email'],$_POST['password'],$_POST['username']);
}else{
    //データベースに同じメールアドレスがあったらアラートで表示
    function func_alert($message){
        echo "<script>alert('$message');</script>";
        //アラートのOKを押したら新規登録画面に移動
        echo "<script>location.href='newRegister.php';</script>";
    }
    func_alert("既に使われているメールアドレスです。");
    
}
// $count = count($searchArray);
?>