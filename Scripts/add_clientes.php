<?php 
	session_start();
	if(!isset($_SESSION['login']))
		{
			header('location:Index.php');
		}
	
?>
<html>
  <head>
		<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Adicionar Cliente</title>
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
        <div class="card-abrir">
              <div class="row">
                <div class="col">
                  
                  <form method="post" action="add_clientes.php">
                    <div class="form-group">
                      <label>Nome</label>
                      <input name="nome" type="text" class="form-control" placeholder="Nome" maxlength="50" required>
                    </div>
					<div class="form-group">
                      <label>CPF</label>
                      <input name="CPF" type="text" class="form-control" placeholder="CPF" maxlength="12" minlength="12" required>
                    </div>
                    <div class="form-group">
						<input type="radio" id="tipo" name="tipo" value="2" checked="checked">
						<label for="tipo">À Vista</label><br>
						<input type="radio" id="tipo" name="tipo" value="1">
						<label for="tipo">A prazo</label><br>
                    </div>
                    <div class="row mt-2">
                      <div class="col-6">
                        <a class="btn btn btn-warning btn-block" href="../Pages/clientes.php">Voltar</a>
                      </div>
                      <div class="col-6">
                        <button class="btn btn btn-primary btn-block" type="submit">Criar</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
	<?php
			if(!empty($_POST))
			{
				require_once "../Database/functionsDB.php";
				require_once "../Models/Cliente.php";	
				$cliente = new Cliente();
				$cliente->setNome($_POST["nome"]);
				$cliente->setCPF($_POST["CPF"]);
				$cliente->setTipo($_POST["tipo"]);
				salvarCliente($cliente);
				?>
				<script>
					window.setTimeout(function() {
												window.location = '../Pages/clientes.php';
											  }, 1);
				</script>
			<?php
			}			
			?>

	</body>
</html>