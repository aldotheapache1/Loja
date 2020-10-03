<?php
session_start();
require_once '../Database/functionsDB.php';
require_once '../Database/configPDO.php';

$resultado_caixa = buscarCaixaAberto();

if($resultado_caixa->rowCount()!=1)
{
	header('location: ../Pages/caixa.php');
}
else
{
	$qtdCaixa = 0;

	$resultado_caixa = $resultado_caixa->fetch(PDO::FETCH_OBJ);
	$id_caixa = $resultado_caixa->id;

	$conectar = DBConnect();
	$pdo = DBConnect(); //pra não interferir no last id

	$id_vendedor = $_SESSION['id'];
	if($_POST['id_cliente'] != 'Selecione um cliente')
	{
		$id_cliente = $_POST['id_cliente'];
	}
	else
	{
		$id_cliente = 1;
	}

	$cliente = $conectar->query("SELECT * FROM cliente WHERE id = ". $id_cliente);
	if($cliente->rowCount() > 0)
		{
			while($linha = $cliente->fetch())
				{
					$tipo_cliente = $linha['tipo'];
				}
		} 

	if($tipo_cliente == 2 or $_POST['tipo_venda'] == 2)
	{
		//tabela caixa vai receber o valor total
		 if(count($_SESSION['carrinho']) == 0){
			}else{
			   $somaValorItem = 0;
			   foreach($_SESSION['carrinho'] as $id => $quantidade){
				   $sql   = $conectar->query("SELECT * FROM produto WHERE id= '$id'");
				   $listItem    = $sql->fetch(PDO::FETCH_OBJ);
				   if($listItem->quantidade>=$quantidade){
						$subTotal = $listItem->preco * $quantidade;
						$somaValorItem += $listItem->preco * $quantidade;
						$qtdCaixa = $qtdCaixa + $quantidade;
						$novaQtd =  $listItem->quantidade - $quantidade ;
						$comandoSQL = "UPDATE produto SET quantidade = '$novaQtd' WHERE id = $id;";
						$conectar->query($comandoSQL);
				   }
				   else{
					   
				   }
				}
			
				date_default_timezone_set('America/Sao_Paulo');
				$data	=  date('d-m-y');
				$hora	= date('h:i:s A');
				$sql = "INSERT INTO venda(valor, id_cliente, id_vendedor, data_venda, hora, tipo_venda, id_caixa) VALUES ('$somaValorItem', '$id_cliente', '$id_vendedor', '$data', '$hora', '2', '$id_caixa')";
				$conectar->query($sql);
				
				$valor = 0;
				$valor = $resultado_caixa->valor + $somaValorItem;
				$qtdCaixa = $qtdCaixa + $resultado_caixa->qtd_total_vendas;
				
				adcionarVendasCaixa($valor, $qtdCaixa);
				
				$id_venda = $conectar->lastInsertId();;
			}
			
			foreach($_SESSION['carrinho'] as $id => $quantidade){
				$sql = "INSERT INTO produtos_venda(id_vend, id_prod, prod_qtd) VALUES('$id_venda', '$id', '$quantidade')";
				
				
				$conectar->query($sql);
				header('location: ../Pages/caixa.php');
			}
	}

	else if($tipo_cliente == 1 and $_POST['tipo_venda'] == 1)
	{
		//ctabela cliente coluna divida vai receber o valor total
		if(count($_SESSION['carrinho']) == 0){
				}else{
				   $somaValorItem = 0;
				   foreach($_SESSION['carrinho'] as $id => $quantidade){
					   $sql   = $conectar->query("SELECT * FROM produto WHERE id= '$id'");
					   $listItem    = $sql->fetch(PDO::FETCH_OBJ);
					   if($listItem->quantidade>=$quantidade){
							$subTotal = $listItem->preco * $quantidade;
							$somaValorItem += $listItem->preco * $quantidade;
							$novaQtd =  $listItem->quantidade - $quantidade ;
							$comandoSQL = "UPDATE produto SET quantidade = '$novaQtd' WHERE id = $id;";
							$conectar->query($comandoSQL);
					   }
					   else{}
					}
				
					date_default_timezone_set('America/Sao_Paulo');
					$data	=  date('d-m-y');
					$hora	= date('h:i:s A');
					$sql = "INSERT INTO venda(valor, id_cliente, id_vendedor, data_venda, hora, tipo_venda, id_caixa) VALUES ('$somaValorItem', '$id_cliente', '$id_vendedor', '$data', '$hora', '1', '$id_caixa')";
					$sql2 = "UPDATE cliente SET divida='".$somaValorItem."' WHERE id =".$id_cliente;
					$conectar->query($sql);
					$pdo->query($sql2);
					$id_venda = $conectar->lastInsertId();
				}
				
				foreach($_SESSION['carrinho'] as $id => $quantidade){
					$sql = "INSERT INTO produtos_venda(id_vend, id_prod, prod_qtd) VALUES('$id_venda', '$id', '$quantidade')";
					
					
					$conectar->query($sql);
					header('location: ../Pages/caixa.php');
				}
	}
}

?>