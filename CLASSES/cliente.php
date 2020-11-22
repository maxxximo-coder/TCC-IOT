<?php

Class Cliente{

	private $pdo;
	public $mensagem;

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
	public function cadastrar($nome, $cpf, $rg, $telefone, $email, $senha)
	{
		//Antes de cadastrar verificar se ja esta cadastrado
		$cmd = $this->pdo->prepare("SELECT id_cliente from cliente WHERE email = :e");
		$cmd->bindValue(":e",$email);
		$cmd->execute();
		if($cmd->rowCount() > 0)//veio id
		{
			$this->mensagem = 'Email já cadastro!';
			return false;
		}else//nao veio id
		{
			$cmd = $this->pdo->prepare("SELECT cpf from cliente WHERE cpf = :c");
			$cmd->bindValue(":c",$cpf);
			$cmd->execute();
			if($cmd->rowCount() > 0)//veio id
			{
				$this->mensagem = 'CPF já cadastrado';
				return false;
			}else
			{
				$cmd = $this->pdo->prepare("SELECT rg from cliente WHERE rg = :r");
				$cmd->bindValue(":r",$rg);
				$cmd->execute();
				if($cmd->rowCount() > 0)//veio id
				{
					$this->mensagem = 'RG já cadastrado';
					return false;
				}
			}
			//cadastrar
			$cmd = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, rg, telefone, email, senha) values (:n, :c, :r, :t, :e, :s)");
			$cmd->bindValue(":n",$nome);
			$cmd->bindValue(":c",$cpf);
			$cmd->bindValue(":r",$rg);
			$cmd->bindValue(":t",$telefone);
			$cmd->bindValue(":e",$email);
			$cmd->bindValue(":s",md5($senha));
			$cmd->execute();
			return true;
		}
		
	}

	//logar
	public function entrar($email, $senha)
	{
		//echo md5('123'); primeira senha deve ser cadastrada mnaualmente ja que tela de cadastro so fica visivel para usuario master
		$cmd = $this->pdo->prepare("SELECT * from cliente WHERE email = :e AND senha = :s");
		$cmd->bindValue(":e",$email);
		$cmd->bindValue(":s",md5($senha));
		$cmd->execute();
		if($cmd->rowCount() > 0)//se foi encontrado essa pessoa
		{
			$dados = $cmd->fetch();
			session_start();

			$_SESSION['id_cliente'] = $dados['id_cliente'];
			
			return true;//encontrada
		}else
		{
			return false;//não encontrada
		}
	}

	public function buscarDadosUser($id)
	{
		$cmd = $this->pdo->prepare("SELECT * from usuarios WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$dados = $cmd->fetch();
		return $dados;
	}

	public function buscarEndereco($id)
	{
		$endereco = '';
		$cmd = $this->pdo->prepare("SELECT endereco from dash WHERE id_cliente = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$dados = $cmd->fetch();
		$endereco = $dados['endereco'];
		return $endereco;
	}

	public function buscarDadosClientes()
	{
		$dados = array();
		$cmd = $this->pdo->query("SELECT x.id_cliente
									   , x.nome
									   , x.tot_moradias
									   , count(eq.id_equipamento) tot_equipamentos
								   from( SELECT c.id_cliente
									          , c.nome
									          , count(m.id_cliente) tot_moradias
									       FROM clientE c
									       left join moradia m 
									         on c.id_cliente = m.id_cliente
									      group by c.id_cliente
									          , c.nome) as x
									left join moradia mo
								     on mo.id_cliente = x.id_cliente
								     left join equipamentos_sensor eq
								  on eq.id_moradia = mo.id_moradia
								   group by x.id_cliente
									      , x.nome
									      , x.tot_moradias");
		if($cmd->rowCount() > 0)
		{
			$dados = $cmd->fetchAll(PDO::FETCH_ASSOC);	
		}
		return $dados;
	}

	public function excluirCliente($id_cliente)
	{
		$cmd = $this->pdo->prepare("DELETE FROM cliente where id_cliente = :c");
		$cmd-> bindValue(':c',$id_cliente);
		$cmd->execute();
	}
}
?>