<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['password'])){
    unset($_SESSION['id']);
    unset($_SESSION['password']);
    header('Location: index.php');
}else{
    header('Location: index.php');
}

?>