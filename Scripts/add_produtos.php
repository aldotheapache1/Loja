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
		<title>Karoline Modas & Perfumaria - Adicionar Produto</title>
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
                  
                  <form enctype="multipart/form-data" method="post" >
                    <div class="form-group"> 
                      <input name="nome" type="text" class="form-control" placeholder="Nome" maxlength="50" required>
                    </div>
					<div class="form-group sm">
                      <input name="preco" type="number" class="form-control" placeholder="Preço" step="any" required>
                    </div>
					<div class="form-group">
                      <input name="tamanho" type="text" class="form-control" placeholder="Tamanho" required>
                    </div> 

					<div class="form-group">
						<input type="radio" id="categoria" name="categoria" value="Camisa" checked="checked">
						<label for="categoria">Camisa</label><br>
						<input type="radio" id="categoria" name="categoria" value="Calça">
						<label for="categoria">Calça</label><br>
						<input type="radio" id="categoria" name="categoria" value="Vestidos">
						<label for="categoria">Vestidos</label><br>
						<input type="radio" id="categoria" name="categoria" value="Blusas">
						<label for="categoria">Blusas</label><br>
                    </div>
					<div class="form-group">
                      <input name="quantidade" type="number" class="form-control" placeholder="Quantidade" required>
                    </div>   
					<div class="form-group">
						<input type="file" name="arquivo[]" class="form-control" multiple required>
					</div>
                    <div class="row mt-2">
                      <div class="col-6">
                        <a class="btn btn btn-warning btn-block" href="../Pages/produtos.php">Voltar</a>
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
		require_once'../Database/functionsDB.php';
		require_once('../Database/configPDO.php');
			if ($_POST)
			{     
				$nome  = $_POST["nome"];
				$preco = $_POST["preco"];
				$tamanho = $_POST["tamanho"];
				$categoria = $_POST["categoria"];
				$quantidade = $_POST["quantidade"];

				$imagens = array();
				$amountFiles = count($_FILES['arquivo']['name']);
				if($_FILES['arquivo']['name'][0] != ''){

					for($i =0; $i < $amountFiles; $i++){
						$imagemAtual = ['type'=>$_FILES['arquivo']['type'][$i],
						'size'=>$_FILES['arquivo']['size'][$i]];

					}
				}
				
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['tmp_name'=>$_FILES['arquivo']['tmp_name'][$i],
						'name'=>$_FILES['arquivo']['name'][$i]];
					
					$formatoArquivo = explode('.',$imagemAtual['name']);
					$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
					if(move_uploaded_file($imagemAtual['tmp_name'],'../Imgs/imagens/'.$imagemNome))
					{
						$imagens[] = $imagemNome;
					}
				}
				
				//$diretorio = $destino;
				//$sql = "INSERT INTO produto (nome, preco, tamanho, categoria, diretorio, quantidade) VALUES ('$nome','$preco','$tamanho','$categoria','$diretorio', '$quantidade')";
				$sql = "INSERT INTO produto (nome, preco, tamanho, categoria, quantidade) VALUES ('$nome','$preco','$tamanho','$categoria', '$quantidade')";
				executaSQL($sql);
				
				$resultado = executaSQL("SELECT * FROM produto WHERE nome ='".$nome."'");
				if($resultado->rowCount() > 0)
				{
					while($linha = $resultado->fetch())
						{
							$lastId = $linha['id'];
						}
				}
				
				foreach ($imagens as $key => $value) {
					executaSQL("INSERT INTO imagens_produto VALUES (null,$lastId,'$value')");
				}
				
				?>
				<script>
					window.setTimeout(function() {
												window.location = '../Pages/produtos.php';
											  }, 1);
				</script>
			<?php
			}			
			?>
	</body>
</html>