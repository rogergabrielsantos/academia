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
switch (get_post_action('salvar', 'sair','editar', 'excluir')) {
	case 'salvar':
        $codigo = $_POST['cod'];
		$data= $_POST['data'];
		$peso =$_POST['peso'];
		$altura =$_POST['alt'];
		$pescoco =$_POST['pesc'];
		$ombro =$_POST['ombro'];
		$busto =$_POST['busto'];
		$bracod =$_POST['bracod'];
		$bracoe =$_POST['bracoe'];
		$antid =$_POST['antid'];
		$antie =$_POST['antie'];
		$punhod =$_POST['punhod'];
		$punhoe = $_POST['punhoe'];
		$cintura =$_POST['cint'];
		$per =$_POST['per'];
		$quadril =$_POST['quadril'];
		$coxad =$_POST['coxad'];
		$coxae =$_POST['coxae'];
		$pernad =$_POST['pernad'];
		$pernae =$_POST['pernae'];
		$aux=$altura*$altura;
		$imc = $peso/$aux;
		$icq = $cintura/$quadril;
		
		$sql= mysql_query("INSERT INTO BIOMETRIA (coda, data, peso, altura, pescoco,ombros,busto_torax, braco_dir,braco_esq,ant_braco_dir,ant_braco_esq,punho_dir,punho_esq,cintura,per_abdominal,quadril,coxa_dir,coxa_esq,perna_dir,perna_esq,imc,icq) 
		VALUES ('$codigo','$data', '$peso', '$altura', '$pescoco', '$ombro', '$busto', '$bracod', '$bracoe', '$antid', '$antie', '$punhod', '$punhoe', '$cintura', '$per', '$quadril',	'$coxad', '$coxae',	'$pernad', '$pernae',$imc,$icq)") or die(mysql_error());


		echo("<script type='text/javascript'> alert('Dado enviados com sucesso !!!'); location.href='principal.php';</script>");
		break;
	case 'sair':
		echo"teste";
		header("location: http://localhost/L2/principal.php");
		
		break;
		
	case 'excluir':
		
		 $codigo = $_POST['cod'];
		 $sql1= mysql_query("DELETE FROM BIOMETRIA WHERE cod ='$codigo'")  or die(mysql_error());
		 
		 echo("<script type='text/javascript'> alert('Registro excluido com sucesso !!!'); location.href='../principal.php';</script>");
		 break;
		 
	case 'editar':
		$codigo = $_POST['cod'];
		
		$peso =$_POST['peso'];
		$altura =$_POST['alt'];
		$pescoco =$_POST['pesc'];
		$ombros =$_POST['ombro'];
		$busto =$_POST['busto'];
		$bracod =$_POST['bracod'];
		$bracoe =$_POST['bracoe'];
		$antid =$_POST['antid'];
		$antie =$_POST['antie'];
		$punhod =$_POST['punhod'];
		$punhoe = $_POST['punhoe'];
		$cintura =$_POST['cint'];
		$per =$_POST['per'];
		$quadril =$_POST['quadril'];
		$coxad =$_POST['coxad'];
		$coxae =$_POST['coxae'];
		$pernad =$_POST['pernad'];
		$pernae =$_POST['pernae'];
		$aux=$altura*$altura;
		$imc = $peso/$aux;
		$icq = $cintura/$quadril;
		
		
		$sql= mysql_query("UPDATE BIOMETRIA SET peso = '$peso', altura= '$altura', pescoco= '$pescoco', ombros= '$ombros',busto_torax= '$busto',
		braco_dir= '$$bracod', braco_esq='$$bracode', ant_braco_dir ='$antid ' ,ant_braco_esq= '$antie',punho_dir='$punhod',
		punho_esq='$punhoe',cintura='$cintura',per_abdominal='$per',quadril='$quadril',coxa_dir='$coxad',coxa_esq='$coxae',
		perna_dir='$pernad', perna_esq='$pernae', IMC ='$imc',ICQ ='$icq'   	 WHERE cod ='$codigo'") or die(mysql_error()); 
		
		
		header("location: ../biometria2.php");
		break;
	
		

	
} 
?>