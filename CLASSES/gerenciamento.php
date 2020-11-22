<?php

Class Gerenciamento{

	private $pdo;

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
		

	public function buscarStatus($id)
	{
		$status = '';
		$dados = array();
		$cmd = $this->pdo->prepare("SELECT status 
			                          from leitura_registro 
			                         WHERE data_hora = (select max(data_hora) 
			                                              from leitura_registro 
			                                             where id_equipamento = :i)");
		$cmd->bindValue(":i",$id);
		$cmd->execute();
		$dados = $cmd->fetch();
		
		//return $status;
		if($cmd->rowCount() > 0)
		{
			$status = $dados['status'];	
		}else
		{
			$status = 0;
		}

		if(($status) == 1)
		{
			$data_hora = date('Y-m-d H:i:s:u');
			$cmd = $this->pdo->prepare("INSERT INTO leitura_registro (id_equipamento, data_hora, valor,status) VALUES (:i, :d, :v, :s)");
			$cmd->bindValue(":i",$id);
			$cmd->bindValue(":d",$data_hora);
			$cmd->bindValue(":v",0);
			$cmd->bindValue(":s",0);
			$cmd->execute();
		}else
		{
			$data_hora = date('Y-m-d H:i:s:u');

			$cmd = $this->pdo->prepare("INSERT INTO leitura_registro (id_equipamento, data_hora, valor,status) VALUES (:i, :d, :v, :s)");
			$cmd->bindValue(":i",$id);
			$cmd->bindValue(":d",$data_hora);
			$cmd->bindValue(":v",0);
			$cmd->bindValue(":s",1);
			$cmd->execute();
		}

		return $status;
	}


}
?>