<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema Raspberry IOT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/entrar.css"/>
</head>
<body>
	<span>Sistema Raspberry IOT</span>
	<form method="POST">
		<h1>Acesse a sua conta</h1>
		<img src="IMAGENS/envelope.png">
		<input type="email" name="email">
		<img src="IMAGENS/cadeado.png">
		<input type="password" name="senha">
		<input type="submit" value="Entrar">
	</form>
</body>
</html>
<?php
if(isset($_POST['email']))
{

	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	if(!empty($email) && !empty($senha))
	{
		require_once 'CLASSES/cliente.php';
		$us = new Cliente("rpi","localhost","root","");

		if($us->entrar($email, $senha))
		{
			if($_SESSION['id_cliente'] == 1)
			{
				?>
				<script type="text/javascript">
					window.location.href = "index.php";
				</script>
				<?php
			}else
			{
				$endereco = $us->buscarEndereco($_SESSION['id_cliente']);
				?>
				<script type="text/javascript">
				window.location.href = "botoes.php";				
				</script>
				<?php
			}
			
		}else
		{
			?>
				<script type="text/javascript">
					alert('Email e/ou senha não cadastrado!');
				</script>
			<?php
		}
	}else
	{
		?>
		<p class="mensagem">Preencha todos os campos!</p>
		<?php 
	}
}
?>


