<?php 
	session_start();
	if(!isset($_SESSION['login']))
		{
			header('location: ../index.php');
		}
?>
<html>
  <head>
		<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Caixas</title>
		<link rel="icon" type="image/png" href="../Imgs/K.png">
		<link href="../Componets/css/cards.css" rel="stylesheet">
		<script type = "text/javascript" src = "../Componets/js/jquery-3.3.1.min.js"></script>
		<script type = "text/javascript" src = "../Componets/js/functions.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
		<nav class="navbar  navbar-dark bg-dark">
		  <a class="navbar-brand" href="../index.php">
			<img src="../Imgs/K.png" width="25" height="35" class="d-inline-block align-top" alt="">
			Karoline Modas & Perfumaria
		  </a>
		  <span class="navbar-text" id="msgUsuario"><i class="fas fa-user"  style="font-size:25px"></i> <?php echo $_COOKIE['nomeUsuario']; ?> 
			<input type="button" value="Sair" id="btnLogout" class="btn btn-danger ">
		  </span>
		</nav>
		<div class="container">    
			<div class="row">
				<div class="card-consultar">
					<div class="card-consultar-chamado">
						<div class = "col-md-10">	
							<div class="col-6 d-flex justify-content-around">
								<a href="caixa.php" style="text-align: center">	
									<i class="fas fa-arrow-circle-left" " style="font-size:50px"></i>
									<p>Voltar</p>
								</a>
							</div>
						</div>					
						<?php
						require_once "../Database/functionsDB.php";
						$resultado = buscarCaixa();
					
						
						if($resultado->rowCount() > 0)
						{
							echo "<table class ='table table-bordered'>";
								echo "<tr>";
									echo "<th>Saldo do Caixa </th> <th>Data do Caixa</th> <th>Situação </th> <th>Aberto por </th> <th>Fechado por </th> <th>Qtd de Vendas</th> ";
								echo "</tr>";
						
								while($linha = $resultado->fetch())
									{	
										$cliente_abertura = buscarUsuarioID($linha['id_usuario_abertura']);
										$cliente_abertura = $cliente_abertura->fetch(PDO::FETCH_OBJ);
										
										$cliente_fechamento = buscarUsuarioID($linha['id_usuario_fechamento']);
										$cliente_fechamento = $cliente_fechamento->fetch(PDO::FETCH_OBJ);
										
										echo"<tr>";
										echo"<td> R$ ".number_format($linha['valor'], 2 , ",", ".")."</td>";
										echo"<td>".$linha['data_caixa']."</td>";
										if($linha['aberto_fechado'] == 1)
										{
											echo"<td> Caixa Aberto</td>";
										}
										else 
										{
											echo"<td> Caixa Fechado</td>";
										}
										echo"<td>".$cliente_abertura->nome."</td>";
										echo"<td>".$cliente_fechamento->nome."</td>";
										echo"<td>".$linha['qtd_total_vendas']."</td>";
										echo "</tr>";
									}
								echo "</table>";
						}
							?>
									<br/>
					</div>
				</div>
			</div>
		</div>
  </body>
</html>