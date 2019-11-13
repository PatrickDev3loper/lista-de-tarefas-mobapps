<?php
session_start();

include 'includes/connect.php';

if(isset($_SESSION['id']) && isset($_SESSION['password'])){
    $sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' AND pass = '".$_SESSION['password']."'";
    if($conn->query($sql)->num_rows <= 0){
        header('Location: exit.php');
        exit();
    }
}else{
    header('Location: index.php');
    exit();
}


if(isset($_POST['name'])){
    $today = getdate();
    $data = $today['mday'].'/'.$today['mon'].'/'.$today['year'];
    $sql = "INSERT INTO tasks (task_name, task_date_create, task_date_execute) VALUE ('".$_POST['name']."', '".$data."', '0');";
    if($conn->query($sql) == true){
        header('Location: main.php');
    }
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MobApps New Task</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="conatiner">
    
        <div class="new-box">
        <form action="newtask.php" method="post">
            <input class="new-input" name="name" placeholder="Insira a tarefa" />
            <button class="new-btn">Adicionar tarefa</button>
        </form>
        </div>
    </div>
</body>
</html>