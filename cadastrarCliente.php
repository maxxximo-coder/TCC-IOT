<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema Raspberry IOT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/cadastrarCliente.css"/>
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
		<h1>CADASTRO DE CLIENTE</h1>

		<label for="nome">NOME</label>
		<input type="text" name="nome" id="nome">

		<label for="cpf">CPF</label>
		<input type="text" name="cpf" id="cpf" min="1" max="11">

		<label for="rg">RG</label>
		<input type="text" name="rg" id="rg">

		<label for="telefone">TELEFONE</label>
		<input type="text" name="telefone" id="telefone">

		<label for="email">EMAIL</label>
		<input type="email" name="email" id="email">

		<label for="senha">SENHA</label>
		<input type="password" name="senha" id="senha">

		<label for="confSenha">CONFIRMAR SENHA</label>

		<input type="password" name="confSenha" id="confSenha">
		
		<input type="submit" class="btn btn-primary btn-xs active" value="Cadastrar">
		<a href="index.php" class="btn btn-secondary btn-xs active" role="button" aria-pressed="true">Voltar</a>



	</form>
</body>
</html>


<!--========================== PHP ==========================-->

<?PHP
// 1 - VERIFICAR SE ELA APERTOU O BOTAO CADASTRAR - ok
// 2 - GUARDAR DADOS DENTRO DE VARIAVEIS e verificar se esta vazia - ok
// 3 - ENVIAR DADOS COLHIDOS PARA A CLASSE , FUNCAO CADASTRAR
// 4 - VERIFICAR O RETORNO FALSE OU TRUE

if(isset($_POST['nome']))
{

	$nome = addslashes($_POST['nome']);
	$cpf = addslashes($_POST['cpf']);
	$rg = addslashes($_POST['rg']);
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confSenha = addslashes($_POST['confSenha']);

	if(!empty($nome) && !empty($cpf) && !empty($rg) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
	{
		if($senha == $confSenha)
		{
			require_once 'CLASSES/cliente.php';
			$us = new Cliente("rpi","localhost","root","");
			if($us->cadastrar($nome, $cpf, $rg, $telefone, $email, $senha))
			{   ?>
			 	<script type="text/javascript">
					alert('Cadastrado com sucesso!');
				</script>
				<?php
			}else
			{ ?>
				?>
			 	<script type="text/javascript">
					alert('<?php echo $us->mensagem;?>');
				</script>
				<?php	
			}
		}else
		{ 	?>
			 <script type="text/javascript">
				alert('Senhas não correspondem!');
			</script>
			<?php	
		}	
	}else
	{ 	?>
		<script type="text/javascript">
			alert('Preencha todos os campos!');
		</script>
		<?php
	}
}
?>