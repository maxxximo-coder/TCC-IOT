<?php

Class Equipamentos{

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

	public function buscarCliente($cpf)
	{
		$dados = array();
		$cmd = $this->pdo->prepare('SELECT id_cliente, nome from cliente where cpf = :c');
		$cmd->bindValue(':c',$cpf);
		$cmd->execute();
		$dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
		if($cmd->rowCount($dados) > 0)
		{
			//print_r($dados);
			$this->id_cliente = $dados[0]['id_cliente'];
		}else{
			$this->id_cliente = 0;
			//echo 'aqui';
		}
		//exit;
		return $dados;
	}

	public function buscarMoradias($id_cliente)
	{
		$cmd = $this->pdo->prepare('SELECT id_moradia from moradia where id_cliente = :c');
		$cmd->bindValue(':c',$id_cliente);
		$cmd->execute();
		$moradias = $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $moradias;
	}

	public function cadatrar_equipamento($id_moradia, $nome, $informacoes)
	{
		$ok = 0;
		$cmd = $this->pdo->prepare('INSERT INTO equipamentos_sensor (id_moradia, nome, informacoes ) VALUES (:id, :n, :i)');
		$cmd->bindValue(':id',$id_moradia);
		$cmd->bindValue(':n',$nome);
		$cmd->bindValue(':i',$informacoes);
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

}