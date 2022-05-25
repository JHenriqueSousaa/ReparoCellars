<!DOCTYPE HTML>
<html>
	<head>
		<title>ReparoCellars</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<h1>ReparoCellars</h1>
				<p>Oficina do Telemóvel - Centro de Reparações. Enviaremos confirmação de receção orçamento para aprovação. <br />
				Reparação em 24 horas, salvo ruptura de stock de algum componente. <br />
				Devolução do equipamento sem custos de portes. Garantia em todas as reparações orçamentos gratuítos.</p>
			</header>

		<!-- Signup Form -->
			<form action="" method="POST">
				<input type="text" name="get_id" style="width: 18em" id="email" placeholder="Escreva o código" />
				<input type="submit" name="search_by_id" style="margin-top: 25px;" value="Procurar" />
			</form>
			<?php
                        include_once("admin/includes/db.php");
                        if(isset($_POST['search_by_id']))
                        {
                            $id = $_POST['get_id'];
                            $query = "SELECT * FROM Reparacoes WHERE CodigoReparacao='$id' ";
                            $query_run = mysqli_query($conexao, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                while($row = mysqli_fetch_array($query_run))
                                {
								$teste = $row['DescricaoEstado'];
								echo "<p>Estado da Reparação: </p>";
                                if($row["EstadoReparacao"]== 1) echo "<p style='margin-top: -20px; color: #42A5F5'>Em aberto- z{$teste}</p>";
                                if($row["EstadoReparacao"]== 2) echo "<p style='margin-top: -20px; color: #F5F5F5'>Para aprovação- {$teste}</p>";
                                if($row["EstadoReparacao"]== 3) echo "<p style='margin-top: -20px; color: #B388FF'>Em reparação- {$teste}</p>";
                                if($row["EstadoReparacao"]== 4) echo "<p style='margin-top: -20px; color: #FFEB3B'>Pronto para entrega- {$teste}</p>";
                                if($row["EstadoReparacao"]== 5) echo "<p style='margin-top: -20px; color: #64DD17'>Entregue- {$teste}</p>";
                                if($row["EstadoReparacao"]== 6) echo "<p style='margin-top: -20px; color: #F44336'>Cancelada- {$teste}</p>";
                                }

                            }
                            else{
                                echo "<p style='margin-top: -20px; color: #F44336'>Código Inválido ou não encontrado.</p>";
                            }
                        }
                        ?>

		<!-- Scripts -->
			<script src="assets/js/main.js"></script>

	</body>
</html>