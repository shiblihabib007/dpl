<?php
session_start();

$_SESSION["user"]="fuck";
session_destroy();
header('Location:../index.php');
?>