	<!DOCTYPE html>
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
<h1>Localizar</h1><br>
<form name = "signup" method= "post" action="localiza.php">
	<select name= "codigo">
		<option value=''>Aluno</option>
			<?php
			 $getid = "SELECT * FROM ALUNOS order by nome";
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$ident =  $linha['cod'];	 
				$nome = $linha['nome'];
				echo "<option value='$ident'>$nome</option>";
			 }
			 
			
			?>
	</select>


   
	
	
	<input type="submit" id="botao1" name= "buscar" value="buscar"/>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>
</form>


	
	
	<br>
<?php

switch (get_post_action('buscar', 'sair')) {
	case 'buscar':
$cod=$_POST['codigo'];


if ($cod<>""  ){
	
	$sql= mysql_query("SELECT * FROM ALUNOS WHERE cod = '$cod'");
	$row = mysql_num_rows($sql);
	if($row>0){
		$linha = mysql_fetch_array($sql);
		$nome= $linha['nome'];
		$endereco= $linha['endereco'];
		$cidade =$linha['cidade'];
		$estado = $linha['estado'];
		$pais = $linha['pais'];
		$telefone = $linha['telefone'];
		$email = $linha['email'];
		$nascimento = $linha['nascimento'];
		$estcivil = $linha['estadocivil'];
		$vencimento = $linha['vencimento'];
		$situacao = $linha['situacao'];
		$entrada = $linha['entrada'];
		$periodo = $linha['periodo'];
		
		$des= "selected";
		$bloq="";
		$at="";
		
		if($situacao=="ativo"){
		$des= "";
		$bloq="";
		$at="selected";
			
		}else{
			if($situacao=="bloqueado"){
			$des= "";
			$bloq="selected";
			$at="";	
			}
			else{
			$des= "selected";
			$bloq="";
			$at="";		
				
			}
			
		}
		
		
		echo"
			<form id= 'form1' name='form1' method= 'post' action= 'edita.php\'>
		<table width=60%>
		<tr><td>Codigo: </td><td><input name='cod' type='text' size='5' readonly='readonly' id= 'id' value='$cod'></td></tr>
		<tr><td>Nome: </td><td><input name='nome' type= 'text' id='id' size='35' value='$nome'></td></tr>
		<tr><td>Endereço: </td><td><input name='endereco' type= 'text' id='id'size='35' value='$endereco'></td></tr>
		<tr><td>Cidade: </td><td><input name='cidade' type= 'text' id='id' size='35' value='$cidade'></td></tr>
		<tr><td>Estado: </td><td><input name='estado' type= 'text' id='id' size='35' value='$estado'></td></tr>
		<tr><td>País: </td><td><input name='pais' type= 'text' id='id' size='35' value='$pais'></td></tr>
		<tr><td>Telefone:</td><td><input name='telefone' type= 'text' id='id' size='35' value='$telefone'></td></tr>
		<tr><td>Email: </td><td><input name='email' type= 'text' id='id' size='35'  value='$email'></td></tr>
		<tr><td>Data Nascimento: </td><td><input name='nascimento' type= 'date' size='35' id='id' value='$nascimento'></td></tr>
		<tr><td>Estado Civil: </td><td><input name='estcivil' type= 'text' size='35' id='id' value='$estcivil'></td></tr>
		<tr><td>Vencimento: </td><td><input name='vencimento' type= 'text' id='id'  size='35' value=$vencimento></td></tr>
			
		<tr><td>	
			<label for = 'status'>Status: </label></td><td><select id= 'id' name='situacao'>
			<option    $at   value='ativo'>Ativo
			<option $bloq    value='bloqueado'> Bloqueado
			<option $des     value='desativado' > Desativado  
			</select>
			</td></tr>
		
		<tr><td>Entrada: </td><td><input name='entrada' type= 'date' id='id' size='35' value='$entrada'></td></tr>
		<tr><td>Peiodicidade: </td><td><input name='periodo' type= 'text' id='id' size='35' value='$periodo'></td></tr>
			</table>
			<br>
			<input type='submit' id='botao1' name= 'editar' value='Editar'>
			<input type='submit' id='botao1' name= 'excluir' value='Excluir'>
			<input type='submit' id='botao1' name= 'sair' value='Sair'>
			</form>
			
						
		";
		
		
		
		
		
	}else{
	  echo("<script type='text/javascript'> alert('Código não encontrado!!!'); location.href='localiza.php';</script>");	
	}
	
}else if($nom== ""){
	echo("<script type='text/javascript'> alert('Digite nome ou o codigo !!!'); location.href='localiza.php';</script>");
			
	}else{
		
		$sql= mysql_query("SELECT * FROM ALUNOS WHERE nome LIKE '%".$nom."%'");
		$row = mysql_num_rows($sql);
		if($row>0){
			while($linha = mysql_fetch_array($sql)){
				$codigo = $linha['cod'];
				$nome= $linha['nome'];
				$endereco= $linha['endereco'];
				echo"<form method='post' action='localizado.php'>Codigo:<input name='codigo' value='$codigo'>   Nome: <input name='nome' value='$nome'> <button type='submit'>OK</button></form>";
				//echo" Codigo: $codigo   Nome: $nome      Endereço: $endereco <br>";
					
			};
			
	}else{
	  echo("<script type='text/javascript'> alert('Nome não encontrado!!!'); location.href='localiza.php';</script>");	
	}
	}	
break;
	case 'sair':
		header("location: principal.php");
	  break;
}
?>
</section>
</body>
</html>