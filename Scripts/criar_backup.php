<?php
	session_start();
	if(!isset($_SESSION['login']))
		{
			header('location: ../index.php');
		}
		
	// Incluindo o autoload do Composer para carregar a biblioteca
	require_once '../vendor/autoload.php';

	// Incluindo a classe que criamos
	require_once '../Models/Backup.php';
?>
	<html>
		<head>
			<meta charset="utf-8" />
			<title>Karoline Modas & Perfumaria -Backup</title>
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
				<div class="card-header">
					Deseja criar um Backup?
				</div>
				<div class="row">
					<div class="card-abrir">
						<div class="row">
							<div class="col">
								<form method="post" action="criar_backup.php">
									<div class="row mt-2">
										<div class="col-6">
											<a class="btn btn btn-warning btn-block" href="../Pages/home.php">Voltar</a>
										</div>
										<div class="col-6">
											<a class="btn btn btn-primary btn-block"  href="criar_backup.php?id=99">Criar Backup</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer">
				<p>&copy; Karoline Modas & Perfumaria</p>
			</div>
		</body>	
	</html>
<?php
	if(isset($_GET['id']) == 99)
	{
		// Como a geração do backup pode ser demorada, retiramos
		// o limite de execução do script
		set_time_limit(0);

		// Utilizando a classe para gerar um backup na pasta 'backups'
		// e manter os últimos dez arquivos
		$backup = new BackupDatabase('../backups', 10);
		$backup->setDatabase('localhost', 'Loja', 'root', '');
		$backup->generate();
		?>
		<script>
			window.setTimeout(function() {
										window.location = '../Pages/home.php';
										}, 5000);
		</script>
		<?php
	}
?>