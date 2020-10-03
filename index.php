<?php 
	session_start();
	if(isset($_SESSION['login']))
		{
			header('location: ../Loja/Pages/home.php');
		}
	
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Karoline Modas & Perfumaria - Login</title>
	<link rel="icon" type="image/png" href="Imgs/K.png">
	<link href="Componets/css/cards.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	

  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">
        <img src="Imgs/K.png" width="25" height="35" class="d-inline-block align-top" alt="">
        Karoline Modas & Perfumaria
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Acesso ao Sistema
            </div>
            <div class="card-body">
              <form action="index.php" method="post">
                <div class="form-group">
                  <input name="login" type="login" class="form-control" placeholder="Login" required>
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                </div>
				
				<!--  
				<input type="radio" id="tipoLogin" name="tipoLogin" value="1" checked="checked">
				<label for="tipo">Administrador</label><br>
				<input type="radio" id="tipoLogin" name="tipoLogin" value="0">
				<label for="tipo">Usuário</label><br>
				-->
				
                <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
              </form>
			  <?php
				if(!empty($_POST))
					{
						require_once'Database/functionsDB.php';
						$login = $_POST['login'];
						$senha = $_POST['senha'];

						$sql = "select * from vendedor where login = '$login' and senha = '$senha'";

						$resultado = executaSQL($sql);
						if($resultado->rowCount() > 0)
							{
								$linha = $resultado->fetch();
								session_start();
								$_SESSION['login'] = $login;
								$_SESSION['senha'] = $senha;
								$_SESSION['nome'] = $linha['nome'];
								$_SESSION['CPF'] = $linha['CPF'];
								$_SESSION['tipo'] = $linha['tipo'];
								$_SESSION['id'] = $linha['id'];

								setcookie('nomeUsuario',$linha['nome']);
								setcookie('tipoUsuario',$linha['tipo']);
								setcookie('idUsuario',$linha['id']);
								header('Location: ../Loja/Pages/home.php');
							}
						else
							{
								 echo '<div class="text-danger">';
								 echo 'Usuário ou senha inválido(s)';
								 echo '</div>';
							}
					}

				?>
            </div>
          </div>
        </div>
    </div>
		<div class="footer">
		  <p>&copy; Karoline Modas & Perfumaria</p>
		</div>
	</body>
</html>