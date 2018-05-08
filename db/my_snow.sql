DROP DATABASE IF EXISTS my_snow;
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
  Email 			     VARCHAR(50)	UNIQUE,
  Password			   CHAR(64),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_segnalazioni(
  ID              BIGINT        NOT NULL AUTO_INCREMENT,
  Latitudine      VARCHAR(40),
  Longitudine     VARCHAR(40),
  Via             VARCHAR(50),
  Citta           VARCHAR(50),
  Descrizione     CHAR(64),
  Pericolosita    ENUM('1', '2','3', '4', '5'),
  Data            DATE,
  FK_utente       BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_utente)    REFERENCES t_utenti(ID)
    ON DELETE SET NULL
    ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE t_messaggi(
  ID              BIGINT        NOT NULL AUTO_INCREMENT,
  Data            DATE,
  Messaggio       VARCHAR(70),
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

INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password) VALUES('Mario', 'Rossi', '1999-01-01', 'M', 'Pergine Valsugana', 'uploads/default.png', 'mario@rossi.com', '5f4dcc3b5aa765d61d8327deb882cf99');
INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password) VALUES('Giuseppe', 'Verdi', '1950-04-20', 'M', 'Pergine Valsugana', 'uploads/default.png', 'giuseppe@verdi.com', '5f4dcc3b5aa765d61d8327deb882cf99');
INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password) VALUES('Anas', 'Araid', '1999-05-18', 'M', 'Pergine Valsugana', 'uploads/default.png', 'anas@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');
