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
			
	
	
	for ($x=0;$x<=39;$x++){
		$series[$x] = 0;
		$repet[$x] = 0;
		$carga[$x] = 0;
		$velocidade[$x] = 0;
  		$opcao[$x] = 0;
	}
	$grupo =0;
	$sql= mysql_query("SELECT * FROM FICHA WHERE coda ='$coda' AND data ='$data' order by grupo desc");
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
	
	
	require_once('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage(); // padrão o relatório gerado é no formato A4
$pdf->Rect(1,1,207,140); // CRIA UM RETÂNGULO QUE COMEÇA NO X = 1, Y = 1 E                               //TEM 222 DE LARGURA E 140 DE ALTURA. 
                                    //NESTE CASO, É UMA BORDA DE PÁGINA.
$pdf->Rect(2,24,73,45);
$pdf->Rect(2,69,73,30);
$pdf->Rect(2,99,73,30);
$pdf->Rect(78,24,73,25);
$pdf->Rect(78,49,73,35);
$pdf->Rect(78,84,73,25);
$pdf->Rect(78,109,73,20);
$pdf->Rect(153,24,53,105);
$pdf->Rect(37,2,169,21);
$pdf->Image('imagens/logomenu.png',3,3,33); // INSERE UMA LOGOMARCA NO PONTO X = 3, Y = 3, E DE TAMANHO 30.
$pdf->SetXY(2,2); // SetXY - DEFINE O X E O Y NA PAGINA
$pdf->SetFont('Arial','B',14); // Arial, tamanho 16 em negrito, a fonte deve vir antes do texto
$pdf->cell(0,10,'Ficha Individual do aluno',0,0,'C'); //LARGURA-ALTURA-CONTEUDO-BORDA-QUEBRA DE LINHA NO FINAL-POSIÇÃO 
//$pdf->ln(10);// pula 10 linhas, o valor 10 é por conta do valor da altura da célula
$pdf->SetXY(38,10);
$pdf->cell(42,6,'Nome: '.$nome); 
$pdf->SetXY(38,14);
$pdf->cell(40,10,'Data:'.$data); 
$pdf->SetFont('Arial','B',11);
$pdf->SetXY(3,21);
$pdf->cell(70,10,'Membros Inferiores',0,0,'C'); 
$pdf->SetXY(3,25);
$pdf->cell(20,10,'Exercicio'); 
$pdf->cell(14,10,'Series'); 
$pdf->cell(12,10,'Repet'); 
$pdf->cell(12,10,'Carga'); 
$pdf->cell(12,10,'Veloc'); 
$pdf->SetXY(3,29);
$pdf->cell(23,10,'Extensao');
$pdf->cell(15,10,$series[1]); 
$pdf->cell(12,10,$repet[1]); 
$pdf->cell(12,10,$carga[1]); 
$pdf->cell(12,10,$velocidade[1]);
$pdf->SetXY(3,33);
$pdf->cell(24,10,'Flex Joel');
$pdf->cell(14,10,$series[2]); 
$pdf->cell(12,10,$repet[2]); 
$pdf->cell(12,10,$carga[2]); 
$pdf->cell(12,10,$velocidade[2]);
$pdf->SetXY(3,37);
$pdf->cell(24,10,'Leg-Press');
$pdf->cell(14,10,$series[3]); 
$pdf->cell(12,10,$repet[3]); 
$pdf->cell(12,10,$carga[3]); 
$pdf->cell(12,10,$velocidade[3]);
$pdf->SetXY(3,41);
$pdf->cell(24,10,'Pantur');
$pdf->cell(14,10,$series[4]); 
$pdf->cell(12,10,$repet[4]); 
$pdf->cell(12,10,$carga[4]); 
$pdf->cell(12,10,$velocidade[4]);
$pdf->SetXY(3,45);
$pdf->cell(24,10,'Aducao');
$pdf->cell(14,10,$series[5]); 
$pdf->cell(12,10,$repet[5]); 
$pdf->cell(12,10,$carga[5]); 
$pdf->cell(12,10,$velocidade[5]);
$pdf->SetXY(3,49);
$pdf->cell(24,10,'Abducao');
$pdf->cell(14,10,$series[6]); 
$pdf->cell(12,10,$repet[6]); 
$pdf->cell(12,10,$carga[6]); 
$pdf->cell(12,10,$velocidade[6]);
$pdf->SetXY(3,53);
$pdf->cell(24,10,'Polia Gl');
$pdf->cell(14,10,$series[7]); 
$pdf->cell(12,10,$repet[7]); 
$pdf->cell(12,10,$carga[7]); 
$pdf->cell(12,10,$velocidade[7]);
$pdf->SetXY(3,57);
$pdf->cell(24,10,'Agacham.');
$pdf->cell(14,10,$series[8]); 
$pdf->cell(12,10,$repet[8]); 
$pdf->cell(12,10,$carga[8]); 
$pdf->cell(12,10,$velocidade[8]);
$pdf->SetXY(3,61);
$pdf->cell(24,10,'Hack');
$pdf->cell(14,10,$series[9]); 
$pdf->cell(12,10,$repet[9]); 
$pdf->cell(12,10,$carga[9]); 
$pdf->cell(12,10,$velocidade[9]);


$pdf->SetXY(3,66);
$pdf->cell(70,10,'Peitoral',0,0,'C'); 
$pdf->SetXY(3,70);
$pdf->cell(24,10,'Voador');
$pdf->cell(14,10,$series[10]); 
$pdf->cell(12,10,$repet[10]); 
$pdf->cell(12,10,$carga[10]); 
$pdf->cell(12,10,$velocidade[10]);
$pdf->SetXY(3,74);
$pdf->cell(24,10,'Supino');
$pdf->cell(14,10,$series[11]); 
$pdf->cell(12,10,$repet[11]); 
$pdf->cell(12,10,$carga[11]); 
$pdf->cell(12,10,$velocidade[11]);
$pdf->SetXY(3,78);
$pdf->cell(25,10,'Pullover');
$pdf->cell(13,10,$series[12]); 
$pdf->cell(12,10,$repet[12]); 
$pdf->cell(12,10,$carga[12]); 
$pdf->cell(12,10,$velocidade[12]);
$pdf->SetXY(3,82);
$pdf->cell(24,10,'Supino Incl');
$pdf->cell(14,10,$series[13]); 
$pdf->cell(12,10,$repet[13]); 
$pdf->cell(12,10,$carga[13]); 
$pdf->cell(12,10,$velocidade[13]);
$pdf->SetXY(3,86);
$pdf->cell(24,10,'Crucifixo');
$pdf->cell(14,10,$series[14]); 
$pdf->cell(12,10,$repet[14]); 
$pdf->cell(12,10,$carga[14]); 
$pdf->cell(12,10,$velocidade[14]);
$pdf->SetXY(3,90);
$pdf->cell(24,10,'Paralelas');
$pdf->cell(14,10,$series[15]); 
$pdf->cell(12,10,$repet[15]); 
$pdf->cell(12,10,$carga[15]); 
$pdf->cell(12,10,$velocidade[15]);

$pdf->SetXY(3,96);
$pdf->cell(70,10,'Biceps',0,0,'C'); 
$pdf->SetXY(3,100);
$pdf->cell(24,10,'Rosca Scot');
$pdf->cell(14,10,$series[16]); 
$pdf->cell(12,10,$repet[16]); 
$pdf->cell(12,10,$carga[16]); 
$pdf->cell(12,10,$velocidade[16]);
$pdf->SetXY(3,104);
$pdf->cell(24,10,'Rosca Altern');
$pdf->cell(14,10,$series[17]); 
$pdf->cell(12,10,$repet[17]); 
$pdf->cell(12,10,$carga[17]); 
$pdf->cell(12,10,$velocidade[17]);
$pdf->SetXY(3,108);
$pdf->cell(24,10,'Rosca Dir');
$pdf->cell(14,10,$series[18]); 
$pdf->cell(12,10,$repet[18]); 
$pdf->cell(12,10,$carga[18]); 
$pdf->cell(12,10,$velocidade[18]);
$pdf->SetXY(3,112);
$pdf->cell(24,10,'Rosca Inver.');
$pdf->cell(14,10,$series[19]); 
$pdf->cell(12,10,$repet[19]); 
$pdf->cell(12,10,$carga[19]); 
$pdf->cell(12,10,$velocidade[19]);
$pdf->SetXY(3,116);
$pdf->cell(24,10,'Rosca Conc');
$pdf->cell(14,10,$series[20]); 
$pdf->cell(12,10,$repet[20]); 
$pdf->cell(12,10,$carga[20]); 
$pdf->cell(12,10,$velocidade[20]);

$pdf->SetXY(78,21);
$pdf->cell(70,10,'Deltoides',0,0,'C'); 
$pdf->SetXY(78,25);
$pdf->cell(20,10,'Exercicio'); 
$pdf->cell(14,10,'Series'); 
$pdf->cell(12,10,'Repet'); 
$pdf->cell(12,10,'Carga'); 
$pdf->cell(12,10,'Veloc'); 
$pdf->SetXY(78,29);
$pdf->cell(24,10,'Elev. Lat');
$pdf->cell(14,10,$series[21]); 
$pdf->cell(12,10,$repet[21]); 
$pdf->cell(12,10,$carga[21]); 
$pdf->cell(12,10,$velocidade[21]);
$pdf->SetXY(78,33);
$pdf->cell(24,10,'Elev. Front');
$pdf->cell(14,10,$series[22]); 
$pdf->cell(12,10,$repet[22]); 
$pdf->cell(12,10,$carga[22]); 
$pdf->cell(12,10,$velocidade[22]);
$pdf->SetXY(78,37);
$pdf->cell(24,10,'Des Frent');
$pdf->cell(14,10,$series[23]); 
$pdf->cell(12,10,$repet[23]); 
$pdf->cell(12,10,$carga[23]); 
$pdf->cell(12,10,$velocidade[23]);
$pdf->SetXY(78,41);
$pdf->cell(24,10,'Des Cost');
$pdf->cell(14,10,$series[24]); 
$pdf->cell(12,10,$repet[24]); 
$pdf->cell(12,10,$carga[24]); 
$pdf->cell(12,10,$velocidade[24]);

$pdf->SetXY(78,48);
$pdf->cell(70,10,'Dorsais/Costas',0,0,'C'); 
$pdf->SetXY(78,52);
$pdf->cell(24,10,'Barra Fixa'); 
$pdf->cell(14,10,$series[25]); 
$pdf->cell(12,10,$repet[25]); 
$pdf->cell(12,10,$carga[25]); 
$pdf->cell(12,10,$velocidade[25]);
$pdf->SetXY(78,56);
$pdf->cell(24,10,'Rem. Halt');
$pdf->cell(14,10,$series[26]); 
$pdf->cell(12,10,$repet[26]); 
$pdf->cell(12,10,$carga[26]); 
$pdf->cell(12,10,$velocidade[26]);
$pdf->SetXY(78,60);
$pdf->cell(24,10,'Pulley Cost');
$pdf->cell(14,10,$series[27]); 
$pdf->cell(12,10,$repet[27]); 
$pdf->cell(12,10,$carga[27]); 
$pdf->cell(12,10,$velocidade[27]);
$pdf->SetXY(78,64);
$pdf->cell(24,10,'Rem. Sent');
$pdf->cell(14,10,$series[28]); 
$pdf->cell(12,10,$repet[28]); 
$pdf->cell(12,10,$carga[28]); 
$pdf->cell(12,10,$velocidade[28]);
$pdf->SetXY(78,68);
$pdf->cell(24,10,'Pulley Frent');
$pdf->cell(14,10,$series[29]); 
$pdf->cell(12,10,$repet[29]); 
$pdf->cell(12,10,$carga[29]); 
$pdf->cell(12,10,$velocidade[29]);
$pdf->SetXY(78,72);
$pdf->cell(24,10,'Voad. Dorsal');
$pdf->cell(14,10,$series[30]); 
$pdf->cell(12,10,$repet[30]); 
$pdf->cell(12,10,$carga[30]); 
$pdf->cell(12,10,$velocidade[30]);
$pdf->SetXY(78,76);
$pdf->cell(24,10,'Cruc Inver');
$pdf->cell(14,10,$series[31]); 
$pdf->cell(12,10,$repet[31]); 
$pdf->cell(12,10,$carga[31]); 
$pdf->cell(12,10,$velocidade[31]);

$pdf->SetXY(78,84);
$pdf->cell(70,10,'Triceps',0,0,'C'); 
$pdf->SetXY(78,88);
$pdf->cell(23,10,'Pulley'); 
$pdf->cell(14,10,$series[32]); 
$pdf->cell(12,10,$repet[32]); 
$pdf->cell(12,10,$carga[32]); 
$pdf->cell(12,10,$velocidade[32]);
$pdf->SetXY(78,92);
$pdf->cell(23,10,'Frances');
$pdf->cell(14,10,$series[33]); 
$pdf->cell(12,10,$repet[33]); 
$pdf->cell(12,10,$carga[33]); 
$pdf->cell(12,10,$velocidade[33]);
$pdf->SetXY(78,96);
$pdf->cell(23,10,'Testa');
$pdf->cell(14,10,$series[34]); 
$pdf->cell(12,10,$repet[34]); 
$pdf->cell(12,10,$carga[34]); 
$pdf->cell(12,10,$velocidade[34]);
$pdf->SetXY(78,100);
$pdf->cell(25,10,'Polia');
$pdf->cell(12,10,$series[35]); 
$pdf->cell(12,10,$repet[35]); 
$pdf->cell(12,10,$carga[35]); 
$pdf->cell(12,10,$velocidade[35]);

$pdf->SetXY(78,106);
$pdf->cell(70,10,'Abdomen',0,0,'C'); 
$pdf->SetXY(78,110);
$pdf->cell(24,10,'Supra'); 
$pdf->cell(14,10,$series[36]); 
$pdf->cell(12,10,$repet[36]); 
$pdf->cell(12,10,$carga[36]); 
$pdf->cell(12,10,$velocidade[36]);
$pdf->SetXY(78,114);
$pdf->cell(24,10,'Infra');
$pdf->cell(14,10,$series[37]); 
$pdf->cell(12,10,$repet[37]); 
$pdf->cell(12,10,$carga[37]); 
$pdf->cell(12,10,$velocidade[37]);
$pdf->SetXY(78,118);
$pdf->cell(25,10,'Obliquo');
$pdf->cell(13,10,$series[38]); 
$pdf->cell(12,10,$repet[38]); 
$pdf->cell(12,10,$carga[38]); 
$pdf->cell(12,10,$velocidade[38]);

$pdf->SetXY(154,21);
$pdf->cell(54,10,'Biometria',0,0,'C'); 
$pdf->SetXY(154,25);
$pdf->cell(28,10,'Peso'); 
$pdf->cell(14,10,$peso); 
$pdf->SetXY(154,29);
$pdf->cell(28,10,'Alt');
$pdf->cell(14,10,$altura); 
$pdf->SetXY(154,34);
$pdf->cell(28,10,'Pesc');
$pdf->cell(14,10,$pescoco); 
$pdf->SetXY(154,39);
$pdf->cell(28,10,'Ombro');
$pdf->cell(14,10,$ombros);
$pdf->SetXY(154,44);
$pdf->cell(28,10,'Busto/Torax');
$pdf->cell(14,10,$busto_torax);
$pdf->SetXY(154,49);
$pdf->cell(28,10,'Braco Dir');
$pdf->cell(14,10,$braco_dir);
$pdf->SetXY(154,53);
$pdf->cell(28,10,'Braco Esq');
$pdf->cell(14,10,$braco_esq ); 
$pdf->SetXY(154,57);
$pdf->cell(28,10,'Ant Brac Dir');
$pdf->cell(14,10,$ant_braco_dir ); 
$pdf->SetXY(154,61);
$pdf->cell(28,10,'Ant Brac Esq');
$pdf->cell(14,10,$ant_braco_esq); 
$pdf->SetXY(154,65);
$pdf->cell(28,10,'Punho Dir');
$pdf->cell(14,10,$punho_dir);
$pdf->SetXY(154,69);
$pdf->cell(28,10,'Punho Esq');
$pdf->cell(14,10,$punho_esq);
$pdf->SetXY(154,73);
$pdf->cell(28,10,'Cintura');
$pdf->cell(14,10,$cintura );
$pdf->SetXY(154,77);
$pdf->cell(28,10,'Per. Abdom');
$pdf->cell(14,10,$per_abdominal);
$pdf->SetXY(154,81);
$pdf->cell(28,10,'Quadril');
$pdf->cell(14,10,$quadril);
$pdf->SetXY(154,85);
$pdf->cell(28,10,'Coxa Dir');
$pdf->cell(14,10,$coxa_dir);
$pdf->SetXY(154,89);
$pdf->cell(28,10,'Coxa Esq');
$pdf->cell(14,10,$coxa_esq);
$pdf->SetXY(154,93);
$pdf->cell(28,10,'Perna Dir');
$pdf->cell(14,10,$perna_dir);
$pdf->SetXY(154,97);
$pdf->cell(28,10,'Perna Esq');
$pdf->cell(14,10,$perna_esq);
$pdf->SetXY(154,101);
$pdf->cell(28,10,'IMC');
$pdf->cell(14,10,$imc);
$pdf->SetXY(154,105);
$pdf->cell(28,10,'ICQ');
$pdf->cell(14,10,$icq);
	
$pdf->Output();
	
	
	
	
	
	break;
	case 'sair':
		header("location: principal.php");
		break;
		
	
		
	
} 




?>