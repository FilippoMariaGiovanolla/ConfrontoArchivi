/*per importarlo è necessario accedere al monitor MySql del prompt dei comandi e digitare
 source [percorso file con barre \ + nome_file --> es. C\documenti\creazionedb.sql]*/

CREATE DATABASE confronto_archivi;
USE confronto_archivi;

CREATE TABLE archivio1
(
CodiceSoggetto INTEGER,
Cognome VARCHAR(100),
Nome VARCHAR(50),
PRIMARY KEY(CodiceSoggetto)
);

CREATE TABLE archivio2
(
CodiceSoggetto INTEGER,
Cognome VARCHAR(100),
Nome VARCHAR(50),
PRIMARY KEY(CodiceSoggetto)
);