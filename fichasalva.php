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
switch (get_post_action('salvar', 'sair','excluir','editar')) {
	case 'salvar':
        $codigo = $_POST['codigo'];
		$data=$_POST['data'];
		$op = $_POST['opcao'];
		$serie = $_POST['serie'];
		$repet =$_POST['repet'];
		$carga = $_POST['carga'];
		$veloc= $_POST['veloc'];
		$grupo= $_POST['grupo'];
		
		
		foreach($_POST["opcao"] as $index =>$opcao)
		{
			
		
		//echo(" $codigo, $data, $opcao , $serie[$index] ,  $repet[$index], $carga[$index] , $veloc[$index], $grupo[$index]<br>");
        
		$sql= mysql_query("INSERT INTO FICHA (coda, data, exercicio, series, repeticao, carga, velocidade, grupo) 
     VALUES ('$codigo','$data', '$opcao', '$serie[$index]' , '$repet[$index]' , '$carga[$index]' , '$veloc[$index]', '$grupo[$index]' )") or die(mysql_error());

		}
		
		
		

		

		echo("<script type='text/javascript'> alert('Dado enviados com sucesso !!!'); location.href='principal.php';</script>");
		break;
	
	case 'editar':
		
		$codigo = $_POST['coda'];
		$data=$_POST['data'];
		$op = $_POST['opcao'];
		$serie = $_POST['serie'];
		$repet =$_POST['repet'];
		$carga = $_POST['carga'];
		$veloc= $_POST['veloc'];
		$grupo= $_POST['grupo'];
		
		$sql= mysql_query("DELETE FROM FICHA WHERE coda='$codigo' and data='$data'") or die(mysql_error());
	
		foreach($_POST["opcao"] as $index =>$opcao)
		{
		
		//echo(" $codigo, $data, $opcao , $serie[$index] ,  $repet[$index], $carga[$index] , $veloc[$index], $grupo[$index]<br>");
		
		$sql= mysql_query("INSERT INTO FICHA (coda, data, exercicio, series, repeticao, carga, velocidade, grupo) 
		VALUES ('$codigo','$data', '$opcao', '$serie[$index]' , '$repet[$index]' , '$carga[$index]' , '$veloc[$index]', '$grupo[$index]' )") or die(mysql_error());

		//$sql= mysql_query("UPDATE FICHA  SET exercicio ='$opcao', series='$serie[$index]' ,  repeticao='$repet[$index]',  carga='$carga[$index]', velocidade='$veloc[$index]', grupo= '$grupo[$index]' 
		//WHERE coda='$codigo' and data='$data' and grupo = '$grupo'") or die(mysql_error());
		
		}
		
		 header("location: http://localhost/L2/ficha2.php");
		break;
		
	
	
	
	
	
	
	
	case 'sair':
	
	   header("location: http://localhost/L2/principal.php");
		break;
		
		
	case 'excluir':
		$codigo = $_POST['coda'];
		$data=$_POST['data'];
		$sql= mysql_query("DELETE FROM FICHA WHERE coda='$codigo' and data='$data'") or die(mysql_error());
		
		echo("<script type='text/javascript'> alert('Dado excluidos com sucesso !!!'); location.href='http://localhost/L2/principal.php';</script>");
		break;
	
		
	
} 
?>