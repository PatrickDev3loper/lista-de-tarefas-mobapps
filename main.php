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


if(isset($_GET['action']) && isset($_GET['id'])){
    if($_GET['action'] == 'realize'){
        $today = getdate();
        $sql = "UPDATE tasks SET task_date_execute = '".$today['mday']."/".$today['mon']."/".$today['year']."' WHERE (`id` = '".$_GET['id']."')";
        $conn->query($sql);
        $sql = "UPDATE tasks SET task_status = '1' WHERE (`id` = '".$_GET['id']."')";
        $conn->query($sql);
    }else if($_GET['action'] == 'delete'){
        $sql = "DELETE FROM tasks WHERE id = '".$_GET['id']."'";
        $conn->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MobApps Main</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="conatiner">
        <div class="box-tasks">
            <div class="task-title">
                <div class="sp"><i class="material-icons">face</i>&nbsp<a>Admin</a></div>
                <div class="sp"><a href="newtask.php" class="newTF">Adicionar Tarefa</a><a class="logout" href="exit.php"><i class="material-icons">logout</i></a></div>
            </div>
            <?php


                $sql = "SELECT * FROM tasks";
                
                    foreach ($conn->query($sql) as $row) {
                        if($row['task_status'] == true){
                            echo '<div class="task realizada">';
                        }else{
                            echo '<div class="task pendente">';
                        }
                        echo '<a class="dTF" href="?action=delete&id='.$row['id'].'">X</a>
                        <h1>'.$row['task_date_create'].'</h1>
                        <h1>'.$row['task_name'].'</h1>';
                        if($row['task_status'] == true){
                            echo '<a>Tarefa Realizada</a>';
                        }else{
                            echo '<a class="rTF" href="?action=realize&id='.$row['id'].'">Realizar Tarefa</a>
                            ';
                        }
                        echo '</div>';
                        
                    }
                    $conn->close();
            ?>
            
        </div>
    </div>
</body>
</html>