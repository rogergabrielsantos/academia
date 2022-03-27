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


<h1>Relatorio de Mensalidade em Atraso</h1>
<h2>Confirme o Mes:</h2>
<form name = "signup" method= "post" action="atrasados.php">
    	
	
					
	<input type='month' name= 'me'>				

	<input type='submit' name= 'confirmar' id="botao1" value='OK'>
	<input type='submit' name= 'sair' id="botao1" value='Sair'>
</form>


<?php
switch (get_post_action('confirmar', 'sair')) {
	case 'confirmar':
	echo "<table   width=50%>
	<tr><td>Codigo</td><td>Nome</td></tr>";
	
	$mes=$_POST['me'];
	$contr=0;
	$cont=0;
	$atrasado=[];
	$sql= mysql_query("SELECT * FROM ALUNOS WHERE situacao = 'ativo' order by nome")or die(mysql_error());
	echo "<br><br>";
	while($linha = mysql_fetch_array($sql)){
		$contr=0;
		$nome = $linha['nome'];
		$coda = $linha['cod']; 
		
		
		$sql1= mysql_query("SELECT * FROM MENSALIDADE WHERE coda ='$coda'");
		while($linha1 = mysql_fetch_array($sql1)){
		$data= $linha1['data']; 
		$referencia= $linha1['referencia'];
		//echo "$nome e $coda e $data e $referencia<br>";
		if($mes==$referencia){
		$contr=1;	
		
		}
		}
		if($contr==0){
		$atrasado[]=$coda;
		echo "<tr><td>$coda</td><td>$nome</td><tr>";
		}
		
		
		
	}
	
	
			foreach($atrasado as $valor) {
			//echo $valor;
			}
			
				
	
	
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

