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
		<title>Karoline Modas & Perfumaria - Editar Usuário</title>
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
				$resultado = buscarUsuarioID($id);
				for($i=0; $row = $resultado->fetch(); $i++)
				{
			?>
				<div class = "card-abrir">
					<form  action="edit_usuario.php?id=<?php echo $id ?>" method = "post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<label for = "nome">Nome </label>
							<input type = "text" class="form-control" id = "nome" name = "nome"  maxlength="50" required value="<?php echo $row['nome']; ?>" /> <br/>
							<label for = "nome">CPF </label>
							<input type = "text" class="form-control" id = "CPF" name = "CPF"  maxlength="50" disabled required value="<?php echo $row['CPF']; ?>" /> <br/>
							<label for = "login">Login </label>
							<input type = "text" class="form-control" id = "login" name = "login"  maxlength="20" required value="<?php echo $row['login']; ?>" /> <br/>
							<label for = "senha">Senha </label>
							<input name="senha" type="text" class="form-control" id = "senha" name = "senha" maxlength="20" required value="<?php echo $row['senha']; ?>" /> <br/>
							
							<div class="row mt-4">
								<div class="col-6">
									<a class="btn btn btn-warning btn-block " href="../Pages/usuarios.php">Voltar</a>
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
								require_once "../Models/Vendedor.php";	
								$usuario = new Vendedor();
								$usuario->setNome($_POST["nome"]);
								$usuario->setLogin($_POST["login"]);
								$usuario->setSenha($_POST["senha"]);
								//$usuario->setTipo($_POST["tipo"]);
								
								updateUsuario($usuario, $id);
								?>
									<script>
										window.setTimeout(function() 
										{
											window.location = '../Pages/usuarios.php';
										}, 100);
									</script>
								<?php
							}
				?>
				
				</div>
			</div>
		</div>
	</body>
</html>
