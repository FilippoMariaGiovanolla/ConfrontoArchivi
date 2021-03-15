<html>
	<head>
		<title>Selezione files</title>
	</head>
	<body>
		<center><strong>Selezione dei file da confrontare</strong></center>
		<br>
		Mediante questa funzione &egrave; possibile acquisire i file csv di cui confrontare vicendevolmente il contenuto.
		<br>
		Ricordo che il primo file deve essere nominato come "archivio1.csv", mentre il secondo file deve essere nominato come "archivio2.csv"
		<br>
		E' importante anche che, prima di importare i due file, il contenuto di questi venga ordinato per codice soggetto.
		<br> <br>
		<form name="upload" method="post" action="upload.php" enctype="multipart/form-data">
			<FIELDSET>
			<LEGEND ALIGN="center">Selezione files</LEGEND>
				<FIELDSET>
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
					if ($righe1==0)
					  {
						echo ('Seleziona il primo file &nbsp;&nbsp;&nbsp;<input type="file" name="uploadfile">');
						$passo=1;
					  }
					else
					  {
						echo("Il primo file &egrave; gi&agrave; stato selezionato");
						$passo=2;
					  }
					
					echo("<br>");
					
					$query2="SELECT *
						    FROM archivio2
						    limit 1";
					$risultato2=mysql_query($query2)
						or die("Verifica composizione archivio 2 fallita");
					$righe2=mysql_num_rows($risultato2);
					if (($righe2==0) and ($passo==2))
						echo ('Seleziona il secondo file &nbsp;&nbsp;&nbsp;<input type="file" name="uploadfile">');
					if (($righe2==0) and ($passo==1))
						echo("Il secondo file sar&agrave; selezionabile successivamente, ritornando in questa pagina");
					else
						echo("Il secondo file &egrave; gi&agrave; stato selezionato");
					?>
				</FIELDSET>
				<br>
				<input type="submit" name="go" value="Inserisci">
			</FIELDSET>
		</form>
		<!--<br>-->
		<div align="right"><a href="index.php">Torna alla pagina iniziale</a></div>
		<?php
			mysql_close($conn);
		?>
	</body>
</html>