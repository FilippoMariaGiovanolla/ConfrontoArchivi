<html>
	<head>
		<title>Confronto archivi</title>
	</head>
	<body>
		<center><strong>Programma di confronto tra due archivi</strong></center>
		<br>
		<ul>
			<li>
				<?php
					$host_name='localhost';
					$user_name='root';
					$conn=@mysql_connect($host_name,$user_name,'')
						or die ("<BR>Impossibile stabilire una connessione con il server");
					@mysql_select_db('confronto_archivi')
						or die ("Impossibile selezionare il database di confronto archivi, chiudere il programma e riprovare");
					$query1="SELECT *
						    FROM archivio1
						    limit 1";
					$risultato1=mysql_query($query1)
						or die("Verifica composizione archivio 1 fallita");
					$righe1=mysql_num_rows($risultato1);
					$query2="SELECT *
						    FROM archivio2
						    limit 1";
					$risultato2=mysql_query($query2)
						or die("Verifica composizione archivio 2 fallita");
					$righe2=mysql_num_rows($risultato2);
					//echo("srighe1= ".$righe1);
					//echo("<br>");
					//echo("srighe2= ".$righe2);
					if (($righe1!==0) and ($righe2!==0))
						echo("Caricamento files da confrontare (passo gi&agrave; eseguito)");
					else
						echo('<a href="ImportDati.php">Caricamento files da confrontare</a>');
				?>
			</li>
			<li>
				<?php
					$query1="SELECT *
						    FROM archivio1
						    limit 1";
					$risultato1=mysql_query($query1)
						or die("Verifica composizione archivio 1 fallita");
					$righe1=mysql_num_rows($risultato1);
					$query2="SELECT *
						    FROM archivio2
						    limit 1";
					$risultato2=mysql_query($query2)
						or die("Verifica composizione archivio 2 fallita");
					$righe2=mysql_num_rows($risultato2);
					if (($righe1!==0) and ($righe2!==0))
						echo('<a href="ConfrontoArchivi.php">Confronto tra i files caricati</a>');
					else
						echo("Confronto tra i files caricati (passo non ancora eseguibile, in quanto almeno uno dei due files non &egrave; stato ancora caricato)");
				?>
			</li>
			<li>
				<?php
					$query1="SELECT *
						    FROM archivio1
						    limit 1";
					$risultato1=mysql_query($query1)
						or die("Verifica composizione archivio 1 fallita");
					$righe1=mysql_num_rows($risultato1);
					$query2="SELECT *
						    FROM archivio2
						    limit 1";
					$risultato2=mysql_query($query2)
						or die("Verifica composizione archivio 2 fallita");
					$righe2=mysql_num_rows($risultato2);
					if (($righe1!==0) or ($righe2!==0))
						echo('<a href="CancellazioneArchivi.php">Cancellazione files caricati</a>');
					else
						echo("Cancellazione files caricati (passo non ancora eseguibile, in quanto almeno uno dei due files non &egrave; stato ancora caricato)");
				?>
			</li>
		</ul>
		<?php
			mysql_close($conn);
		?>
	</body>
</html>