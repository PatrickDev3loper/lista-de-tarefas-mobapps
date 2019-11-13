<?php
session_start();
include 'includes/connect.php';

if(isset($_SESSION['id']) && isset($_SESSION['password'])){
    header('Location: main.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MobApps Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="conatiner">
        <div class="form-box">
            <div class="logo"><h1>MobApps</h1></div>
            <?php
            
            if(isset($_POST['user']) && isset($_POST['pass'])){
                $name = $_POST['user'];
                $pass = md5($_POST['pass']);

                $sql = "SELECT * FROM users WHERE login = '".$name."' AND pass = '".$pass."'";
                if($conn->query($sql)->num_rows == 1){
                    foreach ($conn->query($sql) as $row) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['password'] = $row['pass'];
                        header('Location: main.php');
                    }
                }else{
                    echo "<div class='showAlert'><h1>Login ou senha inválidos, tente novamente.</h1></div>";

                }

            }
            $conn->close();
            ?>

            <form action="index.php" method="POST">
                <div class="input">
                    <div class="input-icon"><i class="material-icons">face</i></div>
                    <div class="input-box"><input type="text" autocomplete="off" name="user" placeholder="Usuário" style="width:100%; padding: 5px; border: none; outline: 0;"></input></div>
                </div>
                <div class="input">
                        <div class="input-icon"><i class="material-icons">vpn_key</i></div>
                        <div class="input-box"><input type="password" name="pass" placeholder="Senha" style="width:100%; padding: 5px; border: none; outline: 0;"></input></div>
                </div>
                <button class="btnSubmit" type="submit">Logar</button>

            </form>
        </div>
    </div>
</body>
</html>