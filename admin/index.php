<?php
// inicamos uma sessao
session_start();

// verifcamos se o utlizador está logado e se sim enchaminhamos para a página home.php
if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
    header("location: home.php");
    exit;
}

// carregar o ficheiro db.php, responsável pela ligaçãom a base de dados mssql
include_once("includes/db.php");

// verificamos se ha um post
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // verificamos os campos username e password
    if (empty($_POST["username"])) {
        $erro_username = "Username inválido";
    } 
    if (empty($_POST["password"])) {
        $erro_password = "Password inválida";
    } if(!empty($_POST["username"]) && !empty($_POST["password"])){
        // atribuimos os valores do input username e password as variaveis respetivas
        $username = $_POST["username"];
        $password = $_POST["password"];
    }
    // se não tivermos um erro definido vamos vlidar as credenciais
    if (!isset($erro_username) && !isset($erro_password)) {
        $query = "SELECT * FROM utilizadores WHERE username='$username'";

        $resultado = mysqli_query($conexao, $query);

        // se o resultado resultar num true
        if($resultado) {
            $utilizador = mysqli_fetch_row($resultado);
            //vamos atribuir os valores do registo da base de dados 
            $idUtilizador = $utilizador[0];
            $usernameUtilizador = $utilizador[1];
            $passwordUtilizador = $utilizador[2];

            //vamos verificar as pass no formulario e na base de dados
            if(password_verify($password, $passwordUtilizador)) {
                //iniciamos uma sessao
                session_start();

                $_SESSION["login"] = true;
                $_SESSION["id"] = $idUtilizador;
                $_SESSION["username"] = $usernameUtilizador;
                
                //redirect do utilizador para home.php
                header("location: home.php");
            } else {
                $erro_password = "Password inválida";
            }
        }else {
            $erro_utilizador = "Utilizador inválido";
        }

        //fechamos a conexao ao msqli
        mysqli_close($conexao);
    }

    //vamos verificar se temos erros na variaveis $erro_username e $erro_password
    if(isset($_POST["erro_username"])) $erro_username = $_POST["erro_username"];
    if(isset($_POST["erro_password"])) $erro_password = $_POST["erro_password"];
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>ReparoCellars- Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .container {
            max-width: 40% !important;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bem-vindo à área reservada</h2>
        <p>Introduza os seus dados de login.</p>

        <form action="index.php" method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($erro_username)) ? 'is-invalid' : ''; ?> " value="">
                <span class="invalid-feedback"><?php if(isset($erro_username)) echo $erro_username; ?></span>
            </div>    
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($erro_password)) ? 'is-invalid' : ''; ?> ">
                <span class="invalid-feedback"><?php if(isset($erro_password)) echo $erro_password; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>