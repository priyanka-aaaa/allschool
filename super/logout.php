<?php 

session_start();
session_destroy();
header("Location: ../super/login.php");