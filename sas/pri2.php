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

$atu=$_GET['atu'];
$exe=$_GET['exe'];

if($atu==1){

	include('conecta.php');

	$db=mysqli_connect ($servidor, $usuario, $senhadb) or die ('Impossivel conectar no bando de dados: ' . mysql_error());
	mysqli_select_db($db,$banco);

	$matsup1=$_POST['matsup1'];
	$ilha1=$_POST['ilha1'];
	$pri1=$_POST['pri1'];
	$nome1=$_POST['nome1'];
	$senha2=$_POST['senha2'];

	$sql = "UPDATE sups SET matsup='$matsup1',nome_sup='$nome1',senha='$senha2',ilha='$ilha1',pri='$pri1' WHERE matsup=$matsup1";

	if(mysqli_query($db,$sql)){
	
			echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_09 '); window.navigate('index.php'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
		} else {
			echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_10 '); window.navigate('index.php'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
		}
}

if($exe){

	include('conecta.php');

	$matsup=$_GET['matsup'];

	$db=mysqli_connect ($servidor, $usuario, $senhadb) or die ('Impossivel conectar no bando de dados: ' . mysql_error());
	mysqli_select_db($db,$banco);

	$query = "SELECT * FROM sups WHERE matsup = '$matsup'"; 
	$result = mysqli_query($db,$query) or die(mysql_error());
	$linha = mysqli_fetch_array($result);
	$nome = $linha["nome_sup"];
	$ilha = $linha["ilha"];


				?>

					<SCRIPT LANGUAGE="JavaScript">
					
					function tela(){
						
						form = document.sen
						senha1 = form.senha1.value
						senha2 = form.senha2.value

						if(senha1 == senha2){
							form.action = 'pri.php?atu=1'
							form.submit();							
						} else {
							alert("<?php echo $L_MENSAGEM_11; ?>")
							form.senha1.focus()
							return;
						}
	
					}
						
					</SCRIPT>

					
						<form name="sen" method="post" action="pri.php?atu=1">
							<input type="hidden" name="matsup1" border=0 value="<?php echo $matsup; ?>">
							<input type="hidden" name="ilha1" border=0 value="<?php echo $ilha; ?>">
							<input type="hidden" name="pri1" border=0 value="1">
							<input type="hidden" name="nome1" border=0 value="<?php echo $nome; ?>">

							<table align="center">
								<tr>
									<td>
										<font size="3" face="arial"><b><?php echo $L_MENSAGEM_12; ?><br><br>
										Usuario: <br> <?php echo $nome; ?>
									</td>
								</tr>
							</table>
							<hr>
							<table align="center">
								<tr>
									<td>
										<font size="2" face="arial"><?php echo $L_MENSAGEM_13; ?>
									</td>
									<td>
										<font size="2" face="arial"><?php echo $L_MESANGEM_14; ?>
									</td>
								</tr>
								<tr>
									<td>
										<input border="0" class="bordas" type="password" name="senha1" border=0 value="">
									</td>
									<td>
										<input border="0" class="bordas" type="password" name="senha2" border=0 value="">
									</td>
								</tr>
								<tr>
									<td>
									</td>
									<td>
										<p align="right"><input border="0" class="bordas" type="button" name="enviar" value="<?php echo $L_CRIAR_SENHA; ?>" onClick="javascript:tela();"></p>
									</td>
								</tr>
							</table>
						</form>

<?php
		

}


?>
