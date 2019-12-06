<?php
// +----------------------------------------------------------------------+
// | SAS - Sistema de Agendamento de Sala (Portuguese Version)            |
// | RSS - Room Scheduler System (English Version)                        |
// +----------------------------------------------------------------------+
// | DESENVOLVIDO NO BRASIL !!! DEVELOPED IN BRAZIL !!!                   |
// +----------------------------------------------------------------------+
// | ATUALIZAÇÕES:-                                                       |
// | 04-DEZ-03 - Versão Inicial .................................. v0.0.0 |
// | 23-DEZ-03 - Implemetação de Skin ............................ v1.0.0 |
// | 29-MAR-04 - Adicionado Cancelamento de Reservas ............. v1.1.0 |
// | 31-MAR-04 - Adicionado Marcação 30 min de Reservas .......... v1.2.0 |
// | 19-ABR-04 - Correção disable radio box virada de mês ........ v1.3.0 |
// | 26-ABR-04 - Correção função monstrar dias ................... v1.4.0 |
// | 27-MAI-04 - Adicionado Função Marcação com mais de 2 semanas. v2.0.0 |
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
// | Arquivo de configuração: conf.inc.php                                |
// | Estrutura do BD: sas.sql                                             |
// | Bugs ou problemas, escreva para: igtoth@netsite.com.br               |
// |                                                                      |
// | Configuration file: conf.inc.php                                     |
// | DB structure: sas.sql                                                |
// | Bugs or issues, write to: igtoth@netsite.com.br                      |
// +----------------------------------------------------------------------+
?>
	<title><?php echo $L_TITULO; ?></title>

	<style type="text/css">
	.bordas {
		border: 1px solid #999999;
	}
	</style>

	<?php
	include('conecta.php');

	$salas=$_GET["salas"];

	if($salas==sim){ 

	?>

	<table width="500" align="center">
		<tr align="center">	
			<td align="center" >

				<table width="100%" align="center" >
					<tr align="center">	
						<td align="left">    <font size=3 face="arial"><b><?php echo $L_SALAS; ?>

						</td>
						<td align="right">
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?edsala=sim&nova=sim','_self');">
							<?php echo $L_NOVA_SALA; ?>
							</BUTTON>
						</td>
					</tr>
				</table>

				<table border="0" width="100%" bgcolor="#9EC8FF" >

					<tr bgcolor="#EDF5FF">

						<td width="15%" ><font size=2 face="arial" color="#ffffff">
							<b><font color='#4682B4'><?php echo $L_SALA; ?>
						</td>
						<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
							<b><font color='#4682B4'><?php echo $L_EDITAR; ?>
						</td>
						<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
							<b><font color='#4682B4'><?php echo $L_APAGAR; ?>
						</td>
					</tr>

					<?php
					
					
					$sqlus = "SELECT * from salas ORDER BY nome_sala";
					$resultado = mysqli_query($db,$sqlus) or die(mysql_error());
					$ci=0;
					while($linha_us=mysqli_fetch_array($resultado)) { 

					?>

					<tr bgcolor="#<?php if($ci==0){ echo("FFFFFF"); $ci=1; } else { echo("F5F5F5"); $ci=0; } ?>">
						<td><font size=2 face="arial">
							<center><?php echo $linha_us["nome_sala"]; ?>
						</td>
						<td align="left"><font size=1 face="arial">
							<center><a href="salas.php?edsala=<?php echo $linha_us["cod_sala"]; ?>&nome=<?php echo $linha_us["nome_sala"]; ?>"><img src="img/editar.gif" border="0" alt="<?php echo $L_EDITAR_DADOS_DA_SALA; ?> <?php echo $linha_us["nome_sala"]; ?>"></a>
						</td>
						<td align="left"><font size=1 face="arial">
							<center><a href="salas.php?apasala=<?php echo $linha_us["cod_sala"]; ?>&nome=<?php echo $linha_us["nome_sala"]; ?>"><img src="img/apagar.gif" border="0" alt="<?php echo $L_APAGAR_DADOS_DA_SALA; ?> <?php echo $linha_us["nome_sala"]; ?>"></a>
						</td>

					</tr>

					<?php
					} 
					?>

				</table>
			</td>
		</tr>
	</table>
	
	<table width="100%" align="center"  >
		<tr align="center">	
			<td align="left">

				<BUTTON border="0" class="bordas" OnClick="AAA=window.open('adm.php?sam=hjk','_self');">
					<?php echo $L_VOLTAR; ?>
				</BUTTON>
			</td>
		</tr>
	</table>


			<?php

			} // FIM SALAS


			// -------------------------------------------------------------------------------


			$edsala=$_GET["edsala"];

			if($edsala){ 

				$nova=$_GET["nova"];

				if($nova=="sim"){

					echo("");

				} else {

				$sql = "SELECT * from salas WHERE cod_sala = $edsala";
				$result = mysqli_query($db,$sql) or die(mysql_error());
				$linha=mysqli_fetch_array($result);

				}
	
			?>

				<table width="100%" align="center">
					<tr align="center">	
						<td align="center" class="bordas" bgcolor="#ffffff">
	
							<table width="100%" align="center" class="bordas" bgcolor="#483D8B">
								<tr align="center">	
									<td align="left">
										<font size=4 face="arial" color="#ffffff"><b><?php if($nova){ echo("Nova Sala."); } else { echo("Editar Sala"); } ?>
									</td>
								</tr>
							</table>
							
							<table width="100%" align="center">
								<tr>	
									<td  align="right">
										<form name="edusersform" method="post" action="salas.php">
										<font face="arial,verdana" size="2">Nome: </font><br>
									</td>
									<td align="left">	
										
										<input type=text size="40" name="nome" value="<?php if($nova){ echo(""); } else { echo $linha["nome_sala"]; } ?>"><br>
										
									</td>
								</tr>
							</table>
							<table border="0">
								<tr>
									<td align="center">
										<center>
											<?php

											if($nova){
	
											?>
												<input border="0" class="bordas" type="Submit" name="edsala_nova" border=0 value="Adicionar"> 
	
											<?php
	
											} else {
	
											?>

												<input type="Hidden" name="cod_sala" border=0 value="<?php echo $edsala; ?>">
						
												<input border="0" class="bordas" type="Submit" name="edsala_env" border=0 value="Alterar">
												<br><br>
												
										
											<?php

											}	

											?>

										</form>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

			<?php
	
			} // FIM NOVO_SALA


			// ------------------------------------------------------------

	// ----------------------------------------------------------- 

		$edsala_env=$_POST["edsala_env"];

		if($edsala_env){ // INICIO SALA_ENV

			$nome=$_POST["nome"];
			$cod_sala=$_POST["cod_sala"];

			$sql = "UPDATE salas SET nome_sala='$nome',cod_sala='$cod_sala' WHERE cod_sala = $cod_sala";

			if(mysqli_query($db,$sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('Sala Atualizada'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO ATUALIZADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} // FIM SALA_ENV	

		// CONTINUAR AQUI


		// -----------------------------------------------------------

		$edsala_nova=$_POST["edsala_nova"];

		if($edsala_nova){ // INICIO SALA_NOVA

			$nome=$_POST["nome"];

			$sql = "INSERT INTO salas (nome_sala) VALUES ('$nome')";

			if(mysqli_query($db,$sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('Sala Adicionada'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO ADICIONADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} 


		


		$apasala=$_GET["apasala"];

		if($apasala){ // INICIO APA_SALA

			$confirmado=$_GET["confirmado"];

			$nome=$_GET["nome"];

			if($confirmado!="ok"){

				?>

				<table bgcolor="#ffffff" align="center" width="100%" class="bordas">
					<tr>
						<td width="90%" align="center">
							<font face="arial" size="2"><center>
							Todos os dados referente a sala <b><?php echo $nome; ?></b> serão apagados, inclusive marcações efetuadas anteriormentes.<br><br><font size="3"><b> Deseja realmente apagar esta sala?</b> <br><br>
							
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?apasala=<?php echo $apasala; ?>&confirmado=ok','_self');">
							SIM
							</BUTTON>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?salas=sim','_self');">
							NÃO
							</BUTTON>

						</td>
					</tr>
				</table>

				<?php

			} else {

				$sql1 = "DELETE FROM reservas WHERE cod_sala = $apasala";
			
				if(!mysqli_query($db,$sql1)){
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO APAGADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
					exit();
				}

				$sql = "DELETE FROM salas WHERE cod_sala = $apasala";
			
				if(mysqli_query($db,$sql)){

					echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('Sala Apagada'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
				} else {
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO APAGADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
				}
	
			}

		} // FIM ADM_APAUSER
