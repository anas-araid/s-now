/*DROP DATABASE IF EXISTS my_snow;*/

CREATE DATABASE IF NOT EXISTS my_snow DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

USE my_snow;

CREATE TABLE t_utenti(
  ID_utente     BIGINT            NOT NULL AUTO_INCREMENT,
  Nome          VARCHAR(50),
  Cognome       VARCHAR(50),
  DataDiNascita DATE,
  Genere        ENUM('M', 'F'),
  Citta         VARCHAR(50),
  Bio           VARCHAR(50),
  Valutazione   ENUM('1', '2', '3', '4', '5'),
  Email         VARCHAR(50) UNIQUE,
  Password      CHAR(65),
  PRIMARY KEY(ID_utente)
)ENGINE=InnoDB;

CREATE TABLE t_segnalazioni(
  ID_segnalazione   BIGINT NOT NULL AUTO_INCREMENT,
  Via           VARCHAR(50),
  Longitudine   VARCHAR(50),
  Latitudine    VARCHAR(50),
  Pericolosita  ENUM('Bassa', 'Medio-bassa', 'Media', 'Medio-alta', 'Alta'),
  Data          DATE,
  Immagine      VARCHAR(80),
  FK_IdUtente   BIGINT,
  PRIMARY KEY(ID_segnalazione),
  FOREIGN KEY (FK_IdUtente) REFERENCES my_snow.t_utenti(ID_utente)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB;
