	<?php
	include "conexao.php";
	?>
	

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>login</title>

<script type="text/javascript">
	function login(){
		setTimeout("window.location='principal.php'");
	
	}
function loginF(){
		setTimeout("window.location='log.php'",3000);
	
	}

</script>

</head>
<body>

	
	
	<?php
		$usuario =$_POST['usuario'];
		$senha =$_POST['senha'];
		$sql= mysql_query("SELECT * FROM usuarios WHERE usuario ='$usuario' and senha = '$senha'") or die(mysql_error());
		$row = mysql_num_rows($sql);
		
		if($row==1){
			session_start();
			$_SESSION['usuario']= $_POST['usuario'];
			$_SESSION['senha']= $_POST['senha'];
			
			echo "<script>login()</script>";
		}else{
			
			echo ("<script type='text/javascript'> alert('Usuário ou senha incorretos !!!'); location.href='log.php';</script>");
			
		}
	
	?>
	
</body>
</html>