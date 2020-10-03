<?php 
	session_start();
	if(!isset($_SESSION['login']))
		{
			header('location: ../index.php');
		}
		$idUsuario = $_COOKIE['idUsuario'];
		
?>
<html>
    <head>
		<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Clientes</title>
		<link rel="icon" type="image/png" href="../Imgs/K.png">
		<link href="../Componets/css/cards.css" rel="stylesheet">
		<script type = "text/javascript" src = "../Componets/js/jquery-3.3.1.min.js"></script>
		<script type = "text/javascript" src = "../Componets/js/functions.js"></script>
		<script type = "text/javascript" src = "../Componets/js/function.js"></script>
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

        <div class="card-consultar">
				<div class = "col-md-10">	
					<?php
						require_once "../Database/functionsDB.php";
						$resultado = buscarCliente();
						
						if($resultado->rowCount() > 0)
						{
							echo "<table class ='table table-bordered'>";
							echo "<tr>";
							echo "<th>ID </th> <th>Nome </th> <th>CPF </th>  <th>Conta</th> <th></th> <th></th> <th></th> ";
							echo "</tr>";

							while($linha = $resultado->fetch())
								{
									echo"<tr>";
									echo"<td>".$linha['id']."</td>";
									echo"<td>".$linha['nome']."</td>";
									echo"<td>".$linha['CPF']."</td>";
									if($linha['tipo'] == 2 )								
									{
										echo"<td> Não possui</td>";
									}
									else
									{
										if($linha['divida'] == '' )								
										{
											echo"<td> R$ 0,00</td>";
										}
										else
										{
											echo"<td> R$ ".number_format($linha['divida'], 2 , ",", ".")."</td>";
										}
										
									}
									if($linha['id'] == 1)
									{
										echo"<td><button class='btn btn-warning btn-md' disabled><i class='fa fa-cog'></i></button>  </td>";
									}
									else
									{
										if($_SESSION['tipo'] == 1)
										{
											echo"<td> <a class='btn btn-warning btn-md' href='../Scripts/edit_cliente.php?id=".$linha['id']."' ><i class='fa fa-cog'></i></a>  </td>";
										}
										else if($_SESSION['tipo'] != 1 and  $linha['tipo'] == 2)
										{
											echo"<td> <a class='btn btn-warning btn-md' href='../Scripts/edit_cliente.php?id=".$linha['id']."' ><i class='fa fa-cog'></i></a>  </td>";
										}
										else
										{
											echo"<td><button class='btn btn-warning btn-md' disabled><i class='fa fa-cog'></i></button>  </td>";
										}	
										
									}
									if($linha['id'] == 1 or $linha['divida'] != '')
									{
										echo"<td><button class='btn btn-danger btn-md' disabled><i class='fa fa-trash'></i></button>  </td>";
									}
									else
									{
										echo"<td> <a class='btn btn-danger btn-md' href='../Scripts/rem_clientes.php?id=".$linha['id']."' ><i class='fa fa-trash'></i></a>  </td>";
									}
									
									if( $linha['tipo'] == 1 and $linha['divida'] != '' and $_SESSION['tipo'] == 1)
									{
										echo"<td> <a class='btn btn-success btn-md' href='../Scripts/receber_parcelas.php?id=".$linha['id']."' ><i class='fa fa-money-bill-alt'></i></a>  </td>";
									}	
									else
									{
										echo"<td></td>";
									}
									echo "</tr>";
								}
							echo "</table>";
						}	
					?>
					<br/>
					
					<div class="text-danger">*Não é possível excluir um cliente com uma conta em aberto</div>
					
				</div>
				<div class="col-6 d-flex justify-content-around">
					<a href="../Scripts/add_clientes.php" style="text-align: center">	
						<i class="fas fa-user-plus" " style="font-size:50px"></i>
						<p>Novo Cliente</p>
					</a>
					<a href="home.php" style="text-align: center">	
						<i class="fas fa-arrow-circle-left" " style="font-size:50px"></i>
						<p>Voltar</p>
					</a>
				</div>
          </div>
      </div>
    </div>
	</body>
</html>