<?php
// ligação ao servidor mysql

// definição de dados de acesso através de constantes
// colocar dados de acesso
define("DBSERVER", ""); #servidor
define("DBUSER", ""); #username 
define("DBPWD", ""); #password
define("DBNAME", ""); #nome da base de dados

// passar as constantes
$conexao = mysqli_connect(DBSERVER, DBUSER, DBPWD, DBNAME);

// verificar a ligação
if ($conexao == false)
{
    die("Error: ". mysqli_connect_error());
}
else 
{
    # echo "Ligação à base de dados efetuado com sucesso.";
}
?>