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
	switch (get_post_action('salvar', 'sair')) {
		case 'salvar':
		$data=$_POST['data'];
		$op = $_POST['opcao'];
		if($op<>0){
		$sql= mysql_query("DELETE FROM FREQUENCIA WHERE data='$data'")or die(mysql_error());
			
		
		foreach($_POST["opcao"] as $opcao)
		{
		
        $sql= mysql_query("INSERT INTO frequencia (coda, data, situ) VALUES ('$opcao','$data','presente')") or die(mysql_error());
		}
		echo("<script type='text/javascript'> alert('Dado enviados com sucesso !!!'); location.href='frequencia.php';</script>");
	break;
	}
	case 'sair':
		header("location: frequencia.php");
	break;
	
		
		}
	
?>