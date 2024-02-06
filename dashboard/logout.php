<?php
session_start();
unset($_SESSION["USERNAME"]);
 echo 'Your account has been loged out';
?>