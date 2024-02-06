<?php
session_start();
unset($_SESSION["USERNAME"]);
header("Location:index.php");
?>