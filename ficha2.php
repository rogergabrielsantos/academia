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
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Consulta Ficha</title>
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
<h1>Consulta ficha</h1>
<form name = "signup" method= "post" action="ficha2.php">
	<select name= "codigo">
		<option value=''>Aluno</option>
			<?php
			 $getid = "SELECT DISTINCT coda,data FROM ficha";
			 $getidquery = mysql_query($getid)or die(mysql_error());
			 while($linha = mysql_fetch_array($getidquery)){
				$coda =  $linha['coda'];	 
				$data =  $linha['data'];
				$sql1= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$coda' order by nome");
				$linha1 = mysql_fetch_array($sql1);
				$nome= $linha1['nome'];
				
			
				 echo "<option value='$coda;$data'> $nome data: $data</option>";
			 }
			 
			
			?>
	</select>

	<input type='submit' id="botao1" name= 'buscar' value='Buscar'>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>
	
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
	$var =  explode(";", $codigo); 
	$cod=$var[0];
	$data=$var[1];
	$sql1= mysql_query("SELECT * FROM ALUNOS WHERE cod ='$cod' order by nome");
	$linha1 = mysql_fetch_array($sql1);
	$nome= $linha1['nome'];
	for ($x=0;$x<=39;$x++){
		$series[$x] = 0;
		$repet[$x] = 0;
		$carga[$x] = 0;
		$velocidade[$x] = 0;
  		$opcao[$x] = 0;
	}
	$grupo =0;
	$sql= mysql_query("SELECT * FROM FICHA WHERE coda ='$cod' AND data ='$data' order by grupo desc");
	$linha = mysql_fetch_array($sql);
	while($linha = mysql_fetch_array($sql)){
		
				$id = $linha['coda'];
				$grupo = $linha['grupo'];
				$exercicio = $linha['exercicio'];
				$series[$grupo] = $linha['series'];
				$repet[$grupo] = $linha['repeticao'];
				$carga[$grupo] = $linha['carga'];
				$velocidade[$grupo] =$linha['velocidade'];
				
				
				//echo "Codigo: $id   grupo:$grupo  Exercicio: $exercicio Serie: $series[$grupo] Repetição$repet[$grupo]  data:$data<br> ";
					
			};
			echo" 
				<form id= 'form1' name='form1' method= 'post' action= 'fichasalva.php\'>
				<br><br>Codigo: <input name='coda' type='text' readonly='readonly' size='15' id= 'id' value='$cod'>
				Nome: <input name='nome' type= 'text' readonly='readonly'size='35' value='$nome'> 	 	 	
				Data: <input name='data' type= 'date' readonly='readonly' value='$data'><br><br>
				<table border='1'>
				<tr><td colspan='5'>Membros Inferiores</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Extensão:<INPUT TYPE= 'hidden' NAME= 'opcao[1]	' VALUE= 'extensao'/></td><td><input type ='text'  name='serie[1]' VALUE= '$series[1]'/></td><td><input type ='text' name='repet[1]'  VALUE= '$repet[1]'/> </td><td><input type ='text' name='carga[1]' VALUE= '$carga[1]'/></td><td><input type ='text' name='veloc[1]' VALUE= '$velocidade[1]'/></td><input name='grupo[1]' type='hidden' value='1' /></tr>
				<tr><td>Flex Joelhos:<input type ='hidden' name='opcao[2]' value='Flex joelhos'/></td><td><input type ='text' name='serie[2]' VALUE= '$series[2]'/> </td><td><input type ='text' name='repet[2]' VALUE= '$repet[2]'/></td><td><input type ='text' name='carga[2]' VALUE= '$carga[2]'/></td><td><input type ='text' name='veloc[2]' VALUE= '$velocidade[2]'/></td><input name='grupo[2]' type='hidden' value='2' /></tr>
				<tr><td>Leg-Press:<input type ='hidden' name='opcao[3]' value='Leg-Press'/></td><td><input type ='text' name='serie[3]' VALUE= '$series[3] '/> </td><td><input type ='text' name='repet[3]' VALUE= '$repet[3]'/></td><td><input type ='text' name='carga[3]' VALUE= '$carga[3]'/></td><td><input type ='text' name='veloc[3]' VALUE= '$velocidade[3]'/></td><input name='grupo[3]' type='hidden' value='3' /></tr>  
				<tr><td>Panturrilha:<input type ='hidden' name='opcao[4]' value='Panturrilha'/></td><td><input type ='text' name='serie[4]' VALUE= '$series[4]'/></td><td><input type ='text' name='repet[4]' VALUE= '$repet[4]'/></td><td><input type ='text' name='carga[4]' VALUE= '$carga[4]'/> </td><td><input type ='text' name='veloc[4]' VALUE= '$velocidade[4]'/></td><input name='grupo[4]' type='hidden' value='4' /></tr>
				<tr><td>Adução:<input type ='hidden' name='opcao[5]' value='Adução'/></td><td><input type ='text' name='serie[5]' VALUE= '$series[5]'/></td><td> <input type ='text' name='repet[5]' VALUE= '$repet[5]'/></td><td><input type ='text' name='carga[5]' VALUE= '$carga[5]'/></td><td><input type ='text' name='veloc[5]' VALUE= '$velocidade[5]'/></td><input name='grupo[5]' type='hidden' value='5' /></tr>
				<tr><td>Abdução:<input type ='hidden' name='opcao[6]' value='Abdução'/></td><td><input type ='text' name='serie[6]' VALUE= '$series[6] '/> </td><td> <input type ='text' name='repet[6]' VALUE= '$repet[6]'/> </td><td><input type ='text' name='carga[6]' VALUE= '$carga[6]'/></td><td><input type ='text' name='veloc[6]' VALUE= '$velocidade[6]'/></td><input name='grupo[6]' type='hidden' value='6' /></tr> 
				<tr><td>Polia Glúteo:<input type ='hidden' name='opcao[7]' value='Polia Glúteo'/></td><td><input type ='text' name='serie[7]' VALUE= '$series[7] '/></td><td><input type ='text' name='repet[7]' VALUE= '$repet[7]'/> </td><td> <input type ='text' name='carga[7]' VALUE= '$carga[7]'/></td><td><input type ='text' name='veloc[7]' VALUE= '$velocidade[7]'/></td><input name='grupo[7]' type='hidden' value='7' /></tr>  
				<tr><td>Agachamento:<input type ='hidden' name='opcao[8]' value='Agachamento'/></td><td><input type ='text' name='serie[8]' VALUE= '$series[8] '/></td><td><input type ='text' name='repet[8]' VALUE= '$repet[8]'/> </td><td><input type ='text' name='carga[8]' VALUE= '$carga[8]'/></td><td><input type ='text' name='veloc[8]' VALUE= '$velocidade[8]'/></td><input name='grupo[8]' type='hidden' value='8' /></tr>  
				<tr><td>Hack:<input type ='hidden' name='opcao[9]' value='Hack'/></td><td><input type ='text' name='serie[9]' VALUE= '$series[9]'/></td><td><input type ='text' name='repet[9]' VALUE= '$repet[9]'/></td><td><input type ='text' name='carga[9]' VALUE= '$carga[9]'/></td><td><input type ='text' name='veloc[9]' VALUE= '$velocidade[9]'/></td><input name='grupo[9]' type='hidden' value='9' /></tr> 
				<tr><td colspan='5'>Peitorais</td></tr>
	
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Voador:<input type ='hidden' name='opcao[10]' value='Voador'/></td><td> <input type ='text' name='serie[10]' VALUE= '$series[10] '/> </td><td> <input type ='text' name='repet[10]' VALUE= '$repet[10]'/> </td><td> <input type ='text' name='carga[10]'  VALUE= '$carga[10]'/> </td><td><input type ='text' name='veloc[10]' VALUE= '$velocidade[10]'/></td><input name='grupo[10]' type='hidden' value='10' /></tr> 
				<tr><td>Supino:<input type ='hidden' name='opcao[11]' value='Supino'/></td><td> <input type ='text' name='serie[11]' VALUE= '$series[11] '/> </td><td> <input type ='text' name='repet[11]' VALUE= '$repet[11]'/> </td><td> <input type ='text' name='carga[11]'  VALUE= '$carga[11]'/></td><td> <input type ='text' name='veloc[11]' VALUE= '$velocidade[11]'/></td><input name='grupo[11]' type='hidden' value='11' /></tr>  
				<tr><td>Pullover:<input type ='hidden' name='opcao[12]' value='Pullover'/></td><td> <input type ='text' name='serie[12]' VALUE= '$series[12] '/> </td><td><input type ='text' name='repet[12]' VALUE= '$repet[12]'/></td><td> <input type ='text' name='carga[12]'  VALUE= '$carga[12]'/> </td><td> <input type ='text' name='veloc[12]' VALUE= '$velocidade[12]'/></td><input name='grupo[12]' type='hidden' value='12' /></tr>  
				<tr><td>Supino Incl:<input type ='hidden' name='opcao[13]' value='Supino Incl'/></td><td> <input type ='text' name='serie[13]' VALUE= '$series[13] '/> </td><td> <input type ='text' name='repet[13]' VALUE= '$repet[13]'/> </td><td><input type ='text' name='carga[13]'  VALUE= '$carga[13]'/> </td><td> <input type ='text' name='veloc[13]' VALUE= '$velocidade[13]'/></td><input name='grupo[13]' type='hidden' value='13' /></tr>  
				<tr><td>Crucifixo:<input type ='hidden' name='opcao[14]' value='Crucifixo'/></td><td> <input type ='text' name='serie[14]' VALUE= '$series[14] '/> </td><td><input type ='text' name='repet[14]' VALUE= '$repet[14]'/> </td><td><input type ='text' name='carga[14]'  VALUE= '$carga[14]'/> </td><td><input type ='text' name='veloc[14]' VALUE= '$velocidade[14]'/></td><input name='grupo[14]' type='hidden' value='14' /></tr>  
				<tr><td>Paralelas:<input type ='hidden' name='opcao[15]' value='Paralelas'/></td><td> <input type ='text' name='serie[15]' VALUE= '$series[15] '/> </td><td><input type ='text' name='repet[15]' VALUE= '$repet[15]'/> </td><td> <input type ='text' name='carga[15]'  VALUE= '$carga[15]'/> </td><td><input type ='text' name='veloc[15]' VALUE= '$velocidade[15]'/></td><input name='grupo[15]' type='hidden' value='15' /></tr>  
	
				<tr><td colspan='5'>Biceps</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Rosca Sott:<input type ='hidden' name='opcao[16]' value='Rosca Sott'/> </td><td><input type ='text' name='serie[16]' VALUE= '$series[16] '/> </td><td><input type ='text' name='repet[16]' VALUE= '$repet[16]'/> </td><td> <input type ='text' name='carga[16]'  VALUE= '$carga[16]'/></td><td> <input type ='text' name='veloc[16]' VALUE= '$velocidade[16]'/></td><input name='grupo[16]' type='hidden' value='16' /></tr>  
				<tr><td>Rosca Altern.:<input type ='hidden' name='opcao[17]' value='Rosca Altern'/></td><td> <input type ='text' name='serie[17]' VALUE= '$series[17] '/> </td><td><input type ='text' name='repet[17]' VALUE= '$repet[17]'/> </td><td><input type ='text' name='carga[17]'  VALUE= '$carga[17]'/></td><td> <input type ='text' name='veloc[17]' VALUE= '$velocidade[17]'/></td><input name='grupo[17]' type='hidden' value='17' /></tr>  
				<tr><td>Rosca Direita:<input type ='hidden' name='opcao[18]' value='Rosca Direita'/></td><td><input type ='text' name='serie[18]' VALUE= '$series[18] '/> </td><td><input type ='text' name='repet[18]' VALUE= '$repet[18]'/> </td><td> <input type ='text' name='carga[18]'  VALUE= '$carga[18]'/> </td><td><input type ='text' name='veloc[18]' VALUE= '$velocidade[18]'/></td><input name='grupo[18]' type='hidden' value='18' /></tr>  
				<tr><td>Rosca Inver.:<input type ='hidden' name='opcao[19]' value='Rosca Inver'/></td><td><input type ='text' name='serie[19]' VALUE= '$series[19] '/> </td><td><input type ='text' name='repet[19]' VALUE= '$repet[19]'/> </td><td><input type ='text' name='carga[19]'  VALUE= '$carga[19]'/></td><td><input type ='text' name='veloc[19]' VALUE= '$velocidade[19]'/></td><input name='grupo[19]' type='hidden' value='19' /></tr>  
				<tr><td>Rosca Conc:<<input type ='hidden' name='opcao[20]' value='Rosca Conc'/></td><td><input type ='text' name='serie[20]' VALUE= '$series[20] '/> </td><td><input type ='text' name='repet[20]' VALUE= '$repet[20]'/> </td><td><input type ='text' name='carga[20]'  VALUE= '$carga[20]'/> </td><td><input type ='text' name='veloc[20]' VALUE= '$velocidade[20]'/></td><input name='grupo[20]' type='hidden' value='20' /></tr>  
	
				<tr><td colspan='5'>Deltóides</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Ele. Lateral:<input type ='hidden' name='opcao[21]' value='Ele. Lateral'/></td><td><input type ='text' name='serie[21]' VALUE= '$series[21] '/> </td><td><input type ='text' name='repet[21]' VALUE= '$repet[21]'/></td><td><input type ='text' name='carga[21]'  VALUE= '$carga[21]'/></td><td><input type ='text' name='veloc[21]' VALUE= '$velocidade[21]'/></td><input name='grupo[21]' type='hidden' value='21' /></tr>  
				<tr><td>Ele. Frontal.:<input type ='hidden' name='opcao[22]' value='Ele. Frontal'/></td><td><input type ='text' name='serie[22]' VALUE= '$series[22] '/> </td><td><input type ='text' name='repet[22]' VALUE= '$repet[22]'/></td><td><input type ='text' name='carga[22]'  VALUE= '$carga[22]'/></td><td><input type ='text' name='veloc[22]' VALUE= '$velocidade[22]'/></td><input name='grupo[22]' type='hidden' value='22' /></tr>  
				<tr><td>Desen. Frente:<input type ='hidden' name='opcao[23]' value='Desen. Frente'/></td><td><input type ='text' name='serie[23]' VALUE= '$series[23] '/> </td><td><input type ='text' name='repet[23]' VALUE= '$repet[23]'/></td><td><input type ='text' name='carga[23]'  VALUE= '$carga[23]'/></td><td><input type ='text' name='veloc[23]' VALUE= '$velocidade[23]'/></td><input name='grupo[23]' type='hidden' value='23' /></tr>  
				<tr><td>Desen. Costas:<input type ='hidden' name='opcao[24]' value='Desen. Costas'/></td><td> <input type ='text' name='serie[24]' VALUE= '$series[24] '/> </td><td><input type ='text' name='repet[24] VALUE= '$repet[24]'td><td><input type ='text' name='carga[24]'  VALUE= '$carga[24]'/></td><td><input type ='text' name='veloc[24]' VALUE= '$velocidade[24]'/></td><input name='grupo[24]' type='hidden' value='24' /></tr>  
    
				<tr><td colspan='5'>Dorsais/Costas</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Barra Fixa:<input type ='hidden' name='opcao[25]' value='Barra Fixa'/></td><td><input type ='text' name='serie[25]' VALUE= '$series[25]'/> </td><td> <input type ='text' name='repet[25]' VALUE= '$repet[25]'/> </td><td><input type ='text' name='carga[25]'  VALUE= '$carga[25]'/></td><td><input type ='text' name='veloc[25]' VALUE= '$velocidade[25]'/></td><input name='grupo[25]' type='hidden' value='25' /></tr>  
				<tr><td>Rem. Halteres:<input type ='hidden' name='opcao[26]' value='Rem. Halteres'/></td><td><input type ='text' name='serie[26]' VALUE= '$series[26] '/> </td><td> <input type ='text' name='repet[26]' VALUE= '$repet[26]'/> </td><td><input type ='text' name='carga[26]'  VALUE= '$carga[26]'/> </td><td><input type ='text' name='veloc[26]' VALUE= '$velocidade[26]'/></td><input name='grupo[26]' type='hidden' value='26' /></tr>  
				<tr><td>Pulley Costas:<input type ='hidden' name='opcao[27]' value='Pulley Costas'/></td><td> <input type ='text' name='serie[27]' VALUE= '$series[27] '/> </td><td> <input type ='text' name='repet[27]' VALUE= '$repet[27]'/> </td><td><input type ='text' name='carga[27]'  VALUE= '$carga[27]'/> </td><td> <input type ='text' name='veloc[27]' VALUE= '$velocidade[27]'/></td><input name='grupo[27]' type='hidden' value='27' /></tr>  
				<tr><td>Rem. Sentado:<input type ='hidden' name='opcao[28]' value='Rem. Sentado'/></td><td><input type ='text' name='serie[28]' VALUE= '$series[28] '/> </td><td><input type ='text' name='repet[28]' VALUE= '$repet[28]'/> </td><td><input type ='text' name='carga[28]'  VALUE= '$carga[28]'/> </td><td> <input type ='text' name='veloc[28]' VALUE= '$velocidade[28]'/></td><input name='grupo[28]' type='hidden' value='28' /></tr>  
				<tr><td>Pulley Frente:<input type ='hidden' name='opcao[29]' value='Pulley Frente'/></td><td> <input type ='text' name='serie[29]' VALUE= '$series[29] '/> </td><td> <input type ='text' name='repet[29]' VALUE= '$repet[29]'/> </td><td><input type ='text' name='carga[29]'  VALUE= '$carga[29]'/> </td><td> <input type ='text' name='veloc[29]' VALUE= '$velocidade[29]'/></td><input name='grupo[29]' type='hidden' value='29' /></tr>  
				<tr><td>Voad. Dorsal:<input type ='hidden' name='opcao[30]' value='Voad. Dorsal'/></td><td> <input type ='text' name='serie[30]' VALUE= '$series[30] '/> </td><td><input type ='text' name='repet[30]' VALUE= '$repet[30]'/> </td><td><input type ='text' name='carga[30]'  VALUE= '$carga[30]'/> </td><td> <input type ='text' name='veloc[30]' VALUE= '$velocidade[30]'/></td><input name='grupo[30]' type='hidden' value='30' /></tr>  
				<tr><td>Crucifixo Inv.:<input type ='hidden' name='opcao[31]' value='Crucifixo Inv.'/></td><td><input type ='text' name='serie[31]' VALUE= '$series[31] '/></td><td> <input type ='text' name='repet[31]' VALUE= '$repet[31]'/> </td><td> <input type ='text' name='carga[31]'  VALUE= '$carga[31]'/> </td><td> <input type ='text' name='veloc[31]' VALUE= '$velocidade[31]'/></td><input name='grupo[31]' type='hidden' value='31' /></tr>  
	
				<tr><td colspan='5'>Triceps</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Pulley:<input type ='hidden' name='opcao[32]' value='Pulley'/></td><td><input type ='text' name='serie[32]' VALUE= '$series[32] '/> </td><td> <input type ='text' name='repet[32]' VALUE= '$repet[32]'/> </td><td> <input type ='text' name='carga[32]'  VALUE= '$carga[32]'/> </td><td> <input type ='text' name='veloc[32]' VALUE= '$velocidade[32]'/></td><input name='grupo[32]' type='hidden' value='32' /></tr>  
				<tr><td>Francês:<input type ='hidden' name='opcao[33]' value='Francês'/></td><td><input type ='text' name='serie[33]' VALUE= '$series[33] '/> </td><td><input type ='text' name='repet[33]' VALUE= '$repet[33]'/> </td><td><input type ='text' name='carga[33]'  VALUE= '$carga[33]'/> </td><td> <input type ='text' name='veloc[33]' VALUE= '$velocidade[33]'/></td><input name='grupo[33]' type='hidden' value='33' /></tr>  
				<tr><td>Testa:<input type ='hidden' name='opcao[34]' value='Testa'/></td><td><input type ='text' name='serie[34]' VALUE= '$series[34] '/> </td><td><input type ='text' name='repet[34]' VALUE= '$repet[34]'/></td><td><input type ='text' name='carga[34]'  VALUE= '$carga[34]'/> </td><td><input type ='text' name='veloc[34]' VALUE= '$velocidade[34]'/></td><input name='grupo[34]' type='hidden' value='34' /></tr>  
				<tr><td>Polia:<input type ='hidden' name='opcao[35]' value='Polia'/></td><td><input type ='text' name='serie[35]' VALUE= '$series[35]'/> </td><td> <input type ='text' name='repet[35]' VALUE= '$repet[35]'/> </td><td><input type ='text' name='carga[35]'  VALUE= '$carga[35]'/> </td><td><input type ='text' name='veloc[35]' VALUE= '$velocidade[35]'/></td><input name='grupo[35]' type='hidden' value='35' /></tr>  
	
				<tr><td colspan='5'>Abdomen</td></tr>
				<tr><td>Exercicio</td><td>Séries</td><td>Repet</td><td>Carga</td><td>Velocidade</td></tr>
				<tr><td>Supra:<input type ='hidden' name='opcao[36]' value='Supra'/></td><td><input type ='text' name='serie[36]' VALUE= '$series[36]'/> </td><td> <input type ='text' name='repet[36]' VALUE= '$repet[36]'/> </td><td><input type ='text' name='carga[36]'  VALUE= '$carga[36]'/> </td><td> <input type ='text' name='veloc[36]' VALUE= '$velocidade[36]'/></td><input name='grupo[36]' type='hidden' value='36' /></tr>  
				<tr><td>Infra:<input type ='hidden' name='opcao[37]' value='Infra'/></td><td> <input type ='text' name='serie[37]' VALUE= '$series[37]'/> </td><td> <input type ='text' name='repet[37]' VALUE= '$repet[37]'/> </td><td><input type ='text' name='carga[37]'  VALUE= '$carga[37]'/> </td><td> <input type ='text' name='veloc[37]' VALUE= '$velocidade[37]'/></td><input name='grupo[37]' type='hidden' value='37' /></tr>  
				<tr><td>Oblíquo:<input type ='hidden' name='opcao[38]' value='Oblíquo'/></td><td><input type ='text' name='serie[38]' VALUE= '$series[38] '/></td><td><input type ='text' name='repet[38]' VALUE= '$repet[38]'/> </td><td><input type ='text' name='carga[38]' VALUE= '$carga[38]'/> </td><td><input type ='text' name='veloc[38]' VALUE= '$velocidade[38]'/></td><input name='grupo[38]' type='hidden' value='38' /></tr>  
				<tr><td><input type ='hidden' name='opcao[39]' value='esc'/></td><td><input type ='hidden' name='serie[39]' VALUE= '$series[39] '/></td><td><input type ='hidden' name='repet[39]' VALUE= '$repet[38]'/> </td><td><input type ='hidden' name='carga[39]' VALUE= '$carga[38]'/> </td><td><input type ='hidden' name='veloc[39]' VALUE= '$velocidade[38]'/></td><input name='grupo[39]' type='hidden' value='39' /></tr>  
	
				
				
				
				
				
				</table>	
				
				
				<br><br>
				
				<input type='submit' id='botao1' name= 'editar' value='Editar'>
				<input type='submit' id='botao1' name= 'excluir' value='Excluir'>
				<input type='submit' id='botao1' name= 'sair' value='Sair'>
				</form>";
	
	break;
	case 'sair':
		header("location: http://localhost/L2/principal.php");
		break;
		
	
		
	
} 




?>





	
	
	
</section>	
	

</body>
</html>