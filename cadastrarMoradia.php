<?PHP
session_start();
require_once 'CLASSES/moradia.php';
$moradia = new Moradia("rpi","localhost","root","");

	if(isset($_POST['cpf']))
	{
		$cpf = addslashes($_POST['cpf']);
		$dados = $moradia->buscarDadosUser($cpf);
		
		if($moradia->id_cliente == 0)
		{
			?>
			<script type="text/javascript">
				alert('Cliente não encontrado');
			</script>
			<?php
		}

	}

	if(isset($_POST['id_cliente']))
	{
		$id_cliente = addslashes($_POST['id_cliente']);
		$numero     = addslashes($_POST['numero']);
		$rua        = addslashes($_POST['rua']);
		$municipio  = addslashes($_POST['municipio']);
		$uf         = addslashes($_POST['uf']);
		
		if(!empty($numero) && !empty($rua) && !empty($municipio) && !empty($uf))
	    {
		
			if($moradia->cadastrar($id_cliente, $numero, $rua, $municipio, $uf))
		    {
			?>
			<script type="text/javascript">
				alert('Moradia cadastrada com sucesso!');
			</script>
			<?php
		    }else
			{ ?>
			 <script type="text/javascript">
				alert('<?php echo $moradia->mensagem;?>');
			</script>
			<?php	
			}
			
		}else
		    {
			?>
			<script type="text/javascript">
				alert('Preencha todos os campos!');
			</script>
			<?php
		    }
	    
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema Raspberry IOT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/cadastrarMoradia.css"/>
	<link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body>
	<nav>
		<ul>
			<?php 
			if(isset($_SESSION['id_cliente']) AND $_SESSION['id_cliente'] == 1)
			{
				?>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="cadastrarCliente.php">Cliente</a></li>
				<li><a href="cadastrarMoradia.php">Moradia</a></li>
				<li><a href="cadastrarEquipamento.php">Equipamento</a></li>
				<li><a href="cadastrarDash.php">Dash</a></li>
				<?php 
			}
			?>
			<?php
			if(isset($_SESSION['id_cliente']))
			{
				?>
				<li><a href="sair.php">Sair</a></li>
				<?php
			}else
			{
				?>
				<li><a href="entrar.php">Entrar</a></li>
				<?php
			}
			?>
		</ul>
	</nav>
	<form method="POST">
		<h1>DIGITE O CPF CLIENTE</h1>

		<label for="cpf">DIGITE O CPF CLIENTE</label>
		<input type="text" name="cpf" id="cpf">
		<input type="submit" class="btn btn-primary btn-xs active" value="pesquisar">
		<a href="index.php" class="btn btn-secondary btn-xs active" role="button" aria-pressed="true">Voltar</a>

		<?php
		if(isset($dados) and count($dados) > 0)
		{
			?>
			<p id="nome_cliente">
				<?php
				echo 'Cliente localizado: '.$dados[0]['nome'];
				?>
			</p>
				<?php
		}
		?>
	</form>
	<?php

	if(isset($dados) and count($dados) > 0)
	{
		?>
		<form method="POST">
			<h1>CADASTRO DE MORADIA</h1>
			<input type="hidden" name="id_cliente" value="<?php echo $dados[0]['id_cliente']; ?>">
			<label for="numero">NUMERO</label>
			<input type="text" name="numero" id="numero">

			<label for="rua">RUA</label>
			<input type="text" name="rua" id="rua">

			<label for="municipio">MUNICIPIO</label>
			<input type="text" name="municipio" id="municipio">

			<label for="uf">UF</label>
			<input type="text" name="uf" id="uf">
			
			<input type="submit" class="btn btn-primary btn-xs active" value="Cadastrar">
		</form>
		<?php
	}
	?>
</body>
</html>



