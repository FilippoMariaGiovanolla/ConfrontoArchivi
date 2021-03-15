<HTML>
<HEAD>
	<TITLE>Cancellazione secondo file</TITLE>
</HEAD>
<BODY>
	<?php
		$hostname='localhost';
		$username='root';
		$conn=mysql_connect($hostname,$username,'')
			or die("Impossibile stabilire una connessione con il server");
		$db=mysql_select_db('confronto_archivi')
			or die("Impossibile selezionare il database di confronto degli archivi");
		$query="DELETE FROM archivio2";
		$risultato=mysql_query($query)
			or die("Cancellazione fallita; chiudere la pagina");
		echo("Cancellazione avvenuta con successo.");
	?>
	<BR>
	<BR>
	<A HREF="index.php">Torna alla pagina iniziale</A>
	<?php
		mysql_close($conn);
	?>
</BODY>
</HTML>