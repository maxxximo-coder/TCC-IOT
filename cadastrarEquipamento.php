<?php
session_start();
require_once 'CLASSES/equipamentos.php';
$eq = new Equipamentos("rpi","localhost","root","");

if(isset($_POST['cpf']))
{
	$cpf = addslashes($_POST['cpf']);
	$dados = $eq->buscarCliente($cpf);


	if($eq->id_cliente <> 0)
	{
		$moradias = $eq->buscarMoradias($dados[0]['id_cliente']);
	}
	else
	{
		?>
		<script type="text/javascript">
			alert('Cliente não encontrado');
		</script>
		<?php
	}
}

if(isset($_POST['moradia']))
{
	$id_moradia  = $_POST['moradia'];
	$nome        = $_POST['nome'];
	$informacoes = $_POST['informacoes'];
	
	if(!empty($nome) && !empty($informacoes))
	    {
		
			if($eq->cadatrar_equipamento($id_moradia,$nome, $informacoes))
	        {
		    ?>
		    <script type="text/javascript">
			alert('Equipamento cadastrado com sucesso!');
		    </script>
		    <?php
		    }else
			{ ?>
			 <script type="text/javascript">
				alert('<?php echo $eq->mensagem;?>');
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
	<link rel="stylesheet" href="CSS/cadastrarEquipamento.css"/>
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
		<h1>BUSCAR CLIENTE</h1>

		<label for="nome">CPF</label>
		<input type="text" name="cpf" id="cpf">		
		<input type="submit" class="btn btn-primary btn-xs active" value="pesquisar">
		<a href="index.php" class="btn btn-secondary btn-xs active" role="button" aria-pressed="true">Voltar</a>
	</form>

	<?php

	if($eq->id_cliente <> 0)
	{
		?>
		<form method="POST">

			<p> Cliente encontrado: <?php  echo $dados['0']['nome'];?></p>
			<h1>CADASTRO DE EQUIPAMENTO</h1>
			<label for="moradia">ID MORADIA ENCONTRADO</label>

			<select id="moradia" name="moradia">
				<?php
				for ($i=0; $i < count($moradias); $i++)
				{ 
					?>
					<option value="<?php echo $moradias[$i]['id_moradia'];?>">
						<?php echo $moradias[$i]['id_moradia'];?>
					</option>
					<?php
				}

				?>
			</select>


			<label for="nome">NOME</label>
			<input type="text" name="nome" id="nome">

			<label for="informacoes">INFORMAÇÕES</label>
			<input type="text" name="informacoes" id="informacoes">
			
			<input type="submit" class="btn btn-primary btn-xs active" value="Cadastrar">
		</form>
		<?php
	}
	?>
</body>
</html>



