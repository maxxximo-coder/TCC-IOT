<?php 
require_once 'CLASSES/cliente.php';
$cli= new Cliente("rpi","localhost","root","");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema Raspberry IOT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/index.css"/>
	<link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css">
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
	<?php
	if(isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == 1)
	{
		$dados = $cli->buscarDadosClientes();

		//echo '<pre> oi';
		//print_r($dados);
		//echo '</pre>';

		if(count($dados) > 0)
		{
			?>
          <table id="tabela" class="table table-striped table-bordered" style="width:90%">
		
				    <tr style="background-color:#F0FFFF;">
                      <th  class="text-center">CÓDIGO DO CLIENTE</th>
                      <th  class="text-center">NOME</th>
                      <th  class="text-center">TOTAL MORADIAS</th>
                      <th  class="text-center">TOTAL EQUIPAMENTOS</th>
                      <th  width='25%' class="text-center">AÇÃO</th>
                    </tr>
                  </thead>


				<?php
					
				for ($i=0; $i < count($dados); $i++)
				{ 
					?>
					<tr style="background-color:#A9A9A9;">
						<td><?php echo $dados[$i]['id_cliente']?></td>
						<td><?php echo $dados[$i]['nome']?></td>
						<td><?php echo $dados[$i]['tot_moradias'];?></td>
						<td><?php echo $dados[$i]['tot_equipamentos'];?> </td>
						<td><a class="btn-danger btn-sm " href="<?php echo 'index.php?id='.$dados[$i]['id_cliente'];?>">Excluir</a></td>
					</tr>
					<?php
				}
				?>
			</table>
			<?php
		}else
		{
			echo '<br><br>Ainda não há clientes cadastrados.';
		}
		?>
		<?php
	}else
	{
		echo 'SEJA BEM VINDO(A)!!';
	}


	?>
</body>
</html>


<?php

if(isset($_GET['id']))// botao excluir foi clicado
{
	$id_cliente = addslashes($_GET['id']);
	$cli->excluirCliente($id_cliente);
	?>
	<script type="text/javascript">
		window.location.href = 'index.php';
	</script>
	<?php
}



?>