<?php
session_start();
    require_once '../DAO.php';
    $dao = new DAO();

    $dao->delete_follow_follower($_POST['session_id'],$_POST['recipe_user_id']);

?>