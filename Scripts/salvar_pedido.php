<?php
session_start();
require_once '../Database/configPDO.php';
$conectar = DBConnect();

$id_vendedor = $_SESSION['id'];
if($_POST['id_cliente'] != 'Selecione um cliente')
{
	$id_cliente = $_POST['id_cliente'];
}
else
{
	$id_cliente = 1;
}

 if(count($_SESSION['carrinho']) == 0){
    }else{
	   $somaValorItem = 0;
	   foreach($_SESSION['carrinho'] as $id => $quantidade){
		   $sql   = $conectar->query("SELECT * FROM produto WHERE id= '$id'");
		   $listItem    = $sql->fetch(PDO::FETCH_OBJ);
		   $subTotal = $listItem->preco * $quantidade;
		   $somaValorItem += $listItem->preco * $quantidade;
		   $novaQtd =  $listItem->quantidade - $quantidade ;
		   $comandoSQL = "UPDATE produto SET quantidade = '$novaQtd' WHERE id = $id;";
		   $conectar->query($comandoSQL);
		}
	
		date_default_timezone_set('America/Sao_Paulo');
		$data_hora	=  date('d/m/Y \à\s H:i:s');
		$data_hora	= date('d-m-y h:i:s A');
		$sql = "INSERT INTO venda(valor, id_cliente, id_vendedor, data_hora) VALUES ('$somaValorItem', '$id_cliente', '$id_vendedor', '$data_hora')";
		$conectar->query($sql);
		$id_venda = $conectar->lastInsertId();;
    }
	
    foreach($_SESSION['carrinho'] as $id => $quantidade){
		$sql = "INSERT INTO produtos_venda(id_vend, id_prod, prod_qtd) VALUES('$id_venda', '$id', '$quantidade')";
		
		
        $conectar->query($sql);
        //header('location: ../Pages/produtos.php');
    }

?>