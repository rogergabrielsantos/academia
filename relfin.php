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
<title>Relatorio de Mensalidades</title>
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

<h1>Relatorio Financeiro</h1>
<h2>Selecione o Mes:</h2>
<form name = "signup" method= "post" action="relfin.php">
    	
	
					
	<input type='month' name= 'me'>				

	<input type='submit' name= 'buscar' id="botao1" value='Buscar'>
	<input type='submit' name= 'sair' id="botao1" value='Sair'>
	<br>
	</form>
<?php
switch (get_post_action('buscar', 'sair')) {
	case 'buscar':
	$total= 0;
	$cont = 0;
	$total1= 0;
	$cont1 = 0;
	$totalf=0;
	$cont2=0;
	$total2=0;
	$mes=$_POST['me'];
	$dataf= date('Y-m-d', strtotime('+18 days', strtotime($mes)));
	$datai= date('Y-m-d', strtotime('-1 months +19 days', strtotime($mes)));
	echo "Data Inicial: ".date('d/m/Y', strtotime($datai));
	echo "<br>Data Final: ".date('d/m/Y', strtotime($dataf));

	
	$sql= mysql_query("SELECT * FROM MENSALIDADE WHERE data between '$datai' and '$dataf'")or die(mysql_error());
	echo "
			<br><table border='1' width=100%>
			<td width='10%'>Codigo</td><td width=50%>Nome</td><td width=10%>Valor</td><td width=25%>Data</td><td width=25%>Referência</td></tr>";
	while($linha = mysql_fetch_array($sql)){
		$data= $linha['data'];
		$coda = $linha['coda']; 
		$valor = $linha['valor']; 
		$refe = $linha['referencia']; 
		$sql1= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$coda'");
		$linha1 = mysql_fetch_array($sql1);
		$nome= $linha1['nome'];
		$cont= $cont +1;
		$total= $total + $valor;
		echo "
			<td>$coda</td><td>$nome</td><td>".number_format($valor, 2, ',', '.')."</td><td>".date('d/m/Y', strtotime($data))."</td><td>".date('M-Y', strtotime($refe))."</td></tr>
			
				";
	}
	
	$sql= mysql_query("SELECT * FROM Avaliacao WHERE data between '$datai' and '$dataf'")or die(mysql_error());
	echo "
			<td colspan=4 align=center>Avaliações</td></tr>;
			<tr><td>Codigo</td><td width=50%>Nome</td><td width=10%>Valor</td><td width=25%>Data</td></tr>";
	while($linha = mysql_fetch_array($sql)){
		$data= $linha['data'];
		$coda = $linha['coda']; 
		$valor = $linha['valor']; 
		$sql1= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$coda'");
		$linha1 = mysql_fetch_array($sql1);
		$nome= $linha1['nome'];
		$cont1= $cont1 +1;
		$total1= $total1 + $valor;
		echo "
			<td>$coda</td><td>$nome</td><td>".number_format($valor, 2, ',', '.')."</td><td>".date('d/m/Y', strtotime($data))."</td></tr>
			
				";
	}
	
	
	$sql= mysql_query("SELECT * FROM vendas WHERE data between '$datai' and '$dataf'")or die(mysql_error());
	echo "
			<td colspan=3 align=center>Vendas</td></tr>;
			<tr><td width=50%>produto</td><td width=10%>Valor</td><td width=25%>Data</td></tr>";
	while($linha = mysql_fetch_array($sql)){
		$data= $linha['data'];
		$produto = $linha['produto']; 
		$valor = $linha['valor']; 
		$cont2= $cont2 +1;
		$total2= $total2 + $valor;
		echo "
			<td>$produto</td><td>".number_format($valor, 2, ',', '.')."</td><td>".date('d/m/Y', strtotime($data))."</td></tr>
			
				";
	}
	
	
		
	
	
	
	
	$totalF= $total1+$total+$total2;
	

	
	echo"
	<br>
	
			Mes:".date('m-Y', strtotime($mes))."<br>Total de mensalidades: $cont <br>Valor total:".number_format($total, 2, ',', '.')."  
			<br	>Total de Avaliações: $cont1 <br>Valor total:".number_format($total1, 2, ',', '.')."  
			<br	>Produtos Vendidos: $cont2 <br>Valor total Vendas:".number_format($total2, 2, ',', '.')."  
			<br	>Valor total Final:".number_format($totalF, 2, ',', '.')."  
			<br	>
			
			";
		echo "</table>";
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