<?php
// efetuamos o include do ficheiro respetivo ao cabeçalho (header.inc)
include_once("includes/header.inc.php");
?>
<meta charset="utf-8" />
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
        <th scope="col">Código</th>
        <th scope="col">Cliente</th>
        <th scope="col">Equipamento</th>
        <th scope="col">IMEI</th>
        <th scope="col">OBS</th>
        <th scope="col">Estado</th>
        <th scope="col">Descrição</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include_once("includes/db.php");
      $query = "SELECT sr.*,str.nome FROM Reparacoes sr, clientes str WHERE str.idCliente = sr.idCliente";
      $result = mysqli_query($conexao, $query);
      while ($row = mysqli_fetch_assoc($result))
      {
      ?>
      <tr>
        <td scope="row"><?=$row["idReparacao"];?></td>
        <td scope="row"><?=$row["CodigoReparacao"];?></td>
        <td scope="row"><?=$row["nome"];?></td>
        <td scope="row"><?=$row["Equipamento"];?></td>
        <td scope="row"><?=$row["IMEI"];?></td>
        <td scope="row"><?=$row["Obs"];?></td>
        <td scope="row">
        <?php if($row["EstadoReparacao"]== 1) echo "<button type='button' class='btn btn-primary'>Em aberto</button>";?>
        <?php if($row["EstadoReparacao"]== 2) echo "<button type='button' class='btn btn-secondary'>Para aprovação</button>";?>
        <?php if($row["EstadoReparacao"]== 3) echo "<button type='button' class='btn btn-info'>Em reparação</button>";?>
        <?php if($row["EstadoReparacao"]== 4) echo "<button type='button' class='btn btn-warning'>Pronto para entrega</button>";?>
        <?php if($row["EstadoReparacao"]== 5) echo "<button type='button' class='btn btn-success'>Entregue</button>";?>
        <?php if($row["EstadoReparacao"]== 6) echo "<button type='button' class='btn btn-danger'>Cancelada</button>";?></td>
        <td scope="row"><?=$row["DescricaoEstado"];?></td>
        <td scope="row">
          <a href="reparacoes_edit.php?idReparacao=<?=$row["idReparacao"]?>" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
          <a href="reparacoes_remover.php?idReparacao=<?=$row["idReparacao"]?>" class="btn btn-dark" onClick="javascript:return confirm('Deseja remover o registo?');"><i class="bi bi-file-x"></i></a>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<?php
// efetuamos o include do ficheiro respetivo ao footer (footer.inc)
include_once("includes/footer.inc.php");
?>