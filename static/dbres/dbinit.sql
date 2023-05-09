-- --------------- --
-- CONFIG INIZIALE --
-- --------------- --

SYSTEM echo 'Creazione del database MySQL ds';
DROP DATABASE IF EXISTS ds;
CREATE DATABASE ds;
USE ds;

-- ----------------- --
-- CREAZIONE TABELLE --
-- ----------------- --

-- Tabelle senza chiavi esterne

CREATE TABLE utente (
  username VARCHAR(32) PRIMARY KEY,
  email VARCHAR(128) UNIQUE,
  password_md5_salt CHAR(32),
  salt CHAR(32),
  cambiamenti_da_ultimo_accesso BOOLEAN DEFAULT FALSE
);

CREATE TABLE package (
  id_package BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  alias VARCHAR(512),
  icona VARCHAR(128) DEFAULT 'static/no-logo.png'
);

-- Tabelle con chiavi esterne

-- rinominata da "azienda_produttrice" ad "azienda"
CREATE TABLE azienda (
  nome VARCHAR(128) PRIMARY KEY,
  link VARCHAR(128),
  logo VARCHAR(128) DEFAULT 'static/no-logo.png'
);

CREATE TABLE listino (
  famiglia VARCHAR(128) PRIMARY KEY,
  descrizione VARCHAR(128),
  fk_azienda_nome VARCHAR(128),
  data DATE,
  
  FOREIGN KEY(fk_azienda_nome) REFERENCES azienda(nome)
    ON UPDATE CASCADE
    ON DELETE NO ACTION
);

CREATE TABLE componente (
  id_componente BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  alias VARCHAR(512),
  descrizione VARCHAR(512),
  stato_produzione VARCHAR(32),
  fk_listino_famiglia VARCHAR(128),
  
  FOREIGN KEY(fk_listino_famiglia) REFERENCES listino(famiglia)
    ON UPDATE CASCADE
    ON DELETE SET NULL
);

CREATE TABLE datasheet (
  nome VARCHAR(128),
  versione VARCHAR(32),
  icona VARCHAR(128) DEFAULT 'static/no-logo.png',
  fk_componente_id_componente BIGINT UNSIGNED,
  data DATE,
  
  PRIMARY KEY(nome, versione),
  
  FOREIGN KEY(fk_componente_id_componente) REFERENCES componente(id_componente)
    ON UPDATE CASCADE
    ON DELETE NO ACTION
);

-- Tabelle da associazioni molti a molti

CREATE TABLE preferiti_d (
  fk_datasheet_nome VARCHAR(128),
  fk_datasheet_versione VARCHAR(32),
  fk_utente_username VARCHAR(32),
  
  PRIMARY KEY(fk_datasheet_nome, fk_datasheet_versione, fk_utente_username),
  
  FOREIGN KEY(fk_datasheet_nome, fk_datasheet_versione) REFERENCES datasheet(nome, versione)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY(fk_utente_username) REFERENCES utente(username)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE preferiti_az (
  fk_azienda_nome VARCHAR(128),
  fk_utente_username VARCHAR(32),
  
  PRIMARY KEY(fk_azienda_nome, fk_utente_username),
  
  FOREIGN KEY(fk_azienda_nome) REFERENCES azienda(nome)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY(fk_utente_username) REFERENCES utente(username)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE preferiti_p (
  fk_package_id_package BIGINT UNSIGNED,
  fk_utente_username VARCHAR(32),
  
  PRIMARY KEY(fk_package_id_package, fk_utente_username),
  
  FOREIGN KEY(fk_package_id_package) REFERENCES package(id_package)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY(fk_utente_username) REFERENCES utente(username)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE disponibile (
  fk_componente_id_componente BIGINT UNSIGNED,
  fk_package_id_package BIGINT UNSIGNED,
  
  PRIMARY KEY(fk_componente_id_componente, fk_package_id_package),
  
  FOREIGN KEY(fk_componente_id_componente) REFERENCES componente(id_componente)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY(fk_package_id_package) REFERENCES package(id_package)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

-- ----------------- --
-- INSERIMENTO TUPLE --
-- ----------------- --

INSERT INTO utente(username, email) VALUES
  ('admin', 'admin@noreply.admin.local'),
  ('TechGuru1', 'techguru@gmail.com'),
  ('garden-lover1', 'gardenlover@gmail.com'),
  ('B00KW0RM', 'bookworm@gmail.com'),
  ('raja-ramos', 'rajaramos@google.ca'),
  ('SerinaHodges', 'serinahodges3652@outlook.com'),
  ('ronanlowery', 'ronanlowery@yahoo.com'),
  ('owen87', 'owenhoward8710@outlook.ca'),
  ('amurray', 'alimurray@outlook.org'),
  ('fITNESSfAN', 'fitnessfan@gmail.com'),
  ('trvlbg', 'travelbug@gmail.com'),
  ('foooooodie', 'foodie@gmail.com'),
  ('FilmFanatic', 'filmfanatic@gmail.com'),
  ('hiking-enthusiast', 'hikingenthusiast@gmail.com'),
  ('MUSICALMAVEN1', 'musicalmaven@gmail.com');

UPDATE utente SET salt = MD5(UUID());
UPDATE utente SET password_md5_salt = MD5(CONCAT(username, salt));
-- Per ora le password sono i loro username
SYSTEM echo 'Warning: Default users have their passwords set to username.';

INSERT INTO package(alias) VALUES
  ('BGA'), ('CAN'), ('CERDIP'), ('CFP'), ('CLCC'), ('CPGA'), ('CQFP'), ('DIP'),
  ('FBGA'), ('FQFP'),  ('HBGA'), ('HFBGA'), ('HFQFP'),  ('HLFQFP'), ('HLQFP'),
  ('HMSOP'), ('HQFP'),  ('HSIP'), ('HSOP'), ('HSSOP'), ('HTFQFP'), ('HTQFP'),
  ('HTSSOP'), ('HUSON'), ('HVQFN'), ('HWQFN'), ('HWSON'), ('HXQFN'), ('HXSON'),
  ('LBGA'), ('LFBGA'), ('LFQFP'), ('LQFP'),  ('LSSOP'), ('MSOP'), ('OSON'),
  ('PLCC'), ('QFP'),  ('SC70'), ('SDIP'), ('SIP'), ('SOP'), ('SOT23'),
  ('SSOP'), ('TFBGA'), ('TFLGA'), ('TFQFP'), ('TQFP'),  ('TSOP'), ('TSOT'),
  ('TSSOP'), ('UFLGA'), ('UQFN'), ('USON'), ('VFBGA'), ('VFLGA'), ('VQFN'),
  ('WFLGA'), ('WLCSP'), ('WQFN'), ('WSON'), ('XFLGA'), ('XSON'), ('ZIP');

INSERT INTO azienda(nome, link) VALUES
  ('STMicroelectronics', 'http://google.com'),
  ('ON Semiconductor', 'http://whatsapp.com'),
  ('Diodes Incorporated', 'https://wikipedia.org'),
  ('Texas Instruments', 'http://walmart.com'),
  ('Infineon Technologies', 'https://guardian.co.uk'),
  ('Acme Inc.', 'https://www.acme.com'),
  ('Global Industries', 'https://www.globalindustries.com'),
  ('Jupiter Corporation', 'https://www.jupitercorp.com'),
  ('Nebula Enterprises', 'https://www.nebulaent.com'),
  ('Cosmic Innovations', 'https://www.cosmicinnovations.com'),
  ('Galactic Ventures', 'https://www.galacticventures.net'),
  ('Stellar Solutions', 'https://www.stellarsolutions.com'),
  ('Orion Enterprises', 'https://www.orionent.com'),
  ('Nova Corporation', 'https://www.novacorp.net'),
  ('Saturn Systems', 'https://www.saturnsystems.com');

INSERT INTO listino VALUES
  ('SN*4LS', '74 Low-power Schottky logic family', 'Texas Instruments', CURRENT_DATE()),
  ('IR** MOSFET', 'High Current Power MOSFETs', 'Infineon Technologies', CURRENT_DATE()),
  ('MC78***', '1.0A Positive Voltage Regulators', 'ON Semiconductor', CURRENT_DATE()),
  ('LM358', 'Low Power Dual Operational Amplifiers', 'Diodes Incorporated', CURRENT_DATE()),
  ('SN*4HCT', '74 High-speed CMOS with TTL-compatible input thresholds', 'Texas Instruments', CURRENT_DATE());

INSERT INTO componente(alias, descrizione, stato_produzione, fk_listino_famiglia) VALUES
  ('LM358', 'LOW POWER DUAL OPERATIONAL AMPLIFIER', 'In produzione', 'LM358'),
  ('IRFZ24N', '55V Single N-Channel Power MOSFET in a TO-220 package', 'In produzione', 'IR** MOSFET'),
  ('IRFZ34N', '55V Single N-Channel Power MOSFET in a TO-220 package', 'In produzione', 'IR** MOSFET'),
  ('IRFZ44N', 'N-channel enhancement mode standard level field-effect power transistor in a plastic envelope using "trench" technology. The device features very low on-state resistance and has integral zener diodes giving ESD protection up to 2kV. It is intended for use in switched mode power supplies and general purpose switching applications.', 'In produzione', 'IR** MOSFET'),
  ('SN74HCT04', '6-ch, 4.5-V to 5.5-V inverters with TTL-compatible CMOS inputs', 'In produzione', 'SN*4HCT');

INSERT INTO datasheet(nome, versione, fk_componente_id_componente, data) VALUES
  ('SN74HCT04', 'TI 08 Jul 2004', 5, CURRENT_DATE()),
  ('IRFZ44N', 'Vishay 01 Jan 2022', 4, CURRENT_DATE()),
  ('IRFZ44ND', 'Samsung v1.2', 4, CURRENT_DATE()),
  ('IRFZ44ND', 'Samsung v1.0', 4, CURRENT_DATE()),
  ('IRFZ44N', 'Infineon 2012', 4, CURRENT_DATE());

INSERT INTO preferiti_d VALUES
  ('IRFZ44N', 'Infineon 2012', 'admin'),
  ('IRFZ44ND', 'Samsung v1.0', 'admin'),
  ('IRFZ44N', 'Vishay 01 Jan 2022', 'admin'),
  ('IRFZ44ND', 'Samsung v1.0', 'TechGuru1'),
  ('SN74HCT04', 'TI 08 Jul 2004', 'admin');

INSERT INTO preferiti_az VALUES
  ('STMicroelectronics', 'admin'),
  ('Infineon Technologies', 'admin'),
  ('STMicroelectronics', 'TechGuru1'),
  ('Infineon Technologies', 'TechGuru1'),
  ('Texas Instruments', 'admin');

INSERT INTO preferiti_p VALUES
  (8, 'admin'), 
  (8, 'TechGuru1'), 
  (11, 'admin'), 
  (24, 'admin'), 
  (30, 'admin');

INSERT INTO disponibile VALUES
  (1, 8),
  (5, 8),
  (2, 5),
  (2, 20),
  (2, 21),
  (4, 21);

SYSTEM echo 'Info: Done.';