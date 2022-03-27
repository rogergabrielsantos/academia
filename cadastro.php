<!DOCTYPE html>
<?php	
	session_start();
		if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])){
			header("location: log.php");
			exit;
		}else{
			
			
		}
	
	
?>	


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
<h1>Cadastro de Aluno</h1>
<form name = "signup" method= "post" action="cadastrando.php">
	<fieldset id="usuario">
	<br>
<table id= "cad">
<tr><td>	<label for = "cnome"   class="label" >Nome:</label></td><td><input  class="input1" required="required" type ="text" id="cnome" name="nome" size="35" maxlength="30" placeholder=" Nome Completo" /><br><br></td></tr>
<tr><td>	<label for = "cend"  class="label" >Endereço: </label></td><td><input  class="input1" type ="text" id= "cend" name="end" size="35" placeholder=" Endereço"/><br><br></td></tr>
<tr><td>    <label for = "ccid"  class="label" >Cidade: </label></td><td><input type ="text" id= "ccid" name="cid"  value=" Caete" size="35" placeholder=" Cidade"/><br><br></td></tr>
<tr><td>	<label for = "cest">Estado: </label></td><td><input type ="text"id= "cest" name="est" value="MG" size="35"placeholder=" Minas Gerais"/><br><br></td></tr>
<tr><td>	<label for = "cpais">pais: </label></td><td><input type ="text"  id= "cpais" name="pais" size="35" value=" Brasil" placeholder=" Brasil"/><br><br></td></tr>
<tr><td>	<label for = "ctel">telefone: </label></td><td><input type ="text" id= "ctel" name="tel" size="35" placeholder=" Telefone"/><br><br></td></tr>
<tr><td>	<label for = "cemail">Email: </label></td><td><input type ="email" id= "cemail" name="email" size="35" placeholder="Email"/><br><br></td></tr>
<tr><td>	<label for = "cnasc">Data Nascimento: </label></td><td><input type ="date"  id = "cnasc" name="nasc" size="35" placeholder=" Data de Nascimento"/><br><br></td></tr>
</table>	
	<br>
	<p><fieldset id="endereco" ><legend>Estado Civil</legend>
	<input type="radio" name="ec" value="solteiro"/> Solteiro<br/>
	<input type="radio" name="ec" value="casado"/>Casado<br />
	<input type="radio" name="ec" value="Viuvo"/>Viúvo<br />
	<input type="radio" name="ec" value="Divorciado"/>Divorciado<br />
	</fieldset></p>
	<br><p><label for = "vencimento">Vencimento:</label><input  id= "vencimento" type ="text" size="20" name="venc"/><br><br></p>
	<p><label for = "status">Status: </label><select id= "status" name="situ"></p>
    <option value="ativo">Ativo
    <option value="bloqueado">Bloqueado
    <option value="desativado">Desativado
   </select>
	<br><br>
	<p><label for = "entrada">Entrada Data: </label><input type ="date" size="20" id= "entrada" name="entrada"/><br><br></p>
	<p><label for = "periodo">Periodicidade: </label><input type ="text" size="20" id= "periodo" name="periodo"/><br><br></p>
	
	</fieldset>
	
	<br>
	<input type="submit" id="botao1" name= 'salvar' value="salvar"/>
	<input type='submit' id="botao1" name= 'sair' value='Sair'>
</form>

</section>	
	
	


</body>
</html>