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
<title>Sitema de cadastro</title>
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
<h1>Cadastrar Biometria</h1><br><br>
<form name = "signup" method= "post" action="biosalva.php">
	Nome: <select name= "cod">
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
	
	

	Data:<input type ="date" required="required" name="data"/><br><br>
	
	<table border="1">
	<tr>
	<td>Peso:<input type ="text" required="required" name="peso"/></td><td>Altura: <input type ="text" required="required" name="alt"/></td><td>Pescoço:<input type ="text" name="pesc"/></td><td>Ombros: <input type ="text" name="ombro"/></td>
	</tr>
	<tr>
	<td>Busto/Torax:<input type ="text" name="busto"/></td>
	<td>Braço Dir: <input type ="text" name="bracod"/></td>
	<td>Braço Esq:<input type ="text" name="bracoe"/></td>
	<td>Ant Braço Dir :<input type ="text" name="antid"/></td>
	</tr>
	<tr>
	<td>Ant Braço Esq :<input type ="text" name="antie"/></td>
	<td>Punho Dir.:<input type ="text" name="punhod"/></td>
	<td>Punho Esq.:<input type ="text" name="punhoe"/></td>
	<td>Cintura:<input type ="text" name="cint"/></td>
	</tr>
	<tr>
	<td>Per. Abdominal:<input type ="text" name="per"/></td>
	<td>Quadril:<input type ="text" name="quadril"/></td>
	<td>Coxa Dir.:<input type ="text" name="coxad"/></td>
	<td>Coxa Esq.:<input type ="text" name="coxae"/></td>
	</tr>
	<tr>
	<td>Perna Dir.:<input type ="text" name="pernad"/></td>
	<td>Perna Esq.:<input type ="text" name="pernae"/></td>
	</tr>
	</table>
	<br><br>
	<input type='submit' id="botao1" name= 'salvar' value='Salvar'>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>

	
</form>

	
	
</section>


</body>
</html>