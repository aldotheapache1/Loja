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
		<title>Karoline Modas & Perfumaria - Editar Cliente</title>
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
				require_once "../Database/functionsDB.php";
				$id = $_GET['id'];
				$resultado = buscarClienteID($id);
				for($i=0; $row = $resultado->fetch(); $i++)
				{
			?>
				<div class = "card-abrir">
					<form  action="edit_cliente.php?id=<?php echo $id ?>" method = "post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<label for = "nome">Nome </label>
							<input type = "text" class="form-control" id = "nome" name = "nome"  maxlength="50" required value="<?php echo $row['nome']; ?>" /> <br/>
							<div class="form-group">
							
							<?php 
							if($row['tipo'] == 1)
							{
								echo "<input type='radio' id='tipo' name='tipo' value='2'>";
								echo "<label for='tipo'>À Vista</label> <br>";
								echo "<input type='radio' id='tipo' name='tipo' value='1'  checked='checked'>";
								echo "<label for='tipo'>A prazo</label> <br>";
							}
							else
							{
								echo "<input type='radio' id='tipo' name='tipo' value='2' checked='checked'>";
								echo "<label for='tipo'>À Vista</label> <br>";
								echo "<input type='radio' id='tipo' name='tipo' value='1'>";
								echo "<label for='tipo'>A prazo</label> <br>";
							}					
							?>
								
							</div>
							
							<?php 
							if($row['tipo'] == 2)
							{
							?>
							<div class="form-group">
							  <label>CPF</label>
							  <input name="CPF" type="text" class="form-control" placeholder="CPF" maxlength="12" minlength="12" required>
							</div>
							<?php 
							}
							?>
							
							
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
								require_once "../Models/Cliente.php";	
								$cliente = new Cliente();
								$cliente->setNome($_POST["nome"]);
								if($_POST['tipo'] == 2)
								{
									$cliente->setCPF($_POST["CPF"]);
								}
								$cliente->setTipo($_POST["tipo"]);
								
								updateCliente($cliente, $id);
								?>
									<script>
										window.setTimeout(function() 
										{
											window.location = '../Pages/clientes.php';
										}, 1);
									</script>
								<?php
							}
				?>
				
				</div>
			</div>
		</div>
	</body>
</html>
