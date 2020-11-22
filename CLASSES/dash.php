<?php

Class Dash{

	private $pdo;
	public $id_cliente;

	//Construtor
	public function __construct($dbname, $host, $usuario, $senha)
	{
		try
		{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $usuario, $senha);
		} catch(PDOException $e) 
		{
			echo "Erro com BD: ".$e->getMessage();
		} catch(Exception $e)
		{
			echo "Erro: ".$e->getMessage();
		}
	}
	//cadastrar
	public function cadastrar($id_cliente, $endereco)
	{
		//cadastrar
		$ok = 0;
		$cmd = $this->pdo->prepare("INSERT INTO dash (id_cliente, endereco) values (:id, :e)");
		$cmd->bindValue(":id",$id_cliente);
		$cmd->bindValue(":e",$endereco);
		$cmd->execute();
		$ok = $this->pdo->lastInsertId();
		if($ok <> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}
		
	

	public function buscarDadosUser($cpf)
	{
		$dados = array();
		$cmd = $this->pdo->prepare("SELECT * from cliente WHERE cpf = :c");
		$cmd->bindValue(":c",$cpf);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			$dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
			
			$this->id_cliente = $dados[0]['id_cliente'];
		}else
		{
			$this->id_cliente = 0;
		}
		return $dados;
	}

	public function buscarDash($id_cliente)
	{
		$dados = array();
		$cmd = $this->pdo->prepare("SELECT endereco from dash WHERE id_cliente = :c");
		$cmd->bindValue(":c",$id_cliente);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			$dados = $cmd->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
}
?>