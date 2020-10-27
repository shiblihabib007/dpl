<?php
session_start();

$_SESSION["admin_username"]=NULL;
session_destroy();
header('Location:index.php');
?>