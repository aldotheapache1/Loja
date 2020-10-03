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
		<title>Karoline Modas & Perfumaria - Home</title>
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
		<!--
		<form class="form-inline">
			  <div class="md-form dark my-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			  </div>
			  <button href="#!" class="btn btn-outline-dark btn-md my-0 ml-sm-2" type="submit">Search</button>
		</form>
		-->
		<div class="container">    
			<div class="row">
				<div class="card-consultar">
					<div class="card-consultar-chamado">
						<div class = "col-md-10">	
							<div class="col-6 d-flex justify-content-around">
								<a href="../Scripts/add_produtos.php" style="text-align: center">	
									<i class="fas fa-cart-plus" " style="font-size:50px"></i>
									<p>Adicionar novo Produto</p>
								</a>
								<a href="home.php" style="text-align: center">	
									<i class="fas fa-arrow-circle-left" " style="font-size:50px"></i>
									<p>Voltar</p>
								</a>
							</div>					
					<?php
					require_once "../Database/functionsDB.php";
					$consultaSQL = "SELECT * FROM produto";
					$resultado = executaSQL($consultaSQL);
					
						
						if($resultado->rowCount() > 0)
						{
							echo "<table class ='table table-bordered'>";
							echo "<tr>";
							echo "<th>Nome </th> <th>Preço </th> <th>Tamanho </th> <th>Categoria </th> <th>Qtd </th> ";
							echo "</tr>";
						
							while($linha = $resultado->fetch())
								{
									$imagemSingle =executaSQL("SELECT * FROM imagens_produto WHERE produto_id = $linha[id] LIMIT 1");
									$imagemSingle = $imagemSingle->fetch()['imagem'];
									
									echo"<tr>";
									echo"<td>".$linha['nome']."</td>";
									echo"<td> R$ ".number_format($linha['preco'], 2 , ",", ".")."</td>";
									echo"<td>".$linha['tamanho']."</td>";
									echo"<td>".$linha['categoria']."</td>";
									echo"<td>".$linha['quantidade']."</td>";
									echo "<td><img src='../Imgs/imagens/".$imagemSingle."' width='120'></img></td>";
									echo"<td> <a class='btn btn-primary btn-md'  href='nova_venda.php?acao=adItem&id=".$linha['id']."' ><i class='fa fa-cart-plus'></i></a>  </td>";
									echo"<td> <a class='btn btn-warning btn-md'  href='../Scripts/edit_produto.php?id=".$linha['id']."'><i class='fa fa-cog'></i> </a></td>";
									if($_SESSION['tipo'] == 1)
									{
										echo"<td> <a class='btn btn-danger btn-md'  href='../Scripts/rem_produto.php?id=".$linha['id']."' ><i class='fa fa-trash'></i></a>  </td>";
									}
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
			</div>
  </body>
</html>