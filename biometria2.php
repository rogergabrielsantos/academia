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
<title>Consulta Biometria</title>
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




<h1>Consulta Biometria</h1>
<br><br>
<form name = "signup" method= "post" action="biometria2.php">
	<select name= "codigo">
		<option value=''>Aluno</option>
			<?php
			 $getid = "SELECT * FROM BIOMETRIA";
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$cod =  $linha['cod'];	 
				$ident = $linha['coda'];
				$data = $linha['data'];
				$sql= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$ident' order by nome");
				$linha = mysql_fetch_array($sql);
				$nome= $linha['nome'];
				
				echo "<option value='$cod'>$nome Data: $data </option><br>";
			 }
			 
			
			?>
	</select>


  
	

	<input type='submit' id="botao1"  name= 'buscar' value='Buscar'>
	<input type='submit' id="botao1"  name= 'sair' value='Sair'>
	
</form>	

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
switch (get_post_action('buscar', 'sair')) {
	case 'buscar':
	$codigo = $_POST['codigo'];
	$sql= mysql_query("SELECT * FROM BIOMETRIA WHERE cod ='$codigo'  ");
	$linha = mysql_fetch_array($sql);
    $coda = $linha['coda']; 	
	$sql1= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$coda' order by nome  ");
	$linha1 = mysql_fetch_array($sql1);
	$nome= $linha1['nome'];
	$data =$linha['data'];
	$peso =$linha['peso'];
	$altura =$linha['altura'];
	$pescoco =$linha['pescoco'];
	$ombros =$linha['ombros'];
	$busto_torax =$linha['busto_torax'];
	$braco_dir =$linha['braco_dir'];
	$braco_esq =$linha['braco_esq'];
	$ant_braco_dir =$linha['ant_braco_dir'];
	$ant_braco_esq =$linha['ant_braco_esq'];
	$punho_dir =$linha['punho_dir'];
	$punho_esq =$linha['punho_esq'];
	$cintura =$linha['cintura'];
	$per_abdominal =$linha['per_abdominal'];
	$quadril =$linha['quadril'];
	$coxa_dir =$linha['coxa_dir'];
	$coxa_esq =$linha['coxa_esq'];
	$perna_dir =$linha['perna_dir'];
	$perna_esq =$linha['perna_esq'];
	$imc = $linha['IMC'];
	$icq = $linha['ICQ'];
	
	
	
	
	
	
	
	
	echo"
			<form id= 'form1' name='form1' method= 'post' action= 'biosalva.php\'>
			<br><br><input name='cod' type='hidden' readonly='readonly' id= 'id' value='$codigo'>
			<br><br>Codigo: <input name='coda' type='text' readonly='readonly' id= 'id' value='$coda'>
			Nome: <input name='nome' type= 'text' id='id' value='$nome'> 	 	 	
			Data: <input name='data' type= 'text' id='id' value='$data'><br><br>
			<table border='1'>
			<tr>
			<td>Peso:<input type ='text' name='peso' value='$peso'/></td>
			<td>Altura: <input type ='text' name='alt' value='$altura'/></td>
			<td>Pescoço:<input type ='text' name='pesc' value='$pescoco'/></td>
			<td>Ombros: <input type ='text' name='ombro' value='$ombros'/></td>
			</tr>
			<tr>
			<td>Busto/Torax:<input type ='text' name='busto' value='$busto_torax'/></td>
			<td>Braço Dir: <input type ='text' name='bracod' value='$braco_dir'/></td>
			<td>Braço Esq:<input type ='text' name='bracoe' value='$braco_esq'/></td>
			<td>Ant Braço Dir :<input type ='text' name= 'antid' value='$ant_braco_dir'/></td>
			</tr>
			<tr>
			<td>Ant Braço Esq :<input type ='text' name='antie' value='$ant_braco_esq'/></td>
			<td>Punho Dir.:<input type ='text' name='punhod' value='$punho_dir'/></td>
			<td>Punho Esq.:<input type ='text' name='punhoe' value='$punho_esq'/></td>
			<td>Cintura:<input type ='text' name='cint'  value='$cintura'/></td>
			</tr>
			<tr>
			<td>Per. Abdominal:<input type ='text' name='per' value='$per_abdominal'/></td>
			<td>Quadril:<input type ='text' name='quadril' value='$quadril'/></td>
			<td>Coxa Dir.:<input type ='text' name='coxad' value='$coxa_dir'/></td>
			<td>Coxa Esq.:<input type ='text' name='coxae' value='$coxa_esq'/></td>
			</tr>
			<tr>
			<td>Perna Dir.:<input type ='text' name='pernad' value='$perna_dir'/></td>
			<td>Perna Esq.:<input type ='text' name='pernae' value='$perna_esq'/></td>
			<td>IMC.:<input type ='text' name='imc' readonly='readonly'  value='$imc'/></td>
			<td>ICQ.:<input type ='text' name='icq' readonly='readonly' value='$icq'/></td>
			</tr>	
			</table>
			<br><br>
			<input type='submit' id='botao1' name= 'editar' value='Editar'>
			<input type='submit' id='botao1'  name= 'excluir' value='Excluir'>
			<input type='submit' id='botao1' name= 'sair' value='Sair'>
			
			</form>
			<br>
			
					
		";
	
	
	
	break;
	case 'sair':
		header("location: principal.php");
		break;
		
	
		
	
} 




?>





	
	
	
	
	
</section>
</body>
</html>