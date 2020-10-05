<?php 
	session_start();
	require_once '../Database/functionsDB.php';
	$resultado_caixa = buscarCaixaAberto();
	if(!isset($_SESSION['login']))
		{
			header('location: ../index.php');
		}
		

	if($resultado_caixa->rowCount()!=1)
	{
		header('location: ../Pages/caixa.php');
	}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Receber</title>
		<link rel="icon" type="image/png" href="../Imgs/K.png">
		<link href="../Componets/css/cards.css" rel="stylesheet">
		<script type = "text/javascript" src = "../Componets/js/jquery-3.3.1.min.js"></script>
		<script type = "text/javascript" src = "../Componets/js/functions.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
	</head>

	<body>
		<nav class="navbar navbar-dark bg-dark">
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

			<?php 
				$id = $_GET['id'];
				$resultado = buscarClienteID($id);
				for($i=0; $row = $resultado->fetch(); $i++)
				{
			?>
				<div class = "card-abrir">
					<div class="form-group">
						<form  action="receber_parcelas.php?id=<?php echo $id ?>" method = "post">
							<div class="form-group">
								<input type="hidden" name="id" value="<?php echo $id ?>">
							
								<label for = "divida">Dívida Total</label>
								<input type = "text" class="form-control" id = "divida" name = "divida" disabled value="<?php echo "R$" . number_format($row['divida'], 2 , ",", ".") ?>" /> <br/>
							
								<label for = "valor">Valor Recebido </label>
								<input type = "number" class="form-control" id = "valor" name = "valor" min="0" step="any"required placeholder="<?php echo "R$" . number_format(0, 2 , ",", ".") ?>" /> <br/>
							
								<div class="row mt-4">
									<div class="col-6">
										<a class="btn btn btn-warning btn-block " href="../Pages/clientes.php">Voltar</a>
									</div>
									<div class="col-6">
										<input type = "submit"  class="btn btn btn-primary btn-block" name='Salvar' value = "Salvar"/> <br/>
									</div>
								</div>
							</div>
						</form>
					<?php
				}
						if(!empty($_POST))
						{
							$_GET['id'] = '';
							$_POST["valor"];

							$a = buscarClienteID($id);
							$b = $a->fetch(PDO::FETCH_OBJ);
							$divida_nova =  $b->divida - $_POST["valor"];

							require_once "../Models/Cliente.php";	
							$cliente = new Cliente();
							$cliente->setDivida($divida_nova);
							receberParcela($cliente, $id);
							
							$resultado_caixa = $resultado_caixa->fetch(PDO::FETCH_OBJ);
							$valor_caixa = $resultado_caixa->valor + $_POST["valor"];
							
							adcionarRecebido($valor_caixa);
							
							?>
								<script>
									
								</script>
							<?php
						}
					?>
				
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>
