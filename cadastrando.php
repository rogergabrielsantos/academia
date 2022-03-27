<!DOCTYPE html>
<?php
	include "conexao.php";
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
<title>Sistema de cadastro</title>
</head>

<body>




<?php
switch (get_post_action('salvar', 'sair')) {
	case 'salvar':
	$nome=$_POST['nome'];
	$endereco =$_POST['end'];
	$cidade =$_POST['cid'];
	$estado =$_POST['est'];
	$pais =$_POST['pais'];
	$telefone =$_POST['tel'];
	$email =$_POST['email'];
	$nascimento =$_POST['nasc'];
	$estcivil =$_POST['ec'];
	$vencimento =$_POST['venc'];
	$situacao = $_POST['situ'];
	$entrada =$_POST['entrada'];
	$periodo =$_POST['periodo'];

   //echo("'$nome', '$endereco', '$cidade' , '$estado' , '$pais' , '$telefone', '$email' , '$nascimento', '$estcivil', '$vencimento', '$situacao', '$entrada', '$periodo'");
	
	$sql= mysql_query("INSERT INTO ALUNOS (nome, endereco, cidade,estado, pais, telefone, email, nascimento, estadocivil, vencimento, situacao, entrada, periodo) 
	VALUES ('$nome', '$endereco', '$cidade' , '$estado' , '$pais' , '$telefone', '$email' , '$nascimento', '$estcivil', '$vencimento', '$situacao', '$entrada', '$periodo')") or die(mysql_error());

	$sql= mysql_query("INSERT INTO MENSALIDADE2017 (entrada) VALUES ('$entrada')") or die(mysql_error());



	echo("<script type='text/javascript'> alert('Dado enviados com sucesso !!!'); location.href='cadastro.php';</script>");
		break;
	case 'sair':
		header("location: principal.php");
	  break;
}
?>

</body>
</html>