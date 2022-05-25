<?php
// ficheiro para remover registos da tabela clientes

// vamos verificar se existe um GET
if($_SERVER["REQUEST_METHOD"]=="GET") {
// vamos verificar se é passado um valor no id e se o mesmo é numérico (ex: id=2)
  if(isset($_GET["idReparacao"]) && is_numeric($_GET["idReparacao"])) {
    // incluimos o ficheiro db.php
    include_once("includes/db.php");

    // definir a variavel
    $idReparacao =  $_GET["idReparacao"];

    // efetuamos uma consulta delete
    $query = "delete from Reparacoes where idReparacao=$idReparacao";

    // executamos a consulta 
    $resultado = mysqli_query($conexao, $query);

    // se o resultado retornar um true encaminhamos para o index com msg=3
    if($resultado) {
      header("location: home.php?msg=3");
    }
  }
}
?>