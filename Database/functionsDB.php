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
			$sql = "UPDATE cliente SET nome = '". $cliente->getNome() ."', tipo = '". $cliente->getTipo() ."', divida = '". $cliente->getDivida() ."' WHERE id='".$idCliente."'";
			$conexaoBD->exec($sql);
		}
		catch(PDOException $e)
		{
			die("erro ao conectar: " . $e->getMessage());
		}
	}
	
?>