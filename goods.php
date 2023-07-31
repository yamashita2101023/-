<?php
    require_once '../DAO.php';
    $dao = new DAO();

    $dao->goods($_POST['session_id'],$_POST['recipe_id']);

?>