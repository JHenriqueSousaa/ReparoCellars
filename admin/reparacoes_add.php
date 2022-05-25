<?php

// vamos verifivar se temos um GET
if($_SERVER["REQUEST_METHOD"] == "GET") {

    // vamos verificar se é passado um valora no id e se o mesmo é numérico (ex: id=2)
    if(isset($_GET["idReparacao"]) && is_numeric($_GET["idReparacao"])) {

        // incluimos o ficheiro db.php que faz a ligação à base de dados mysql
        include_once("includes/db.php");

        // definir a variavel
        $idReparacao = $_GET["idReparacao"];

        // efetuamos uma consulta select apenas para o cliente com o respetivo id
        $query = "select * from Reparacoes where idReparacao=$idReparacao";

        // executar a consulta
        $resultado = mysqli_query($conexao, $query);

        // obtemos uma varieavel com o numero de registos encontrados na consulta
        $registos = mysqli_num_rows($resultado);

        // vamos retornar uma variável cliente com o resulta em formado de array
        $reparacao = mysqli_fetch_row($resultado);
        $codigoReparacoes = $reparacao[1]; #idCodigo
        $clienteReparacoes = $reparacao[2]; #idCliente
        $equipamentoReparacoes = $reparacao[3];
        $imeiReparacoes = $reparacao[4];
        $obsReparacoes = $reparacao[5];
        $estadoReparacoes = $reparacao[6];
        $descricaoReparacoes = $reparacao[7];
    } else {
        // se não tivermos um idCliente colocamos as variaveis empty
        $codigoReparacoes = ""; #idCodigo
        $clienteReparacoes = ""; #idCliente
        $equipamentoReparacoes = "";
        $imeiReparacoes = "";
        $obsReparacoes = "";
        $estadoReparacoes = "";
        $descricaoReparacoes = "";
    }
}

// vamos verificar se existe um POST (que é quando o botão editar/guardar é pressionado)
if($_SERVER["REQUEST_METHOD"]=="POST") {
    // incluimos o ficheiro db.php
    include_once("includes/db.php");
    
    /* // vamos verificar se os campos estão preenchidos e definimos as variáveis
    if(!empty($_POST["nome"])){
        $nomeCliente = $_POST["cliente"];
    } else {
        $nomeCliente = "";
    }
    */

    // de forma mais fácil
    $idReparacao = (!empty($_POST["idReparacao"])) ? $_POST["idReparacao"] : "";
    $codigoReparacoes = (!empty($_POST["CodigoReparacao"])) ? $_POST["CodigoReparacao"] : "";
    $clienteReparacoes = (!empty($_POST["idCliente"])) ? $_POST["idCliente"] : "";
    $equipamentoReparacoes = (!empty($_POST["Equipamento"])) ? $_POST["Equipamento"] : "";
    $imeiReparacoes = (!empty($_POST["IMEI"])) ? $_POST["IMEI"] : "";
    $obsReparacoes = (!empty($_POST["Obs"])) ? $_POST["Obs"] : "";
    $estadoReparacoes = (!empty($_POST["EstadoReparacao"])) ? $_POST["EstadoReparacao"] : "";
    $descricaoReparacoes = (!empty($_POST["DescricaoEstado"])) ? $_POST["DescricaoEstado"] : "";

    // inserir um novo aluno ou editar um existente
    // se tivermos um id (no link) iremos editar, caso não tenhamos um id estaremos a criar
    if(empty($idReparacao)) {
        // query para inserir um novo cliente
        $query = "insert into Reparacoes (CodigoReparacao, idCliente, Equipamento, IMEI, Obs, EstadoReparacao, DescricaoEstado) values ('$codigoReparacoes', '$clienteReparacoes', '$equipamentoReparacoes', '$imeiReparacoes', '$obsReparacoes', '$estadoReparacoes', '$descricaoReparacoes')";

        // executamos a consulta
        $resultado = mysqli_query($conexao, $query);

        // se retornar um true encaminhamos para a página clientes msg=1
        if($resultado) {
            header("location: home.php?msg=2");
        }
    }
}

$n=5;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

// efetuamos o include do ficheiro respetivo ao cabeçalho (header.inc)
include_once("includes/header.inc.php");
?>
<div class="container">
        <div class="formdiv">
        <div class="info"></div>
        <form method="POST" action="">
            <div class="form-group row">
                <label for="CodigoReparacao" class="col-sm-3 col-form-label">Código de Reparação</label>
                <div class="col-sm-7">
                <input type="text" name="CodigoReparacao" class="form-control" id="CodigoReparacao" placeholder="Códiogo de Reparação" value="<?=getName($n). $codigoReparacoes?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="idCliente" class="col-sm-3 col-form-label">Cliente</label>
                <div class="col-sm-7">
                <select class="form-control" name="idCliente" id="idCliente">
                    <?php
                    include_once("includes/db.php");
                    $sqli = "SELECT * FROM clientes";
                    $resultado2 = mysqli_query($conexao, $sqli);
                    while ($row = mysqli_fetch_array($resultado2)){
                        ?>
                        <option value="<?=$row["idCliente"]?>"><?=$row["idCliente"]?> - <?=$row["nome"]?></option>";
                    <?php
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Equipamento" class="col-sm-3 col-form-label">Equipamento</label>
                <div class="col-sm-7">
                <input type="text" name="Equipamento" class="form-control" id="Equipamento" placeholder="Equipamento" value="<?=$equipamentoReparacoes?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="IMEI" class="col-sm-3 col-form-label">IMEI</label>
                <div class="col-sm-7">
                <input type="text" name="IMEI" class="form-control" id="IMEI" placeholder="IMEI" value="<?=$imeiReparacoes?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="Obs" class="col-sm-3 col-form-label">Observações</label>
                <div class="col-sm-7">
                <input type="text" name="Obs" class="form-control" id="Obs" placeholder="Observações" value="<?=$obsReparacoes?>">
                <a class="text-muted">O campo de observações pode ter um máximo de 40 caracteres.</a>
                </div>
            </div>
            <div class="form-group row">
                <label for="EstadoReparacao" class="col-sm-3 col-form-label">Estado de Reparacao</label>
                <div class="col-sm-7">
                <select class="form-control" name="EstadoReparacao" id="EstadoReparacao">
                    <option value=1>Em Aberto</option>
                    <option value=2>Para aprovação</option>
                    <option value=3>Em reparação</option>
                    <option value=4>Pronto para entrega</option>
                    <option value=5>Entregue</option>
                    <option value=6>Cancelada</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="DescricaoEstado" class="col-sm-3 col-form-label">Descrição</label>
                <div class="col-sm-7">
                <input type="text" name="DescricaoEstado" class="form-control" id="DescricaoEstado" placeholder="Descrição" value="<?=$descricaoReparacoes?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-7">
                <input type="hidden" name="idReparacao" value="<?=$idReparacao?>">
                <input type="submit" name="enviar" class="btn btn-dark" value="Guardar" />
                <a href="home.php" class="btn btn-dark">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
// efetuamos o include do ficheiro respetivo ao footer (footer.inc)
include_once("includes/footer.inc.php");
?>