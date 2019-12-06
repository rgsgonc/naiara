<?php
// +----------------------------------------------------------------------+
// | SAS - Sistema de Agendamento de Sala (Portuguese Version)            |
// | RSS - Room Scheduler System (English Version)                        |
// +----------------------------------------------------------------------+
// | DESENVOLVIDO NO BRASIL !!! DEVELOPED IN BRAZIL !!!                   |
// +----------------------------------------------------------------------+
// | ATUALIZA��ES:-                                                       |
// | 04-DEZ-03 - Vers�o Inicial .................................. v0.0.0 |
// | 23-DEZ-03 - Implemeta��o de Skin ............................ v1.0.0 |
// | 29-MAR-04 - Adicionado Cancelamento de Reservas ............. v1.1.0 |
// | 31-MAR-04 - Adicionado Marca��o 30 min de Reservas .......... v1.2.0 |
// | 19-ABR-04 - Corre��o disable radio box virada de m�s ........ v1.3.0 |
// | 26-ABR-04 - Corre��o fun��o monstrar dias ................... v1.4.0 |
// | 27-MAI-04 - Adicionado Fun��o Marca��o com mais de 2 semanas. v2.0.0 |
// | 22-OUT-05 - Adicionado modulo para varias linguas ........... v2.2.0 |
// |                                                                      |
// | UPDATES:-                                                            |
// | DEC-04-03 - Initial release ................................. v0.0.0 |
// | DEC-23-03 - Added skin ...................................... v1.0.0 |
// | MAR-29-04 - Added scheduler cancel module ................... v1.1.0 |
// | MAR-31-04 - Added 30 min hour schedule delay ................ v1.2.0 |
// | APR-19-04 - Updated disable radio box mounth turn over ...... v1.3.0 |
// | APR-26-04 - Updated function show days ...................... v1.4.0 |
// | MAY-27-04 - Added function schedule more then two weeks ..... v2.0.0 |
// | OCT-22-05 - Added module for different languages ............ v2.2.0 |
// +----------------------------------------------------------------------+
// | Autor: Ighor Toth - http://www.ighor.com                             |
// +----------------------------------------------------------------------+
// | Arquivo de configura��o: conf.inc.php                                |
// | Estrutura do BD: sas.sql                                             |
// | Bugs ou problemas, escreva para: igtoth@netsite.com.br               |
// |                                                                      |
// | Configuration file: conf.inc.php                                     |
// | DB structure: sas.sql                                                |
// | Bugs or issues, write to: igtoth@netsite.com.br                      |
// +----------------------------------------------------------------------+

	include('conecta.php');

	$db=mysqli_connect ($servidor, $usuario, $senhadb) or die ('Impossivel conectar no bando de dados: ' . mysql_error());
	mysqli_select_db($db,$banco);

	$apagarc=$_POST["apagarc"];
	$matricula=$_POST["matricula"];
	$cod_sala=$_POST["cod_sala"];
	$nome=$_POST["nome"];

	function vazio($matricula,$cod_sala,$nome){

					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
					
						function tela(){
		
							alert('POR FAVOR SELECIONE UM HOR�RIO � SER APAGADO!')
							form = document.verifica
							form.action = 'apagar.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="apagar.php">
								<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();


	}

	if($apagarc==""){ vazio($matricula,$cod_sala,$nome); }

	foreach ($apagarc as $k => $v) {

		/* echo "\$apagarc[$k] => $v.\n"; */

		$sql = "DELETE FROM reservas WHERE datatempo = '$v' AND matricula = '$matricula' AND cod_sala = $cod_sala";

		if(mysqli_query($db,$sql)){
			$deletado=1;
		} else {
			$deletado=0;
		}

	}





	if($deletado==1){

					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
					
						function tela(){
		
							alert('RESERVA(S) APAGADA(S)!')
							form = document.verifica
							form.action = 'apagar.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="apagar.php">
								<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();


	} else {

		echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">REGISTROS N�O APAGADOS. CONTATE O SUPORTE LOCAL!!!</i><br><br> ERRO MySQL:</b> ". mysql_error());

	}


	/*
	foreach($apagar1 as $apa) { 

		echo $apa; echo("<br>");

	} 
	*/

?>
