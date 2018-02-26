/*DROP DATABASE IF EXISTS my_snow;*/
CREATE DATABASE IF NOT EXISTS my_snow DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
USE my_snow;

CREATE TABLE t_utenti (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  DataDiNascita		 DATE,
  Genere 			     ENUM('M', 'F'),
  Residenza        VARCHAR(50),
  FotoProfilo      VARCHAR(100),
  Valutazione      ENUM('1', '2', '3', '4', '5'),
  Email 			     VARCHAR(50)	UNIQUE,
  Password			   CHAR(64),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_segnalazioni(
  ID              BIGINT        NOT NULL AUTO_INCREMENT,
  Latitudine      VARCHAR(40),
  Longitudine     VARCHAR(40),
  Descrizione     CHAR(64),
  Pericolosita    ENUM('Bassa', 'Medio-bassa','Media', 'Medio-alta', 'Alta'),
  Data            DATE,
  FK_utente       BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_utente)    REFERENCES t_utenti(ID)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE t_messaggi(
  ID              BIGINT        NOT NULL AUTO_INCREMENT,
  Data            DATE,
  Messaggio       VARCHAR(130),
  FK_Mittente     BIGINT        NOT NULL,
  FK_Destinatario BIGINT        NOT NULL,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Mittente)    REFERENCES t_utenti(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Destinatario)    REFERENCES t_utenti(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB;
