<?php
// para verificar se o utilizador esta logado ou nao
session_start();

if(!isset($_SESSION["login"]) && $_SESSION["login"] !== true) {
  header("location: /admin/index.php");
  exit;
}


?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ReparoCellars- Loja de Reparações</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<style>
    .formdiv { margin: 0 auto; width: 110% }
    .info { height: 20px; }
</style>
</head>
<body>
<div class="m-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">ReparoCellars</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Reparações</a>
                        <div class="dropdown-menu">
                            <a href="/admin/home.php" class="dropdown-item">Lista</a>
                            <a href="/admin/reparacoes_add.php" class="dropdown-item">Adicionar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Clientes</a>
                        <div class="dropdown-menu">
                            <a href="/admin/clientes/clientes_lista.php" class="dropdown-item">Lista</a>
                            <a href="/admin/clientes/clientes_add.php" class="dropdown-item">Adicionar</a>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/admin/logout.php" class="nav-link">Terminar sessão com: <?php echo $_SESSION["username"]; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
</div>
</body>
</html>