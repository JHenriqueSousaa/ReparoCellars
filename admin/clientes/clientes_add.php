<?php

// vamos verifivar se temos um GET
if($_SERVER["REQUEST_METHOD"] == "GET") {

    // vamos verificar se é passado um valora no id e se o mesmo é numérico (ex: id=2)
    if(isset($_GET["idCliente"]) && is_numeric($_GET["idCliente"])) {

        // incluimos o ficheiro db.php que faz a ligação à base de dados mysql
        include_once("../includes/db.php");

        // definir a variavel
        $idCliente = $_GET["idCliente"];

        // efetuamos uma consulta select apenas para o cliente com o respetivo id
        $query = "select * from clientes where idCliente=$idCliente";

        // executar a consulta
        $resultado = mysqli_query($conexao, $query);

        // obtemos uma varieavel com o numero de registos encontrados na consulta
        $registos = mysqli_num_rows($resultado);

        // vamos retornar uma variável cliente com o resulta em formado de array
        $cliente = mysqli_fetch_row($resultado);
        $nomeCliente = $cliente[1];
        $moradaCliente = $cliente[2];
        $telemovelCliente = $cliente[3];
        $emailCliente = $cliente[4];
        $obsCliente = $cliente[5];
    } else {
        // se não tivermos um idCliente colocamos as variaveis empty
        $idCliente = "";
        $nomeCliente = "";
        $moradaCliente = "";
        $telemovelCliente = "";
        $emailCliente = "";
        $obsCliente = "";
    }
}

// vamos verificar se existe um POST (que é quando o botão editar/guardar é pressionado)
if($_SERVER["REQUEST_METHOD"]=="POST") {
    // incluimos o ficheiro db.php
    include_once("../includes/db.php");
    
    /* // vamos verificar se os campos estão preenchidos e definimos as variáveis
    if(!empty($_POST["nome"])){
        $nomeCliente = $_POST["cliente"];
    } else {
        $nomeCliente = "";
    }
    */

    // de forma mais fácil
    $idCliente = (!empty($_POST["idCliente"])) ? $_POST["idCliente"] : "";
    $nomeCliente = (!empty($_POST["nome"])) ? $_POST["nome"] : "";
    $moradaCliente = (!empty($_POST["morada"])) ? $_POST["morada"] : "";
    $telemovelCliente = (!empty($_POST["telemovel"])) ? $_POST["telemovel"] : "";
    $emailCliente = (!empty($_POST["email"])) ? $_POST["email"] : "";
    $obsCliente = (!empty($_POST["obs"])) ? $_POST["obs"] : "";

    // inserir um novo aluno ou editar um existente
    // se tivermos um id (no link) iremos editar, caso não tenhamos um id estaremos a criar
    if(empty($idCliente)) {
        // query para inserir um novo cliente
        $query = "insert into clientes (nome, morada, telemovel, email, obs) values('$nomeCliente', '$moradaCliente', '$telemovelCliente', '$emailCliente', '$obsCliente')";

        // executamos a consulta
        $resultado = mysqli_query($conexao, $query);

        // se retornar um true encaminhamos para a página clientes msg=1
        if($resultado) {
            header("location: clientes_lista.php?msg=1");
        }
    }
}

// efetuamos o include do ficheiro respetivo ao cabeçalho (header.inc)
include_once("../includes/header.inc.php");
?>
<div class="container">
        <div class="formdiv">
        <div class="info"></div>
        <form method="POST" action="">
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-7">
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" value="<?=$nomeCliente?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="morada" class="col-sm-3 col-form-label">Morada</label>
                <div class="col-sm-7">
                <input type="morada" name="morada" class="form-control" id="morada" placeholder="Morada" value="<?=$moradaCliente?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="telemovel" class="col-sm-3 col-form-label">Telemóvel</label>
                <div class="col-sm-7">
                <input type="telemovel" name="telemovel" class="form-control" id="telemovel" placeholder="Telemóvel" value="<?=$telemovelCliente?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-7">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?=$emailCliente?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="obs" class="col-sm-3 col-form-label">Observações</label>
                <div class="col-sm-7">
                <input type="obs" name="obs" class="form-control" id="obs" placeholder="Observações" value="<?=$obsCliente?>">
                <a class="text-muted">O campo de observações pode ter um máximo de 40 caracteres.</a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-7">
                <input type="hidden" name="idCliente" value="<?=$idCliente?>">
                <input type="submit" name="enviar" class="btn btn-dark" value="Guardar" />
                <a href="../clientes/clientes_lista.php" class="btn btn-dark">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
// efetuamos o include do ficheiro respetivo ao footer (footer.inc)
include_once("../includes/footer.inc.php");
?>