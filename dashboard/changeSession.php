<?php 
session_start();

$session=$_GET["session"];

$_SESSION["session"] = $session;
header("Location: ../dashboard/index");
// header('Location: ' . $_SERVER['HTTP_REFERER']);