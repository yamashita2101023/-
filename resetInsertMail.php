<?php
require_once 'DAO.php';
$dao = new DAO();
$dao->resetMail($_POST['beforeMail'],$_POST['afterMail']);
?>