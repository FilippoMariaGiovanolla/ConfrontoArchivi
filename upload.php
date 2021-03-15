<?php
// controllo che non ci siano stati errori nell'upload (codice = 0) 
if ($_FILES['uploadfile']['error'] == 0)
  {
	// upload ok
	// copio il file dalla cartella temporanea a quella di destinazione mantenendo il nome originale 
	copy($_FILES['uploadfile']['tmp_name'], "C:/Program Files (x86)/EasyPHP 2.0b1/www/ConfrontoArchivi/".$_FILES['uploadfile']['name']) or die("Impossibile caricare il file");
	// upload terminato, stampo alcune info sul file
	echo "Il file &egrave; stato correttamente importato sul server";
	//echo "Nome file: ".$_FILES['uploadfile']['name']."<br>";
	//echo "Dimensione file: ".$_FILES['uploadfile']['size']."<br>";
	//echo "Tipo MIME file: ".$_FILES['uploadfile']['type'];
   }
     else
     {
	// controllo il tipo di errore
	if ($_FILES['uploadfile']['error'] == 2)
	  {
		// errore, file troppo grande (> 1MB)
		die("Errore, file troppo grande: il massimo consentito &egrave; 1MB");
           }
	     else
	       {
		   // errore generico
		   die("Errore, impossibile caricare il file");
		}
     }

$host_name='localhost';
$user_name='root';
$conn=@mysql_connect($host_name,$user_name,'')
	or die ("<BR>Impossibile stabilire una connessione con il server ed inserire nel database i dati importati");
@mysql_select_db('confronto_archivi')
	or die ("Impossibile selezionare il database di confronto archivi, chiudere il programma e riprovare");

//query che mi permette di capire se sto importando il file 1 o il file 2
$query1="SELECT *
	      FROM archivio1
	      limit 1";
$risultato1=mysql_query($query1)
	or die("Verifica composizione archivio 1 fallita");
$righe=mysql_num_rows($risultato1);

//Creo una variabile con il file CSV da importare
if ($righe==0)
    {
	$CSVFile="C:/Program Files (x86)/EasyPHP 2.0b1/www/ConfrontoArchivi/archivio1.csv";
	$passo=1;
	$risultato=mysql_query("LOAD DATA LOCAL INFILE '" .$CSVFile. "' INTO TABLE archivio1 FIELDS TERMINATED BY ';' LINES TERMINATED BY '\\r\\n';")
		or die ("Impossibile caricare i dati dell'archivio 1");
    }
else
   {
	$CSVFile="C:/Program Files (x86)/EasyPHP 2.0b1/www/ConfrontoArchivi/archivio2.csv";
	$passo=2;
	$risultato=mysql_query("LOAD DATA LOCAL INFILE '" .$CSVFile. "' INTO TABLE archivio2 FIELDS TERMINATED BY ';' LINES TERMINATED BY '\\r\\n';")
		or die ("Impossibile caricare i dati dell'archivio 2");

   }

if ($risultato and ($passo==1))
  {
	$query="SELECT *
		    FROM archivio1";
	$risultato2=mysql_query($query)
		or die("<br> <br> Non &egrave; possibile mostrare a video il contenuto del database");
	$righe=mysql_num_rows($risultato2);
	$colonne=mysql_num_fields($risultato2);
	if ($righe>0)
	  {
		echo("<br>");
		echo("<br>");
		echo("<br>");
		echo("<CENTER><b>Contenuto dell'archivio 1</b></CENTER>");
		echo("<br>");
		echo("<TABLE BORDER='1' ALIGN='CENTER'
				<TR>
					<TD><B>Codice Soggetto</B></TD>
					<TD><B>Cognome</B></TD>
					<TD><B>Nome</B></TD>
				</TR>");
		while ($riga=mysql_fetch_row($risultato2))
		       {
			  echo("<TR>");
			  for ($j=0;$j<$colonne;$j++)
			      echo("<TD>".$riga[$j]."</TD>");
			  echo("</TR>");
		       }
		echo("</TABLE>");
	  } // fine if ($righe>0)
	  else echo("<H3>, ma, essendo vuoto, il relativo archivio non &egrave; stato popolato.</H3>");
	echo("<br>");
	echo('<div align="right"><a href="index.php">Torna alla pagina iniziale</a></div>');
  } // fine if ($risultato and ($passo==1))
elseif ($risultato and ($passo==2))
{
	$query="SELECT *
		    FROM archivio2";
	$risultato2=mysql_query($query)
		or die("<br> <br> Non &egrave; possibile mostrare a video il contenuto del database");
	$righe=mysql_num_rows($risultato2);
	$colonne=mysql_num_fields($risultato2);
	if ($righe>0)
	  {
		echo("<br>");
		echo("<br>");
		echo("<br>");
		echo("<CENTER><b>Contenuto dell'archivio 2</b></CENTER>");
		echo("<br>");
		echo("<TABLE BORDER='1' ALIGN='CENTER'
				<TR>
					<TD><B>Codice Soggetto</B></TD>
					<TD><B>Cognome</B></TD>
					<TD><B>Nome</B></TD>
				</TR>");
		while ($riga=mysql_fetch_row($risultato2))
		       {
			  echo("<TR>");
			  for ($j=0;$j<$colonne;$j++)
			      echo("<TD>".$riga[$j]."</TD>");
			  echo("</TR>");
		       }
		echo("</TABLE>");
	  } // fine if ($righe>0)
	  else echo("<H3>, ma, essendo vuoto, il relativo archivio non &egrave; stato popolato.</H3>");
	echo("<br>");
	echo('<div align="right"><a href="index.php">Torna alla pagina iniziale</a></div>');
  } // fine if ($risultato and ($passo==1))
else
	die (", ma il database non &egrave; stato correttamente popolato. Riprovare.");

mysql_close($conn);
?>