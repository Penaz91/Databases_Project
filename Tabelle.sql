-- Disabilito le notes, per pulire gli warnings
SET sql_notes=0;
-- Disabilito i foreign key checks
SET FOREIGN_KEY_CHECKS=0;
-- Creazione della tabella Citta
DROP TABLE IF EXISTS Citta;
CREATE TABLE Citta (
	Codice varchar(6) NOT NULL,
	Nome varchar(20) NOT NULL,
	Provincia varchar(20) NOT NULL,
	Regione varchar(20) NOT NULL,
	Contratti_Proposti integer,
	PRIMARY KEY (Codice)
) Engine=InnoDB;

-- Creazione Della Tabella Abitazione
DROP TABLE IF EXISTS Abitazione;
CREATE TABLE Abitazione (
	Codice varchar(8) NOT NULL,
	Civico varchar(5) NOT NULL,
	Via varchar(30) NOT NULL,
	Sezione_Interno varchar(2),
	Citta varchar(20) NOT NULL,
	PRIMARY KEY (Codice),
	FOREIGN KEY (Citta) REFERENCES Citta(Codice)
) Engine=InnoDB;

-- Creazione della tabella Sede
DROP TABLE IF EXISTS Sede;
CREATE TABLE Sede (
	Numero integer NOT NULL,
	Citta varchar(20) NOT NULL,
	Via varchar(30) NOT NULL,
	Civico varchar(5) NOT NULL,
	Direttore varchar(20),
	PRIMARY KEY (Numero, Citta),
	FOREIGN KEY (Citta) REFERENCES Citta(Codice)
) Engine=InnoDB;

-- Creazione della Tabella Dipendente
DROP TABLE IF EXISTS Dipendente;
CREATE TABLE Dipendente (
	Matricola varchar(6) NOT NULL,
	Nome varchar(20) NOT NULL,
	Cognome varchar(20) NOT NULL,
	Numero_Telefono varchar(10) NOT NULL,
	Sede_Afferenza integer,
	Citta_Afferenza varchar(20),
	PRIMARY KEY (Matricola),
	FOREIGN KEY (Sede_Afferenza, Citta_Afferenza) REFERENCES Sede(Numero, Citta)
) Engine=InnoDB;
-- Creazione della Tabella Direttore
DROP TABLE IF EXISTS Direttore;
CREATE TABLE Direttore (
	Dipendente varchar(6) NOT NULL,
	PRIMARY KEY (Dipendente),
	FOREIGN KEY (Dipendente) REFERENCES Dipendente(Matricola)
) Engine=InnoDB;

-- Chiusura del loop di chiavi direttore-sede
ALTER TABLE Sede ADD CONSTRAINT ChiaveDirettore FOREIGN KEY (Direttore) REFERENCES Direttore(Dipendente);

-- Creazione Tabella Segretario
DROP TABLE IF EXISTS Segretario;
CREATE TABLE Segretario (
	Dipendente varchar(6) NOT NULL,
	PRIMARY KEY (Dipendente),
	FOREIGN KEY (Dipendente) REFERENCES Dipendente(Matricola)
) Engine=InnoDB;

-- Creazione Tabella Agente
DROP TABLE IF EXISTS Agente;
CREATE TABLE Agente (
	Dipendente varchar(6) NOT NULL,
	PRIMARY KEY (Dipendente),
	FOREIGN KEY (Dipendente) REFERENCES Dipendente(Matricola)
) Engine=InnoDB;

-- Creazione Tabella Cliente
DROP TABLE IF EXISTS Cliente;
CREATE TABLE Cliente (
	Codice_Fiscale varchar(16) NOT NULL,
	Nome varchar(20) NOT NULL,
	Cognome varchar(20) NOT NULL,
	Data_Nascita date,
	PRIMARY KEY (Codice_Fiscale)
) Engine=InnoDB;

-- Creazione Tabella Contratto
DROP TABLE IF EXISTS Contratto;
CREATE TABLE Contratto (
	Codice varchar(6) NOT NULL,
	Data_Proposta date NOT NULL,
	Valore_Mutuo decimal(8,2),
	Tipo varchar(20) NOT NULL,
	Prezzo_o_Rata decimal(8,2) NOT NULL,
	Agente_Proponente varchar(20) NOT NULL,
	Abitazione varchar(8) NOT NULL,
	Data_Ratifica date,
	PRIMARY KEY (Codice),
	FOREIGN KEY (Agente_Proponente) REFERENCES Agente(Dipendente),
	FOREIGN KEY (Abitazione) REFERENCES Abitazione(Codice)
) Engine=InnoDB;

-- Creazione Tabella Cedente
DROP TABLE IF EXISTS Cedente;
CREATE TABLE Cedente (
	Cliente varchar(16) NOT NULL,
	Contratto varchar(6) NOT NULL,
	PRIMARY KEY (Cliente, Contratto),
	FOREIGN KEY (Cliente) REFERENCES Cliente(Codice_Fiscale),
	FOREIGN KEY (Contratto) REFERENCES Contratto(Codice)
) Engine=InnoDB;

-- Creazione Tabella Cessionario
DROP TABLE IF EXISTS Cessionario;
CREATE TABLE Cessionario (
	Cliente varchar(16) NOT NULL,
	Contratto varchar(6) NOT NULL,
	PRIMARY KEY (Cliente, Contratto),
	FOREIGN KEY (Cliente) REFERENCES Cliente(Codice_Fiscale),
	FOREIGN KEY (Contratto) REFERENCES Contratto(Codice)
) Engine=InnoDB;

-- Creazione Tabella Appuntamento
DROP TABLE IF EXISTS Appuntamento;
CREATE TABLE Appuntamento (
	Codice varchar(10) PRIMARY KEY,
	Data date NOT NULL,
	Ora time NOT NULL,
	Agente varchar(6) NOT NULL,
	Segretario varchar(6) NOT NULL,
	FOREIGN KEY (Agente) REFERENCES Agente(Dipendente),
	FOREIGN KEY (Segretario) REFERENCES Segretario(Dipendente)
) Engine=InnoDB;


-- Creazione Tabella Cliente -> *Presenza* -> Appuntamento
DROP TABLE IF EXISTS Presenza;
CREATE TABLE Presenza (
	Appuntamento varchar(10),
	Cliente varchar(16),
	FOREIGN KEY (Appuntamento) REFERENCES Appuntamento(Codice),
	FOREIGN KEY (Cliente) REFERENCES Cliente(Codice_Fiscale)
) Engine=InnoDB;

-- Riempimento Tabelle
LOAD DATA LOCAL INFILE 'Riempimento_Citta.tsv' INTO TABLE Citta;
LOAD DATA LOCAL INFILE 'Riempimento_Cliente.tsv' INTO TABLE Cliente;
LOAD DATA LOCAL INFILE 'Riempimento_Abitazione.tsv' INTO TABLE Abitazione;
LOAD DATA LOCAL INFILE 'Riempimento_Sedi.tsv' INTO TABLE Sede;
LOAD DATA LOCAL INFILE 'Riempimento_Dipendenti.tsv' INTO TABLE Dipendente;
LOAD DATA LOCAL INFILE 'Riempimento_Direttori.tsv' INTO TABLE Direttore;
LOAD DATA LOCAL INFILE 'Riempimento_Segretari.tsv' INTO TABLE Segretario;
LOAD DATA LOCAL INFILE 'Riempimento_Agenti.tsv' INTO TABLE Agente;
LOAD DATA LOCAL INFILE 'Riempimento_Contratti.tsv' INTO TABLE Contratto;
LOAD DATA LOCAL INFILE 'Riempimento_Cedenti.tsv' INTO TABLE Cedente;
LOAD DATA LOCAL INFILE 'Riempimento_Cessionari.tsv' INTO TABLE Cessionario;
LOAD DATA LOCAL INFILE 'Riempimento_Appuntamenti.tsv' INTO TABLE Cessionario;
LOAD DATA LOCAL INFILE 'Riempimento_Presenze.tsv' INTO TABLE Cessionario;

SET FOREIGN_KEY_CHECKS=1;

-- Inserimento Funzioni
-- 1. Funzione che dato un parametro ("min" o "max") ritorna la città con numero minimo/massimo di contratti Proposti
-- 2. Funzione che dato un cliente ritorna il numero di contratti che ha sottoscritto e ratificato, sia di acquisizione che di cessione
DROP FUNCTION IF EXISTS Contratti_Ratificati;
DELIMITER |
CREATE FUNCTION Contratti_Ratificati(CF VARCHAR(16))
RETURNS INT
DETERMINISTIC READS SQL DATA CONTAINS SQL
BEGIN
	DECLARE Ced INT;
	DECLARE Ces INT;
	DECLARE Tot INT;
	SELECT Count(*) INTO Ced
		FROM Cedente JOIN Contratto
		ON Contratto.Codice = Cedente.Contratto
		WHERE Cedente.Cliente = CF AND Contratto.Data_Ratifica IS NOT NULL;
	SELECT Count(*) INTO Ces
		FROM Cessionario JOIN Contratto
		ON Contratto.Codice = Cessionario.Contratto
		WHERE Cessionario.Cliente = CF AND Contratto.Data_Ratifica IS NOT NULL;
	SET Tot=Ced+Ces;
	RETURN Tot;
END|
DELIMITER ;
-- 3. Funzione che dato un dipendente, ne ritorna il ruolo
DROP FUNCTION IF EXISTS RuoloDipendente;
DELIMITER |
CREATE FUNCTION RuoloDipendente(Matr VARCHAR(6))
RETURNS VARCHAR(20)
DETERMINISTIC READS SQL DATA CONTAINS SQL
BEGIN
	DECLARE Ruolo VARCHAR(20);
	DECLARE Num INT(3);
	SELECT Count(*) INTO Num
		FROM Dipendente JOIN Agente
		ON Dipendente.Matricola = Agente.Dipendente
		WHERE Dipendente.Matricola = Matr;
	IF Num > 0 THEN
		SET Ruolo="Agente";
	END IF;
	SELECT Count(*) INTO Num
		FROM Dipendente JOIN Segretario
		ON Dipendente.Matricola = Segretario.Dipendente
		WHERE Dipendente.Matricola = Matr;
	IF Num > 0 THEN
		SET Ruolo="Segretario";
	END IF;
	SELECT Count(*) INTO Num
		FROM Dipendente JOIN Direttore
		ON Dipendente.Matricola = Direttore.Dipendente
		WHERE Dipendente.Matricola = Matr;
	IF Num > 0 THEN
		SET Ruolo="Direttore";
	END IF;
	RETURN Ruolo;
END|
DELIMITER ;

-- 4. Funzione che dato un contratto ed un cliente, ritorna che ruolo ha avuto tale cliente in quel contratto
DROP FUNCTION IF EXISTS RuoloCliente;
DELIMITER |
CREATE FUNCTION RuoloCliente(Id VARCHAR(16), Contr VARCHAR(6))
RETURNS VARCHAR(20)
DETERMINISTIC READS SQL DATA CONTAINS SQL
BEGIN
	DECLARE Ruolo VARCHAR(20);
	DECLARE Num INT;
	SELECT Count(*) INTO Num
		FROM Cliente JOIN Cedente
		ON Cedente.Cliente = Id
		WHERE Cedente.Contratto = Contr;
	IF Num > 0 THEN
		SET Ruolo="Cedente";
	END IF;
	SELECT Count(*) INTO Num
		FROM Cliente JOIN Cessionario
		ON Cessionario.Cliente = Id
		WHERE Cessionario.Contratto = Contr;
	IF Num > 0 THEN
		SET Ruolo="Cessionario";
	END IF;
	RETURN Ruolo;
END|
DELIMITER ;
-- Inserimento Triggers
-- 1. Quando inserisco un nuovo contratto, aggiorna la ridondanza in città
DROP TRIGGER IF EXISTS ConteggioContratti;
DELIMITER |
CREATE TRIGGER ConteggioContratti
AFTER INSERT ON Contratto
FOR EACH ROW
	BEGIN
		UPDATE Citta SET
			Contratti_Proposti = Contratti_Proposti + 1
			WHERE Codice = (
				SELECT DISTINCT Citta
				FROM Abitazione JOIN Contratto
				ON Abitazione.Codice = Contratto.Abitazione
				WHERE Abitazione.Codice = new.Abitazione
			);
	END|
DELIMITER ;
-- 2. All'inserimento di un direttore di una sede, verificare che tale direttore afferisca a tale sede
DROP TRIGGER IF EXISTS VerificaAfferenza;
DELIMITER |
CREATE TRIGGER VerificaAfferenza
BEFORE UPDATE ON Sede
FOR EACH ROW
	BEGIN
		DECLARE NSede INT;
		DECLARE CSede VARCHAR(20);
		SELECT Sede_Afferenza, Citta_Afferenza INTO NSede, CSede
			FROM Dipendente
			WHERE Matricola = new.Direttore;
		IF new.Numero != NSede OR new.Citta != CSede THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Il dipendente scelto non afferisce alla sede di cui si vuole renderlo direttore, update rifiutato";
		END IF;
	END|
DELIMITER ;
-- 3. All'inserimento di un dipendente in un ruolo, dovrebbe controllare che non sia già in altri ruoli (3 in 1)
DROP TRIGGER IF EXISTS VerificaRuoloAgente;
DELIMITER |
CREATE TRIGGER VerificaRuoloAgente
BEFORE INSERT ON Agente
FOR EACH ROW
	BEGIN
		IF RuoloDipendente(new.Dipendente) IS NOT NULL THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Questo Dipendente ha già un ruolo, inserimento fallito";
		END IF;
	END|
DELIMITER ;
DROP TRIGGER IF EXISTS VerificaRuoloSegretario;
DELIMITER |
CREATE TRIGGER VerificaRuoloSegretario
BEFORE INSERT ON Segretario
FOR EACH ROW
	BEGIN
		IF RuoloDipendente(new.Dipendente) IS NOT NULL THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Questo Dipendente ha già un ruolo, inserimento fallito";
		END IF;
	END|
DELIMITER ;
-- Inoltre questo assegna automaticamente il campo direttore alle sedi
DROP TRIGGER IF EXISTS VerificaRuoloDirettore;
DELIMITER |
CREATE TRIGGER VerificaRuoloDirettore
BEFORE INSERT ON Direttore
FOR EACH ROW
	BEGIN
		IF RuoloDipendente(new.Dipendente) IS NOT NULL THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Questo Dipendente ha già un ruolo, inserimento fallito";
		END IF;
	END|
DELIMITER ;
-- 4. Impedisce di inserire un contratto con cedenti e cessionari uguali (o comunque sottoinsiemi di l'un l'altro) (2 in 1)
DROP TRIGGER IF EXISTS VerificaCedentiContratti;
DELIMITER |
CREATE TRIGGER VerificaCedentiContratti
BEFORE INSERT ON Cedente
FOR EACH ROW
	BEGIN
		DECLARE Cnt INT;
		SET Cnt = (SELECT Count(*)
			FROM Cessionario
			WHERE new.Contratto = Cessionario.Contratto AND new.Cliente=Cessionario.Cliente);
		IF Cnt > 0 THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Il record già contenuto nella Tabella Cessionario. Questo comporterebbe che un cliente venda a sè stesso. Inserimento Rifiutato";
		END IF;
	END|
DELIMITER ;
DROP TRIGGER IF EXISTS VerificaCessionariContratti;
DELIMITER |
CREATE TRIGGER VerificaCessionariContratti
BEFORE INSERT ON Cessionario
FOR EACH ROW
	BEGIN
		DECLARE Cnt INT;
		SET Cnt = (SELECT Count(*)
			FROM Cedente
			WHERE new.Contratto = Cedente.Contratto AND new.Cliente=Cedente.Cliente);
		IF Cnt > 0 THEN
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT="Il record già contenuto nella Tabella Cedente. Questo comporterebbe che un cliente venda a sè stesso. Inserimento Rifiutato";
		END IF;
	END|
DELIMITER ;
-- Query
-- 1. (Q) Ritornare Nome, Cognome, I codici di contratto sottoscritti da tutti i clienti, con il ruolo a cui hanno partecipato a tali contratti, ordinati per codice di contratto
-- 2. (Q) Il dipendente del mese (chi ha venduto più case nel mese = contratti completati)
-- 3. (Q) Elenco delle città, con a lato il numero di contratti completati e proposti
-- 4. (Q) Le 3 sedi più oberate (quelle con numero di contratti proposti maggiore) -N.B. Non è Contratti_Proposti di Città!
-- 5. (Q) La top 10 delle città con più contratti proposti (PICCOLA!)
-- 6. (SP/Q) Data una sede, stampa l'elenco dei dipendenti, con relativi ruoli (Fa uso di una funzione)
