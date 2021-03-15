<html>
<head>		
	<title>Cancellazione files</title>
</head>
	<body>
		<center><b>Cancellazione dei files caricati</b></center>
		<br>
			<?php
				$host_name='localhost';
				$user_name='root';
				$conn=@mysql_connect($host_name,$user_name,'')
					or die ("<BR>Impossibile stabilire una connessione con il server");
				@mysql_select_db('confronto_archivi')
					or die ("Impossibile selezionare il database di confronto archivi, chiudere il programma e riprovare");
				echo("<ul>");
				$query1="SELECT *
					    FROM archivio1
					    limit 1";
				$risultato1=mysql_query($query1)
					or die("Verifica composizione archivio 1 fallita");
				$righe1=mysql_num_rows($risultato1);
				if ($righe1>0)
					echo('<li><a href="CancPrimoFile.php">Cancellazione file 1</a></li>');
				else
					echo('<li> File 1 assente</li>');
				$query2="SELECT *
					    FROM archivio2
					    limit 1";
				$risultato2=mysql_query($query2)
					or die("Verifica composizione archivio 2 fallita");
				$righe2=mysql_num_rows($risultato2);
				if ($righe2>0)
					echo('<li><a href="CancSecondoFile.php">Cancellazione file 2</a></li>');
				else
					echo('<li>File 2 assente</li>');
				echo("</ul>");
			?>
		<br>
		<a href="index.php">Torna alla pagina inziale</a>
		<?php
			mysql_close($conn);
		?>
	</body>
</html>
