<?php
session_start();
    require_once '../DAO.php';
    $dao = new DAO();
    $dao->favorite($_POST['session_id'],$_POST['recipe_id']);
?>