<?php
session_start();
if(isset($_SESSION['userLogged']))
{
    unset($_SESSION['userLogged']);
    header('location:../index.php');
}
?>
