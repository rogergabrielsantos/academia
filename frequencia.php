<?php
	include "conexao.php";
?>
<?php	
	session_start();
		if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])){
			header("location: log.php");
			exit;
		}else{
			
			
		}
	
	
?>	
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Frequencia</title>
<link rel = "stylesheet" type="text/css" href = "css/estilo.css" >
</head>

<body>

<ul id="nav">
<a href="principal.php">
<img id= "iconemenu" src = "imagens\logomenu.png">
</a>



<li><a href="#">Alunos</a>
	<ul>
		<li><a href="cadastro.php">Cadastrar alunos</a></li>
		<li><a href="localiza.php">Consultar/Editar/Excluir</a></li>
	</ul>
	</li>
<li><a href="#">Ficha</a>
	<ul>
		<li><a href="ficha.php">Cadastrar Ficha</a></li>
		<li><a href="ficha2.php">Consultar/Editar/Excluir</a><br></li>
	</ul>
	</li>
<li><a href="#">Biometria</a>
	<ul>
		<li><a href="biometria.php">Cadastrar Biometria</a><br></li>
		<li><a href="biometria2.php">Consultar/Editar/Excluir</a><br></li>
	</ul>
	</li>
<li><a href="#">Mensalidade</a>
	<ul>
		<li><a href="financeiro.php">Pagamento Mensalidade</a><br></li>
		<li><a href="listam.php">Listar Mensalidade</a><br></li>
	</ul>
	</li>
	<li><a href="financeiro2.php">Avaliação</a></li>
<li><a href="#">Frequência</a>
	<ul>
		<li><a href="frequencia.php">Cadastrar Frequência</a><br></li>
		<li><a href="consfreq.php">Consultar Frequência aluno</a><br></li>
		<li><a href="consfreq2.php">Consultar Frequência data</a><br></li>
	</ul>
	</li>
<li><a href="#">Relatórios</a>
	<ul>
		<li><a href="relfin.php">Relatorio Financeiro</a><br></li>
		<li><a href="atrasados.php">Mensalidade em atraso</a><br></li>
		
	</ul>
	</li>
<li><a href="logout.php">Sair</a></li>
<img src = "imagens\roger.png">
</ul>
<section id="corpo">

<h1>Lançamento de  Frequência</h1>
<h2>Escolha a Data:</h2>
<br>
<form name = "signup" method= "post" action="frequencia2.php">
    Data: <input type ="date" name="data"/><br><br>
<input type="submit"  id="botao1" name= 'lancar' value="Lançar"/>
<input type="submit"  id="botao1" name= 'sair'value="Sair"/>
</form>
	

	
	
	

	
	<br>

</section>
</body>
</html>