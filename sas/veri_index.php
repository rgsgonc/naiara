<?php
session_start();
$matricula=$_POST['matricula'];
$senha=$_POST['senha'];
include('languages/padrao.inc.php');


include('conf.inc.php');	

	$db=mysqli_connect ($servidor, $usuario, $senhadb)
	or die ('Impossivel conectar no bando de dados: ' . mysql_error());

function merro(){
	include('languages/padrao.inc.php');
	echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_06 '); window.navigate('index.php'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
}


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


if($matricula){

	include('conecta.php');

	mysqli_select_db($db,'helpi302_sas');

	$query = "SELECT * FROM sups WHERE matsup = '$matricula'"; 

	$result = mysqli_query($db,$query) or die(mysql_error());

	while($linha=mysqli_fetch_array($result)) { 
		if($linha["matsup"]==$matricula){
			if($linha["senha"]==$senha){

				if($linha["pri"]!=1){ // INICIO_ELSE_IF_1

					echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_08 '); window.navigate('pri.php?exe=sim&matsup=$matricula'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
					exit();

				} else {

					if($linha["ramal"]==0){ $pagina="user1.php"; } else { $pagina="user2.php"; }
					$_SESSION["nome"]=$linha["nome_sup"];
					$_SESSION["matricula"]=$linha["matsup"];
					$_SESSION["senha"]=$linha["senha"];
					$_SESSION["usu_index"]=$linha["ramal"];
					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
						
						function tela(){
		
							form = document.verifica
							form.action = '<?php echo $pagina; ?>'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="<?php echo $pagina; ?>">
								<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $linha["nome_sup"] ?>">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
						tela();
						</SCRIPT>
					</BODY>
					</HTML>
				
					<?php
					exit();

				} // FIM_ELSE_IF_1

			} else {
				merro();
				exit();
			}
		} else {
			merro();
			exit();
		}
	}

} else {

	merro();
	exit();

}

merro();
exit();

?>
