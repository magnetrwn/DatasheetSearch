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

INSERT INTO utente VALUES
  ('admin', 'admin@noreply.admin.local', '652ac13906f8b32fc1a94d31c0f24df5', 'ba1f2511fc30423bdbb183fe33f3dd0f', DEFAULT);
UPDATE utente SET salt = MD5(UUID());
UPDATE utente SET password_md5_salt = MD5(CONCAT(username, salt));
-- admin:admin

INSERT INTO package(alias) VALUES
('BGA'), ('CAN'), ('CERDIP'), ('CFP'), ('CLCC'),  -- 5
('CPGA'), ('CQFP'), ('DIP'), ('FBGA'), ('FQFP'),  -- 10
('HBGA'), ('HFBGA'), ('HFQFP'), ('HLFQFP'), ('HLQFP'),  -- 15
('HMSOP'), ('HQFP'), ('HSIP'), ('HSOP'), ('HSSOP'),  -- 20
('HTFQFP'), ('HTQFP'), ('HTSSOP'), ('HUSON'), ('HVQFN'),  -- 25
('HWQFN'), ('HWSON'), ('HXQFN'), ('HXSON'), ('LBGA'),  -- 30
('LFBGA'), ('LFQFP'), ('LQFP'), ('LSSOP'), ('MSOP'),  -- 35
('OSON'), ('PLCC'), ('QFP'), ('SC70'), ('SDIP'),  -- 40
('SIP'), ('SOIC'), ('SOT23'), ('SSOP'), ('TFBGA'),  -- 45
('TFLGA'), ('TFQFP'), ('TQFP'), ('TSOP'), ('TSOT'),  -- 50
('TSSOP'), ('UFLGA'), ('UQFN'), ('USON'), ('VFBGA'),  -- 55
('VFLGA'), ('VQFN'), ('VSSOP'), ('WFLGA'), ('WLCSP'),  -- 60
('WQFN'), ('WSON'), ('XFLGA'), ('XSON'), ('ZIP');  -- 65

INSERT INTO azienda(nome, link) VALUES
  ('Intel Corporation', 'https://www.intel.com/'),
  ('Samsung Electronics', 'https://www.samsung.com/us/'),
  ('Taiwan Semiconductor Manufacturing Company', 'https://www.tsmc.com/'),
  ('SK Hynix', 'https://www.skhynix.com/'),
  ('Broadcom', 'https://www.broadcom.com/'),
  ('Texas Instruments', 'https://www.ti.com/'),
  ('Qualcomm', 'https://www.qualcomm.com/'),
  ('Advanced Micro Devices', 'https://www.amd.com/'),
  ('NVIDIA Corporation', 'https://www.nvidia.com/'),
  ('Micron Technology', 'https://www.micron.com/'),
  ('Infineon Technologies', 'https://www.infineon.com/'),
  ('NXP Semiconductors', 'https://www.nxp.com/'),
  ('Renesas Electronics Corporation', 'https://www.renesas.com/'),
  ('Analog Devices', 'https://www.analog.com/'),
  ('ON Semiconductor', 'https://www.onsemi.com/'),
  ('STMicroelectronics', 'https://www.st.com/');

INSERT INTO listino VALUES
  ('LM*58', 'Operational Amplifiers', 'Texas Instruments', CURRENT_DATE());

INSERT INTO componente(alias, descrizione, stato_produzione, fk_listino_famiglia) VALUES
  ('LM358,LM158,LM158A,LM258,LM258A,LM2904,LM2904B,LM2904BA,LM2904V,LM358A,LM358B,LM358BA', 'Industry-Standard Dual Operational Amplifiers', 'In produzione', 'LM*58');

INSERT INTO datasheet(nome, versione, fk_componente_id_componente, data) VALUES
  ('Industry-Standard Dual Operational Amplifiers', 'SLOS068AA March 2022', 1, CURRENT_DATE());

-- INSERT INTO preferiti_d VALUES
--   ('IRFZ44N', 'Infineon 2012', 'admin'),
--   ('IRFZ44ND', 'Samsung v1.0', 'admin'),
--   ('IRFZ44N', 'Vishay 01 Jan 2022', 'admin'),
--   ('IRFZ44ND', 'Samsung v1.0', 'TechGuru1'),
--   ('SN74HCT04', 'TI 08 Jul 2004', 'admin');

-- INSERT INTO preferiti_az VALUES
--   ('STMicroelectronics', 'admin'),
--   ('Infineon Technologies', 'admin'),
--   ('STMicroelectronics', 'TechGuru1'),
--   ('Infineon Technologies', 'TechGuru1'),
--   ('Texas Instruments', 'admin');

-- INSERT INTO preferiti_p VALUES
--   (8, 'admin'), 
--   (8, 'TechGuru1'), 
--   (11, 'admin'), 
--   (24, 'admin'), 
--   (30, 'admin');

INSERT INTO disponibile VALUES
  (1, 8),
  (1, 42),
  (1, 51),
  (1, 58);
