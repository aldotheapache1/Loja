<?php 
	class Cliente
	{
		private $nome;
		private $CPF;
		private $tipo;
		private $divida;
		
		public function setNome($nome)
		{
			$this->nome = $nome;
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function setCPF($CPF)
		{
			$this->CPF = $CPF;
		}
		public function getCPF()
		{
			return $this->CPF;
		}
		public function setTipo($tipo)
		{
			$this->tipo = $tipo;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function setDivida($divida)
		{
			$this->divida = $divida;
		}
		public function getDivida()
		{
			return $this->divida;
		}
	}
?>