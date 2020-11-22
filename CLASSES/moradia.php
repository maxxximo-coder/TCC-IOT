<?php

Class Moradia{

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
	public function cadastrar($id_cliente, $numero, $rua, $municipio, $uf)
	{
		//cadastrar
		$ok = 0;
		$cmd = $this->pdo->prepare("INSERT INTO moradia (id_cliente, numero, rua, municipio, uf) values (:id, :n, :r, :m, :u)");
		$cmd->bindValue(":id",$id_cliente);
		$cmd->bindValue(":n",$numero);
		$cmd->bindValue(":r",$rua);
		$cmd->bindValue(":m",$municipio);
		$cmd->bindValue(":u",$uf);
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

}
?>