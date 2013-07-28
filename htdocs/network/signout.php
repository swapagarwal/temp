<?php
session_start();
$_SESSION['user']='';
header('location:signin.php');
?>