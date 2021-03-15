<html>
	<head>
		<title>Confronto files</title>
	</head>
	<body>
		<?php
			/* questo file è una copia, di fatto, del file ConfrontoArchivi.php, con l'aggiunta, di tre linee di codice che vanno a migrare su file Excel il contenuto della pagina web, proponendo direttamente  il salvataggio del file xls prodotto dalla pagina */
			$host_name='localhost';
			$user_name='root';
			$conn=@mysql_connect($host_name,$user_name,'')
				or die ("<BR>Impossibile stabilire una connessione con il server");
			@mysql_select_db('confronto_archivi')
				or die ("Impossibile selezionare il database di confronto archivi, chiudere il programma e riprovare");
			$filename="RisultatoConfronto.xls";
			header ("Content-Type: application/vnd.ms-excel");
			header ("Content-Disposition: inline; filename=$filename");
			echo("<h2><div align='center'>Risultato del confronto</div></h2>");
			echo("<table border=0 width='100%'>");
				echo("<tr>");
					echo("<td width='100%' valign='middle'>");
						//echo("<div align='center'><h3>Record presenti nel primo file e non nel secondo</h3></div>");
						$query="SELECT COUNT(*) FROM archivio1 WHERE codicesoggetto NOT IN (SELECT codicesoggetto FROM archivio2)";
						$risultato=mysql_query($query)
							or die ("Impossibile stabilire quanti record sono presenti nel primo file e non nel secondo: ".mysql_error());
						while($riga=mysql_fetch_row($risultato))
							$quanti=$riga[0];
						if($quanti>0)
						{
							$query="SELECT codicesoggetto, cognome, nome
									FROM archivio1
									WHERE codicesoggetto NOT IN (SELECT codicesoggetto FROM archivio2)";
							$risultato=mysql_query($query)
								or die("Impossibile determinare quali record sono presenti nel primo file e non nel secondo: ".mysql_error());
							$num_colonne=mysql_num_fields($risultato)
								or die("Impossibile determinare il numero di colonne del risultato della query: ".mysql_error());				
							echo("<TABLE BORDER='1'>
										<tr>
											<td><h3>Record presenti nel primo file e non nel secondo</h3></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<TR>
											<TD><B>CodiceSoggetto</B></TD>
											<TD><B>Cognome</B></TD>
											<TD><B>Nome</B></TD>
										</TR>");
							while($riga=mysql_fetch_row($risultato))
							{
								echo("<tr>");
								for($i=0;$i<$num_colonne;$i++)
									echo("<td>".$riga[$i]."</td>");
								echo("</tr>");
							}
							echo("</table>");
						}
						else
							echo("<center><h3>Record presenti nel primo file e non nel secondo</h3>
								  <h3><font color='red'>Tutti i record presenti nel primo file sono presenti anche nel secondo</font></center></h3>");
						echo("<br>");
					echo("</td>");
				echo("</tr>");
			echo("</table>");
			echo("<br><br>");
			echo("<table border=0 width='100%'>");
				echo("<tr>");
					echo("<td width='100%' valign='middle'>");
						//echo("<div align='center'><h3>Record presenti nel secondo file e non nel primo</h3></div>");
						$query="SELECT COUNT(*) FROM archivio2 WHERE codicesoggetto NOT IN (SELECT codicesoggetto FROM archivio1)";
						$risultato=mysql_query($query)
							or die ("Impossibile stabilire quanti record sono presenti nel secondo file e non nel primo: ".mysql_error());
						while($riga=mysql_fetch_row($risultato))
							$quanti=$riga[0];
						if($quanti>0)
						{
							$query="SELECT codicesoggetto, cognome, nome
									FROM archivio2
									WHERE codicesoggetto NOT IN (SELECT codicesoggetto FROM archivio1)";
							$risultato=mysql_query($query)
								or die("Impossibile determinare quali record sono presenti nel secondo file e non nel primo: ".mysql_error());
							$num_colonne=mysql_num_fields($risultato)
								or die("Impossibile determinare il numero di colonne del risultato della query 2: ".mysql_error());				
							echo("<TABLE BORDER='1'>
										<tr>
											<td><h3>Record presenti nel secondo file e non nel primo</h3></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<TR>
											<TD><B>CodiceSoggetto</B></TD>
											<TD><B>Cognome</B></TD>
											<TD><B>Nome</B></TD>
										</TR>");
							while($riga=mysql_fetch_row($risultato))
							{
								echo("<tr>");
								for($i=0;$i<$num_colonne;$i++)
									echo("<td>".$riga[$i]."</td>");
								echo("</tr>");
							}
							echo("</table>");
						}
						else
							echo("<center><h3>Record presenti nel secondo file e non nel primo</h3>
								  <h3><font color='red'>Tutti i record presenti nel secondo file sono presenti anche nel primo</font></center></h3>");
						echo("<br>");
					echo("</td>");
				echo("</tr>");
			echo("</table>");

			@mysql_close($conn);
		?>
	</body>
</html>