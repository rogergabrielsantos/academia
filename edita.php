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

<?php



switch (get_post_action('editar', 'sair', 'excluir')) {
	case 'editar':
        $codigo = $_POST['cod'];
		$nome=$_POST['nome'];
		$endereco =$_POST['endereco'];
		$cidade =$_POST['cidade'];
		$estado =$_POST['estado'];
		$pais =$_POST['pais'];
		$telefone =$_POST['telefone'];
		$email =$_POST['email'];
		$nascimento =$_POST['nascimento'];
		$estcivil =$_POST['estcivil'];
		$vencimento =$_POST['vencimento'];
		$situacao = $_POST['situacao'];
		$entrada =$_POST['entrada'];
		$periodo =$_POST['periodo'];

		$sql= mysql_query("UPDATE ALUNOS SET nome = '$nome', endereco = '$endereco', cidade = '$cidade' , estado ='$estado' , pais ='$pais' , telefone='$telefone',email='$email' ,nascimento= '$nascimento', estadocivil='$estcivil', 
		vencimento='$vencimento', situacao= '$situacao', entrada = '$entrada', periodo ='$periodo' WHERE cod ='$codigo'")  or die(mysql_error());

		echo("<script type='text/javascript'> alert('Dado enviados com sucesso !!!'); location.href='../principal.php';</script>");
		break;
	case 'sair':
		header("location: ../principal.php");
		break;
	case 'excluir':
		 $codigo = $_POST['cod'];
		 $sql= mysql_query("DELETE FROM ALUNOS WHERE cod ='$codigo'")  or die(mysql_error());
		 $sql= mysql_query("DELETE FROM MENSALIDADE2017 WHERE cod ='$codigo'")  or die(mysql_error());
		 echo("<script type='text/javascript'> alert('Registro excluido com sucesso !!!'); location.href='../principal.php';</script>");
		 
	break;
} 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Sistema de cadastro</title>
</head>
<script>"window.location='../principal.php'")</script>";
<body>




</body>
</html>