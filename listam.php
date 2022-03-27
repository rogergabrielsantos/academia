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
<title>Localizar</title>
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

<h1>Lista Mensalidades</h1>
<br><br>
<form name = "signup" method= "post" action="listam.php">
	<select name= "codigo">
		<option value=''>Aluno</option>
			<?php
			 $getid = "SELECT * FROM ALUNOS where situacao = 'ativo' order by nome";
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$ident =  $linha['cod'];	 
				$nome = $linha['nome'];
				
				echo "<option value='$ident'>$nome</option>";
			 }
			 
			
			?>
	</select>
	Ano: <input type="text" name="ano" size="4" maxlength="4" value="2018">
	<input type='submit' id="botao1" name= 'buscar' value='Buscar'>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>
	
</form>
<br><br>	
<table border='1' width=100%>


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
switch (get_post_action('buscar', 'sair','alterar','Excluir')) {
	case 'buscar':
	$codigo = $_POST['codigo'];
	$ano=$_POST['ano'];
	$sql2= mysql_query("SELECT * FROM ALUNOS WHERE cod = '$codigo' order by nome ");
	$linha = mysql_fetch_array($sql2);
	$nome= $linha['nome'];
	echo "$nome";
	echo "       <tr><td><b>Mês</b></td><td><b>Jan</td><td><b>Fev</td><td><b>Mar</td><td><b>abr</td><td><b>Mai</td><td><b>Jun</td><td><b>Jul</td>
                 <td><b>Ago</td><td><b>Set</td><td><b>Out</td><td><b>Nov</td><td><b>Dez</td></tr></b>";
	
		for ($i = 1; $i <= 12; $i++) {
				$m[$i]="aberto";
				$d[$i] ="";
				$v[$i] ="";
				}
	$getid = "SELECT * FROM mensalidade where coda ='$codigo' and referencia LIKE '$ano"."%' ";
	
	
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$ident =  $linha['cod'];	 
				$valor = $linha['valor'];
				$data = $linha['data'];
				$refe = $linha['referencia'];
				$pop = explode("-",$refe);
				$ind = (int) $pop[1];
			
				$m[$ind]="pago"; 
				$d[$ind] = $data;
				$v[$ind]= $valor;
				
				
			 
			 }

				
				echo "
				
		<tr><td><b>Situação </b></td><td>$m[1]</td><td>$m[2]</td><td>$m[3]</td><td>$m[4]</td><td>$m[5]</td><td>$m[6]</td><td>$m[7]</td><td>$m[8]</td><td>$m[9]</td><td>$m[10]</td><td>$m[11]</td><td>$m[12]</td></tr>
		<tr><td><b>Data     </b></td><td>$d[1]</td><td>$d[2]</td><td>$d[3]</td><td>$d[4]</td><td>$d[5]</td><td>$d[6]</td><td>$d[7]</td><td>$d[8]</td><td>$d[9]</td><td>$d[10]</td><td>$d[11]</td><td>$d[12]</td></tr>
		<tr><td><b>Pagamento</b></td><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td><td>$v[7]</td><td>$v[8]</td><td>$v[9]</td><td>$v[10]</td><td>$v[11]</td><td>$v[12]</td></tr>
				

				
				
				
				";
			 
	


	break;
	case 'Excluir':
		$cod = $_POST['coda'];
		$movi=$_POST['movi'];
		$sql= mysql_query("DELETE FROM MENSALIDADE WHERE coda = '$cod' and referencia = '$movi' ")  or die(mysql_error());
		echo("<script type='text/javascript'> alert('Registro excluido com sucesso !!!');</script>");
			
		break;
		
	case 'alterar':
		$cod = $_POST['coda'];
		$movi=$_POST['movi'];
		$val = $_POST['valor'];
		$datap = $_POST['datap'];
		$sql= mysql_query("UPDATE MENSALIDADE SET valor	= '$val', data = '$datap'  WHERE coda ='$cod' and referencia = '$movi' ")  or die(mysql_error());
		
		
		
		echo("<script type='text/javascript'> alert('Registro Alterado com sucesso !!!');</script>");
			
		break;
	
	
	
	case 'sair':
		header("location: principal.php");
		break;
	
	
	}
?>


</table>
<br><br>
<table>
<h1>Edita/Excluir Mensalidades</h1>
<br><br>
 <form name = "signup" method= "post" action="listam.php">
	<select name= "movi">
		<option value=''>Movimento</option>
			<?php
			 $codigo1 = $_POST['codigo'];
			 $ano1=$_POST['ano'];
			
			 $getid = "SELECT * FROM mensalidade where coda ='$codigo1' and referencia LIKE '$ano"."%' ";
			 
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$ident =  $linha['coda'];
				$ref = $linha['referencia'];
				$dat =  $linha['data'];
				
				
				
				echo "<option value='$ref'>$ref</option>";
			 }
			 
			echo"<input type ='hidden' value = '$codigo1' name='coda'/>";
			?>
	</select>
	
	Valor: <input type ="text" required="required" name="valor"/>
	Data: <input type ="date" required="required" name="datap"/>
	<input type='submit' id="botao1" name= 'alterar' value='Alterar'>
	<input type='submit' id="botao1" name= 'Excluir' value='Excluir'>
	
</form>	


</table>
</section>
</body>
</html>