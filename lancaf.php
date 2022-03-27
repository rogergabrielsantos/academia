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
switch (get_post_action('salvar','salvara' ,'excluir','excluirV','venda','sair')) {
	case 'salvar':
$codaluno=$_POST['codigo'];
$valor=$_POST['valor'];
$data= $_POST['datap'];
$referencia= $_POST['referencia'];


	
	$sql= mysql_query("SELECT * FROM ALUNOS WHERE cod = '$codaluno'");
	$row = mysql_num_rows($sql);
	if($row>0){
	
$sql= mysql_query("INSERT INTO MENSALIDADE (coda, valor, data, referencia) 
VALUES ('$codaluno', '$valor', '$data' , '$referencia' )") or die(mysql_error());


}
echo("<script type='text/javascript'> alert('Dados enviados com sucesso !!!'); location.href='financeiro.php';</script>");
break;
case 'salvara':
$codaluno=$_POST['codigo'];
$valor=$_POST['valor'];
$data= $_POST['datap'];
	
	$sql= mysql_query("SELECT * FROM ALUNOS WHERE cod = '$codaluno'");
	$row = mysql_num_rows($sql);
	if($row>0){
	
$sql= mysql_query("INSERT INTO avaliacao (coda, valor, data) 
VALUES ('$codaluno', '$valor', '$data' )") or die(mysql_error());

	
}
echo("<script type='text/javascript'> alert('Dados enviados com sucesso !!!'); location.href='financeiro.php';</script>");
	

break;
case 'excluir':
$cod=$_POST['codigo'];	
$sql= mysql_query("delete FROM avaliacao WHERE cod = '$cod'")or die(mysql_error());
		echo("<script type='text/javascript'> alert('Dados Excluidos com sucesso !!!'); location.href='principal.php';</script>");
		
break;

case 'excluirV':
$cod=$_POST['codigo'];	
$sql= mysql_query("delete FROM vendas WHERE cod = '$cod'")or die(mysql_error());
		echo("<script type='text/javascript'> alert('Dados Excluidos com sucesso !!!'); location.href='principal.php';</script>");
break;

		
		
case 'venda':
$produto=$_POST['produto'];
$valor=$_POST['valor'];
$data= $_POST['datap'];

$sql= mysql_query("INSERT INTO vendas (produto, valor, data)
VALUES ('$produto', '$valor', '$data' )") or die(mysql_error());
		echo("<script type='text/javascript'> alert('Dados Incluidos com sucesso !!!'); location.href='principal.php';</script>");
		
		break;


case 'sair':
		
		header("location: http://localhost/L2/principal.php");
		
		break;

}

?>