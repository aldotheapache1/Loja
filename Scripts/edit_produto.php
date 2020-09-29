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
		<title>Karoline Modas & Perfumaria - Editar Produto</title>
		<link rel="icon" type="image/png" href="../Imgs/K.png">
		<link href="../Componets/css/cards.css" rel="stylesheet">
		<link href="../Componets/css/style.css" rel="stylesheet">
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
				$resultado = buscarProdutoID($id);
				for($i=0; $row = $resultado->fetch(); $i++)
				{
					$pegaImagens = executaSQL("SELECT * FROM `imagens_produto` WHERE produto_id = $id");
					$pegaImagens = $pegaImagens->fetchAll();
			?>

				<div class = "card-abrir">

					<form  method="post" >
                    <div class="form-group"> 
					  <label for = "nome">Nome </label>
                      <input name="nome" type="text" class="form-control" maxlength="50" value="<?php echo $row['nome']; ?>" required>
                    </div>
					<div class="form-group sm">
					  <label for = "nome">Preço </label>
                      <input name="preco" type="number" class="form-control" step="any" value="<?php echo $row['preco']; ?>" required>
                    </div>
					<div class="form-group">
					  <label for = "nome">Tamanho </label>
                      <input name="tamanho" type="text" class="form-control" value="<?php echo $row['tamanho']; ?>" required>
                    </div> 

					<div class="form-group">
					  <label for = "nome">Quantidade </label>
                      <input name="quantidade" type="number" class="form-control" value="<?php echo $row['quantidade']; ?>" required>
                    </div>   
                    <div class="row mt-2">
                      <div class="col-6">
                        <a class="btn btn btn-warning btn-block" href="../Pages/produtos.php">Voltar</a>
                      </div>
                     <div class="col-6">
							<input type = "submit"  class="btn btn btn-primary btn-block" name='Salvar' value = "Salvar"/> <br/>
						</div>
                    </div>
                  </form>
					<div class="boxes">
						<?php
							foreach ($pegaImagens as $key => $value){
						?>
						<div class="box-single-wraper">
							<div style="border: 1px solid #ccc;padding:8px 15px;">
								<div style="width: 100%;float: left;" class="box-imgs">
									<img class="img-square" src="../Imgs/imagens/<?php echo $value['imagem'] ?>" />
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php 
					} 
							if(!empty($_POST))
							{
								$nome  = $_POST["nome"];
								$preco = $_POST["preco"];
								$tamanho = $_POST["tamanho"];
								$quantidade = $_POST["quantidade"];
								
								$sql = "UPDATE produto SET nome = '$nome', preco = '$preco', tamanho = '$tamanho', quantidade = '$quantidade' WHERE id = $id;";
								executaSQL($sql);
								?>
									<script>
										window.setTimeout(function() 
										{
											window.location = '../Pages/produtos.php';
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
