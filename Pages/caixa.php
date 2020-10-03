<?php 
	session_start();
	if(!isset($_SESSION['login']))
		{
			header('location: ../index.php');
		}
		
	require_once '../Database/configPDO.php';	
	require_once'../Database/functionsDB.php';	

	$id_fechamento = $_SESSION['id'];
	$resultado_caixa = buscarCaixaAberto();
	$caixa = $resultado_caixa->fetch(PDO::FETCH_OBJ);
	if($resultado_caixa->rowCount() == 1)
	{
		$_SESSION['aberto_fechado'] = 1;
		$idCaixa = $caixa->id;
		$resultado_venda = buscarVendaCaixa($idCaixa);
		
	}

?>
<html>
  <head>
		<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Caixa</title>
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
		<div class="row">
			<div class="col-4">
					<form method="post" action="caixa.php">
					<?php
						if(!isset($_SESSION['aberto_fechado']))
						{
							echo "<div class='form-group' style='text-align: center;'>";
								echo "<input name='valor_abertura' type='number' class='form-control' style='text-align: center; margin-top: 100px;' min='0' placeholder='Valor de abertura do caixa' maxlength='50' required>";
								echo "<button class='btn btn btn-primary' type='submit' style='margin-top: 50px;' >Abrir caixa</button>";
							echo "</div>";
						}
						else
						{
							echo "<div class='form-group' style='text-align: center;'>";
									echo "<a href='caixa.php?a=1' class='btn btn btn-Danger' style='margin-top: 100px;'>Fechar caixa</a>";
							echo "</div>";
						}
					?>
					</form>
					
					<?php
						if(!empty($_POST))
							{
								date_default_timezone_set('America/Sao_Paulo');
								$valor = $_POST['valor_abertura'];
								
								$_SESSION['valor'] = $valor;
								$_SESSION['aberto_fechado'] = 1;
								$_SESSION['id_usuario_abertura'] = $_SESSION['id'];
								$_SESSION['data_caixa'] = date('d-m-y');	
								abrirCaixa($valor, $id_fechamento, $_SESSION['data_caixa']);

								header('Location: caixa.php');
							}
							if(!empty($_GET['a']))
								{
									fecharCaixa($id_fechamento, $idCaixa);
									unset($_SESSION['aberto_fechado']);
									unset($_SESSION['valor']);
									unset($_SESSION['id_usuario_abertura']);
									unset($_SESSION['data_caixa']);
									header('Location: caixa.php');
								}	
					?>	
	
			</div>
			<div class="col-8" >
			<?php
			if($resultado_caixa->rowCount() == 1)
			{
				$resultado = buscarCaixaAberto();
				$valor_total_vendas = 0;
				
				echo "<table class ='table table-bordered'>";
					echo "<tr>";
						echo "<th style='background-color: #17a2b8' >Produto</th> <th style='background-color: #17a2b8'>Tipo de venda</th> <th style='background-color: #17a2b8'>Vendedor</th> <th style='background-color: #17a2b8'>Cliente</th> <th style='background-color: #17a2b8'>Qtd</th> <th style='background-color: #17a2b8'>Valor</th>";
					echo "</tr>";
				
				if($resultado_venda->rowCount() > 0)
					{
						while($linha = $resultado_venda->fetch())
							{
								$valor_total_vendas = $valor_total_vendas + $linha['valor'];
								//$id_vend =	$linha['id'];
								$resultados_produtos_venda = buscarProdutosVenda($linha['id_venda']);
								
								if($resultados_produtos_venda->rowCount() > 0)
									{	
										while($linha2 = $resultados_produtos_venda->fetch())
											{
												$produto = buscarProdutoID($linha2['id_prod']);
												$produto = $produto->fetch(PDO::FETCH_OBJ);
													echo"<tr>";
														echo"<td>". $produto->nome ."</td>";
														
														if($linha['tipo_venda'] == 2)
														{
															echo"<td> À vista</td>";
														}
														else
														{
															echo"<td> A prazo</td>";
														}
														$vendedor = buscarUsuarioID($linha['id_vendedor']);
														$vendedor = $vendedor->fetch(PDO::FETCH_OBJ);
														echo"<td>". $vendedor->nome ."</td>";
														$cliente = buscarClienteID($linha['id_cliente']);
														$cliente = $cliente->fetch(PDO::FETCH_OBJ);
														echo"<td>". $cliente->nome ."</td>";
														echo"<td>".$linha2['prod_qtd']."</td>";
														echo"<td >". number_format($produto->preco, 2, ',', '.') ."</td>";
													echo "</tr>";
											
											}	
									}
							}
					}	

					echo "<tr>";
						echo"<td id='total' colspan='6'>Total de vendas: R$" . number_format($valor_total_vendas, 2, ',', '.')." </td>";
					echo "</tr>";
		
					if($resultado->rowCount() > 0)
						{	
							while($linha = $resultado->fetch())
								{
									echo "<tr>";
										echo"<td id='total' style='background-color: #70e68b' colspan='6'>Total em caixa: R$" . number_format($linha['valor'], 2, ',', '.')." </td>";
									echo "</tr>";

								}
							echo "</table>";
						}
			}	
			?>
			</div>
		</div>	
	</body>
</html>