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
<?php	
	function get_post_action($name)
{
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Consultar Frequência</title>
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
<li><a href="#">Avaliação</a>
<ul>
		<li><a href="financeiro2.php">Lançar Avaliação</a><br></li>
		<li><a href="Excaval1.php">Excluir avaliação</a><br></li>
	</ul>

</li>
<li><a href="#">Frequência</a>
	<ul>
		<li><a href="frequencia.php">Cadastrar Frequência</a><br></li>
		<li><a href="consfreq.php">Consultar Frequência aluno</a><br></li>
		<li><a href="consfreq2.php">Consultar Frequência data</a><br></li>
	</ul>
	</li>
<li><a href="#">Vendas</a>
<ul>
		<li><a href="financeiro3.php">Lançar Vendas</a><br></li>
		<li><a href="Excvend.php">Excluir Vendas</a><br></li>
	</ul>

</li>
<li><a href="#">Relatórios</a>
	<ul>
		<li><a href="relfin.php">Relatorio Financeiro</a><br></li>
		<li><a href="atrasados.php">Mensalidade em atraso</a><br></li>
		<li><a href="ImprimeF.php">Imprimir ficha</a><br></li>
		
	</ul>
	</li>
<li><a href="backup.php">Backup</a></li>
<li><a href="logout.php">Sair</a></li>

<img src = "imagens\roger.png">
</ul>	
<section id="corpo">

<h1>Consultar Frequência</h1>
<h2>Digite o código do Aluno: </h2>

<form name = "signup" method= "post" action="consfreq2.php">
<input type='date' required="required" name= "data">	
    					
	<input type='submit' name= 'buscar' id="botao1" value='Buscar'>
	<input type='submit' name= 'sair' id="botao1" value='Sair'>
</form>

	
	
	<br>
<?php
switch (get_post_action('buscar', 'sair')) {
	case 'buscar':
	$data=  $_POST['data'];
	$cont =0;
	echo "Data:$data <br> 
	<table width= 50% border=1>
	<tr><td width= 15%>código</td><td width =85%>nome</td></tr>";
	
	$sql1= mysql_query("SELECT * FROM FREQUENCIA WHERE data ='$data'");
	 while($linha = mysql_fetch_array($sql1)){
		$cod= $linha['coda']; 
		$sql= mysql_query("SELECT * FROM alunos WHERE cod='$cod' ")or die(mysql_error());
		$linha2 = mysql_fetch_array($sql);
		$nome = $linha2['nome'];
		$cont =$cont+1;
		echo "<tr><td >$cod</td><td >$nome</td></tr>  ";
			 
			 }
	
		echo "</table><br>
		Quantidade de alunos:$cont  ";
	
	
	
	
	break;
	
	case 'sair':
		header("location: http://localhost/L2/principal.php");
		echo "teste";
	break;
		
 
}	
	
?>
	
	
	
	
	
	

</section>	
	
	
</body>
</html>