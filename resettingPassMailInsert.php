<?php
    require_once 'DAO.php';
    $dao = new DAO();
    $login_check = $dao->pass($_POST['passmail']);
    $count = count($login_check);
    if($count > 0){
        $dao->resetPassword($login_check,$_POST['beforepassword'],$_POST['afterpassword']);
    }

