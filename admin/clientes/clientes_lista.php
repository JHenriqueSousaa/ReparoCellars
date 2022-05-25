<?php
// efetuamos o include do ficheiro respetivo ao cabeçalho (header.inc)
include_once("../includes/header.inc.php");

// carregar o ficheiro db.php responsável pela ligação à base de dados mysql
include_once("../includes/db.php");

// vamos efetuar uma consulta/query na tabela clientes da bd
$query = "select * from clientes";

// executamos a consulta
$resultado = mysqli_query($conexao, $query);

// obtemos uma variável com o numeros de registos
$registos = mysqli_num_rows($resultado);



?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"/>
<!-- Bootstrap Font Icon CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
<div class="container">
  <div class="info"></div>
  <?php
  // vamos tratar das mensagens de erro ou sucesso
  if(!empty($_GET["msg"])) {
  $msg = $_GET["msg"];

  switch($msg) {
    case 1:
        $info = "Registo inserido com sucesso.";
        $alerta = "alert-dark";
        break;
    case 2:
        $info = "Registo atualizado com sucesso.";
        $alerta = "alert-dark";
        break;
    case 3:
        $info = "Registo removido com sucesso.";
        $alerta = "alert-dark";
        break;
    }
  }
     
  if(isset($info)) {
  ?>
  
  <div class="alert <?=$alerta?> alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?=$info?></strong>
  </div>
  <?php
  }
  ?>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Morada</th>
        <th scope="col">Telémovel</th>
        <th scope="col">E-mail</th>
        <th scope="col">OBS</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // código para listar os registos encontrados na tabela alunos
      if(!empty($registos)) {
        while($cliente = mysqli_fetch_assoc($resultado)) {
      ?>
      <tr>
        <td scope="row"><?=$cliente["idCliente"];?></td>
        <td scope="row"><?=$cliente["nome"];?></td>
        <td scope="row"><?=$cliente["morada"];?></td>
        <td scope="row"><?=$cliente["telemovel"];?></td>
        <td scope="row"><?=$cliente["email"];?></td>
        <td scope="row"><?=$cliente["obs"];?></td>
        <td scope="row">
          <a href="" class="btn btn-dark"><i class="bi bi-file-arrow-down"></i></a>
          <a href="clientes_edit.php?idCliente=<?=$cliente["idCliente"]?>" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
          <a href="clientes_remover.php?idCliente=<?=$cliente["idCliente"]?>" class="btn btn-dark" onClick="javascript:return confirm('Deseja remover o registo?');"><i class="bi bi-file-x"></i></a>
        </td>
      </tr>
      <?php
        }
      }
      // fecho do if e do while
      ?>
    </tbody>
  </table>
</div>

<?php
// efetuamos o include do ficheiro respetivo ao footer (footer.inc)
include_once("../includes/footer.inc.php");
?>