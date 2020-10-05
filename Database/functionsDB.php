<?php
	require_once(__DIR__.'/configPDO.php');

	function executaSQL($sql)
	{
		try
		{
			$conexaoBD = DBConnect();
			$resultado = $conexaoBD->query($sql);
			return $resultado;
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarUsuario()
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM vendedor";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarUsuarioID($idUsuario)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM vendedor WHERE id='".$idUsuario."'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function deleteUsuario($idUsuario)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "DELETE FROM vendedor WHERE id='".$idUsuario."'";
			$resultado = $conexaoBD->query($sql);

			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
	function salvarUsuario($usuario)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "INSERT INTO vendedor (nome, CPF, login, senha, tipo)  VALUES ('". $usuario->getNome() ."','". $usuario->getCPF() ."','". $usuario->getLogin() ."','". $usuario->getSenha() ."','". $usuario->getTipo() ."')";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function updateUsuario($usuario, $idUsuario)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE vendedor SET nome = '". $usuario->getNome() ."', login = '". $usuario->getLogin() ."', senha = '". $usuario->getSenha() ."' WHERE id='".$idUsuario."'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function deleteProduto($idProduto)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "DELETE FROM produto WHERE id='".$idProduto."'";
			$resultado = $conexaoBD->query($sql);

			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarProdutoID($idProduto)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM produto WHERE id='".$idProduto."'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarCliente()
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM cliente";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarClienteID($idCliente)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM cliente WHERE id='".$idCliente."'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function deleteCliente($idCliente)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "DELETE FROM cliente WHERE id='".$idCliente."'";
			$resultado = $conexaoBD->query($sql);

			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
	function salvarCliente($cliente)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "INSERT INTO cliente (nome, CPF, tipo)  VALUES ('". $cliente->getNome() ."','". $cliente->getCPF() ."','". $cliente->getTipo() ."')";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function updateCliente($cliente, $idCliente)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE cliente SET nome = '". $cliente->getNome() ."', tipo = '". $cliente->getTipo() . "' WHERE id='".$idCliente."'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function receberParcela($cliente, $idCliente)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE cliente SET divida = '". $cliente->getDivida() . "' WHERE id='".$idCliente."'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
	function abrirCaixa($valor, $id_usuario_abertura, $data_caixa)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "INSERT INTO caixa (valor, aberto_fechado, id_usuario_abertura, data_caixa)  VALUES ('$valor', '1', '$id_usuario_abertura', '$data_caixa')";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarCaixa()
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM caixa";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarCaixaAberto()
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM caixa WHERE aberto_fechado='1'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function adcionarVendasCaixa($valor, $quantidade)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE caixa SET valor = '$valor ', qtd_total_vendas = '$quantidade' WHERE aberto_fechado = '1'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function fecharCaixa($id_usuario_fechamento, $idCaixa)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE caixa SET aberto_fechado = '0', id_usuario_fechamento = '$id_usuario_fechamento' WHERE id = '$idCaixa'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function buscarVendaCaixa($idCaixa)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM venda WHERE id_caixa = '$idCaixa'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
	function buscarProdutosVenda($id_vend)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "SELECT * FROM produtos_venda WHERE id_vend = '$id_vend'";
			$resultado = $conexaoBD->query($sql);
			return $resultado; 
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	function adcionarRecebido($valor)
	{
		try
		{
			$conexaoBD = DBConnect();
			$sql = "UPDATE caixa SET valor = '$valor ' WHERE aberto_fechado = '1'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
	
?>