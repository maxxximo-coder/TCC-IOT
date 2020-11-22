<?php session_start(); 
$id_cliente =  addslashes($_SESSION['id_cliente']);
require_once 'CLASSES/dash.php';
$d = new Dash("rpi","localhost","root","");
$dados = $d->buscarDash($id_cliente);

//print_r($dados);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema Raspberry IOT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/botoes.css"/>
	<link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css">
</head>

<body>

<nav>
		<ul>
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
<table id="table1">

</table>

	<form  method="POST">
		<table id="table2">
		<h1>CONTROLE DE BOTÕES</h1>
		<td>
		<a href="botoes.php?id=1" class="botao">Canal 1</a>
		<a href="botoes.php?id=2" class="botao">Canal 2</a>
		<a href="botoes.php?id=3" class="botao">Canal 3</a>
		<a href="<?php echo $dados['endereco'];?>" class="botao">Página de Monitoração do Cliente</a>
		</td></table>
	</form></body>
</html>
		<!--
		<input type="submit" value="Lampada 1" name="botao1">

		<input type="submit" value="Lampada 2" name="botao2">

		<input type="submit" value="Lampada 3" name="botao3">
	</form>
</body>



</html>

<!-========================== PHP ==========================-->

<?PHP

if(isset($_GET['id']))
{
	$id = addslashes($_GET['id']);
	require_once 'CLASSES/gerenciamento.php';
	$gerenciamento = new Gerenciamento ("rpi","localhost","root","");
	
	$status = $gerenciamento->buscarStatus($id);
	if($status == 1)
	{ 
		echo "Lampada ".$id."foi desligada!";
		echo '<script type="text/javascript">';
		echo ' alert("Lampada foi desligada")';  //not showing an alert box.
		echo '</script>';
	}else
	{ 
		echo "Lampada ".$id."foi ligada!";
	    echo '<script type="text/javascript">';
		echo ' alert("Lampada foi ligada")';  //not showing an alert box.
		echo '</script>';
	}
}

?>
</table>
