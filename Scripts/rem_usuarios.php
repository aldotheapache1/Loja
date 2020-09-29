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
		<title>Karoline Modas & Perfumaria - Excluir Usuário</title>
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

		
		<?php 
			require_once "../Database/functionsDB.php";
			$id = $_GET['id'];
			deleteUsuario($id);
			?>
				<script>
					window.setTimeout(function() 
					{
						window.location = '../Pages/usuarios.php';
					}, 1000);
				</script>
		<?php
		?>
		<script type="text/javascript">
		   alert("Usuário excluído com sucesso!");
		</script>
	</body>
</html>
