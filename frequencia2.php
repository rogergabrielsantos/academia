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
<title>Frequencia</title>
<link rel = "stylesheet" type="text/css" href = "css/estilo.css" >
</head>

<body>

<ul id="nav">
<img id= "iconemenu" src = "imagens\logomenu.png">



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
		<li><a href="ImprimeF.php">Imprimir ficha</a><br></li>
	</ul>
	</li>
<li><a href="logout.php">Sair</a></li>
<img src = "imagens\roger.png">
</ul>
<section id="corpo">



<h1>Lançamento de  Frequência</h1>
<br><br>

<table   width=70% height=700px>
<tr>
<td><h2>Data: </h2></td>
<form name = "signup" method= "post" action="lancafreq.php">

<?php
switch (get_post_action('lancar', 'sair')) {
	
	case 'lancar':	

	$data = $_POST['data'];
	   echo"<td><INPUT TYPE='date' name='data' readonly='readonly' value = $data></td><td></td></tr>
	<tr><td>Cod</td><td>Nome</td><td>Status</td></tr>
	";
		if($data<>""){
		$sql= mysql_query("SELECT * FROM ALUNOS where situacao = 'ativo' order by nome ");
			while($linha = mysql_fetch_array($sql)){
				$codigo = $linha['cod'];
				$nome= $linha['nome'];
				
				
				$sql1= mysql_query("SELECT * FROM FREQUENCIA WHERE coda = '$codigo' and data='$data' and situ='presente'  ");
				$row = mysql_num_rows($sql1);
				
				if($row>0){
					echo" <tr><td>$codigo</td><td>$nome</td> <td>   <INPUT TYPE='checkbox' NAME='opcao[]' checked='checked' VALUE= $codigo></td></tr>";
					
				}else{
				
							
				echo"<tr><td>$codigo </td><td>$nome   </td><td> <INPUT TYPE='checkbox' NAME='opcao[]' VALUE= $codigo></td></tr>";
					}
			};
}

break;
case 'sair':
		header("location: principal.php");
	break;
}
	?>
	</table>
	
	<br><br>
	<input type="submit" id="botao1" name= 'salvar' value="Salvar"/>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>
</form>	

	</section>
</body>
</html>