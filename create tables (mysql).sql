-- pobocka
create table pobocka (
    pobockaID integer NOT NULL AUTO_INCREMENT,
    nazev varchar(100) NOT NULL,
    adresa varchar(400) NOT NULL,
    CONSTRAINT pobocka_pk PRIMARY KEY (pobockaID)
) ENGINE=InnoDB CHARSET=utf8;


-- REZERVACE
create table rezervace (
    rezervaceID integer NOT NULL AUTO_INCREMENT,
    jmenoZakaznika varchar(200) NOT NULL,
    datumExpirace datetime NOT NULL,
    vyzvednuto TINYINT NOT NULL,
    CONSTRAINT rezervace_pk PRIMARY KEY (rezervaceID)
) ENGINE=InnoDB CHARSET=utf8;



-- Cizi klice
alter table rezervace add pobockaID integer not null;

ALTER TABLE rezervace
ADD CONSTRAINT rezervace_fk1
  FOREIGN KEY (pobockaID)
  REFERENCES pobocka(pobockaID);

alter table rezervace add lekarnikID integer not null;


-- lekarnik
create table lekarnik (
 lekarnikID integer NOT NULL AUTO_INCREMENT,
 jmeno varchar(100) NOT NULL,
 prijmeni varchar(100) NOT NULL,
 adresa varchar(400),
 datumNarozeni datetime NOT NULL,
 rodneCislo BIGINT NOT NULL,
 stavPracovnbihoPomeru TINYINT NOT NULL,
 CONSTRAINT lekarnik_pk PRIMARY KEY (lekarnikID)
) ENGINE=InnoDB CHARSET=utf8;


ALTER TABLE rezervace
ADD CONSTRAINT rezervace_fk2
  FOREIGN KEY (lekarnikID)
  REFERENCES lekarnik(lekarnikID);


-- Cizi klice
alter table lekarnik add pobockaID integer not null;

ALTER TABLE lekarnik
ADD CONSTRAINT lekarnik_fk1
  FOREIGN KEY (pobockaID)
  REFERENCES pobocka(pobockaID);


-- lek
create table lek (
 lekID integer NOT NULL AUTO_INCREMENT,
 carovyKod BIGINT NOT NULL,
 nazev varchar(100) NOT NULL,
 cena decimal(38) NOT NULL,
 datumExpirace datetime,
 napredpis tinyint NOT NULL,
 CONSTRAINT lek_pk PRIMARY KEY (lekID)
) ENGINE=InnoDB CHARSET=utf8;




-- uskladneni
create table uskladnen (
    mnozstvi integer not null,
    pobockaID integer not null,
    lekID integer not null
) ENGINE=InnoDB CHARSET=utf8;


-- cizi klice
ALTER TABLE uskladnen
ADD CONSTRAINT uskladnen_fk1
  FOREIGN KEY (pobockaID)
  REFERENCES pobocka(pobockaID);

ALTER TABLE uskladnen
ADD CONSTRAINT uskladnen_fk2
  FOREIGN KEY (lekID)
  REFERENCES lek(lekID);


-- prodej
create table prodej (
 prodejID integer NOT NULL AUTO_INCREMENT,
 datum datetime NOT NULL,
 CONSTRAINT prodej_pk PRIMARY KEY (prodejID)
) ENGINE=InnoDB CHARSET=utf8;




-- Cizi klice
alter table prodej add pobockaID integer not null;

ALTER TABLE prodej
ADD CONSTRAINT prodej_fk1
  FOREIGN KEY (pobockaID)
  REFERENCES pobocka(pobockaID);

alter table prodej add lekarnikID integer not null;

ALTER TABLE prodej
ADD CONSTRAINT prodej_fk2
  FOREIGN KEY (lekarnikID)
  REFERENCES lekarnik(lekarnikID);


-- seznam polozek
create table seznamPolozek (
    cena decimal(38) not null,
    mnozstvi integer not null,
    prodejID integer not null,
    lekID integer not null
) ENGINE=InnoDB CHARSET=utf8;


-- cizi klice
ALTER TABLE seznamPolozek
ADD CONSTRAINT seznamPolozek_fk1
  FOREIGN KEY (prodejID)
  REFERENCES prodej(prodejID);

ALTER TABLE seznamPolozek
ADD CONSTRAINT seznamPolozek_fk2
  FOREIGN KEY (lekID)
  REFERENCES lek(lekID);


-- Pojistovana
create table pojistovna (
    pojistovnaID integer not null AUTO_INCREMENT,
    cisloPojistovny integer not null,
    ICO integer not null,
    nazev varchar(100) not null,
    adresa varchar(400) NOT NULL,
 CONSTRAINT pojistovna_pk PRIMARY KEY (pojistovnaID)
) ENGINE=InnoDB CHARSET=utf8;




-- doplatek
create table doplatek (
    doplatekID integer not null AUTO_INCREMENT,
    cena decimal(38) not null,
 CONSTRAINT doplatek_pk PRIMARY KEY (doplatekID)
) ENGINE=InnoDB CHARSET=utf8;





-- cizi klice
alter table doplatek add pojistovnaID integer not null;

ALTER TABLE doplatek
ADD CONSTRAINT doplatek_fk1
  FOREIGN KEY (pojistovnaID)
  REFERENCES pojistovna(pojistovnaID);

alter table doplatek add lekID integer not null;

ALTER TABLE doplatek
ADD CONSTRAINT doplatek_fk2
  FOREIGN KEY (lekID)
  REFERENCES lek(lekID);


-- dodavatel
create table dodavatel (
 dodavatelID integer NOT NULL AUTO_INCREMENT,
 ICO integer NOT NULL,
 nazev varchar(100) NOT NULL,
 adresa varchar(400),
 CONSTRAINT dodavatel PRIMARY KEY (dodavatelID)
) ENGINE=InnoDB CHARSET=utf8;




-- sortiment
create table sortiment (
    cena decimal(38) not null,
    dodavatelID integer not null,
    lekID integer not null
) ENGINE=InnoDB CHARSET=utf8;


-- cizi klice
ALTER TABLE sortiment
ADD CONSTRAINT sortiment_fk
  FOREIGN KEY (dodavatelID)
  REFERENCES dodavatel(dodavatelID);

ALTER TABLE sortiment
ADD CONSTRAINT sortiment_fk2
  FOREIGN KEY (lekID)
  REFERENCES lek(lekID);


-- PREDPIS
create table predpis (
 predpisID integer NOT NULL AUTO_INCREMENT,
 cisloPredpisu integer NOT NULL,
 jmenoZakaznika varchar(100) NOT NULL,
 prijmeniZakaznika varchar(100) NOT NULL,
 rodneCisloZakaznika bigint NOT NULL,
 CONSTRAINT predpis_pk PRIMARY KEY (predpisID)
) ENGINE=InnoDB CHARSET=utf8;




-- cizi klice
alter table predpis add prodejID integer not null;

ALTER TABLE predpis
ADD CONSTRAINT predpis_fk1
  FOREIGN KEY (prodejID)
  REFERENCES prodej(prodejID);

alter table predpis add pojistovnaID integer not null;

ALTER TABLE predpis
ADD CONSTRAINT predpis_fk2
  FOREIGN KEY (pojistovnaID)
  REFERENCES pojistovna(pojistovnaID);


-- predpis na lek
create table predpisNa (
 lekID integer not null,
 predpisID integer not null,
 mnozstvi integer not null
) ENGINE=InnoDB CHARSET=utf8;

ALTER TABLE predpisNa
ADD CONSTRAINT predpisNa_fk1
 FOREIGN KEY (predpisID)
 REFERENCES predpis(predpisID);

ALTER TABLE predpisNa
ADD CONSTRAINT predpisNa_fk3
 FOREIGN KEY (lekID)
 REFERENCES lek(lekID);


-- obsahuje
create table obsahuje (
 lekID integer not null,
 rezervaceID integer not null,
 mnozstvi integer not null
) ENGINE=InnoDB CHARSET=utf8;

ALTER TABLE obsahuje
ADD CONSTRAINT obsahuje_fk1
 FOREIGN KEY (rezervaceID)
 REFERENCES rezervace(rezervaceID);

ALTER TABLE obsahuje
ADD CONSTRAINT obsahuje_fk3
 FOREIGN KEY (lekID)
 REFERENCES lek(lekID);


-- objednavka
create table objednavka (
 objednavkaID integer NOT NULL AUTO_INCREMENT,
 datupObjednani datetime not null,
 datupDoruceni datetime not null,
 CONSTRAINT objednavka_pk PRIMARY KEY (objednavkaID)
) ENGINE=InnoDB CHARSET=utf8;


-- cizi klice
alter table objednavka add dodavatelID integer not null;

ALTER TABLE objednavka
ADD CONSTRAINT objednavka_fk1
  FOREIGN KEY (dodavatelID)
  REFERENCES dodavatel(dodavatelID);

alter table objednavka add pobockaID integer not null;

ALTER TABLE objednavka
ADD CONSTRAINT objednavka_fk2
  FOREIGN KEY (pobockaID)
  REFERENCES pobocka(pobockaID);

-- obsahuje
create table objednavkaobsahuje (
 lekID integer not null,
 objednavkaID integer not null,
 mnozstvi integer not null,
 cena decimal(38) not null
) ENGINE=InnoDB CHARSET=utf8;

ALTER TABLE objednavkaobsahuje
ADD CONSTRAINT objednavkaobsahuje_fk1
 FOREIGN KEY (objednavkaID)
 REFERENCES objednavka(objednavkaID);

ALTER TABLE objednavkaobsahuje
ADD CONSTRAINT objednavkaobsahuje_fk2
 FOREIGN KEY (lekID)
 REFERENCES lek(lekID);

-- VLOZENI TESTOVACICH DAT

-- pobocka
/* SET DEFINE OFF; */
Insert into pobocka
   (pobockaID, NAZEV, ADRESA)
 Values
   (1, 'Masarykova', 'Sámoa 4, Brno');
Insert into pobocka
   (pobockaID, NAZEV, ADRESA)
 Values
   (2, 'Loupan', 'Loupanová 5, Ostrava');
 Insert into pobocka
   (pobockaID, NAZEV, ADRESA)
 Values
   (3, 'Masarova', 'Masarova 12, Praha');


-- dodavatel
/* SET DEFINE OFF; */
Insert into dodavatel
   (dodavatelID, ICO, NAZEV, ADRESA)
 Values
   (21, 25110161, 'Kaufland Česká republika v.o.s.', 'Praha - Břevnov, Bělohorská 2428/203, PSČ 169 00');
Insert into dodavatel
   (dodavatelID, ICO, NAZEV, ADRESA)
 Values
   (22, 05051380, 'Dr. Max Pharma s.r.o.', 'Praha - Nové Město, Na Florenci 2116/15, PSČ 110 00');
 Insert into dodavatel
   (dodavatelID, ICO, NAZEV, ADRESA)
 Values
   (23, 49240030, 'Zentiva', 'U kabelovny 130/22, Dolní Měcholupy, 102 00 Praha');


-- pojistovna
/* SET DEFINE OFF; */
Insert into pojistovna
   (pojistovnaID, CISLOPOJISTOVNY, ICO, NAZEV, ADRESA)
 Values
   (1, 211, 45272956, 'Ministerstva vnitra', 'Kola 4, Praha 6');
Insert into pojistovna
   (pojistovnaID, CISLOPOJISTOVNY, ICO, NAZEV, ADRESA)
 Values
   (2, 212, 47116617, 'Vojenská', 'Dudákova 7, Brno');
 Insert into pojistovna
   (pojistovnaID, CISLOPOJISTOVNY, ICO, NAZEV, ADRESA)
 Values
   (3, 215, 49240480, 'Alianz', 'Kolařská 24, Jihlava');


-- lek
/* SET DEFINE OFF; */
Insert into lek
   (lekID, CAROVYKOD, NAZEV, CENA, DATUMEXPIRACE, 
    NAPREDPIS)
 Values
   (21, 1232123423, 'Paralen', 120, STR_TO_DATE('16/03/2017', '%d/%m/%Y'), 
    1);
Insert into lek
   (lekID, CAROVYKOD, NAZEV, CENA, DATUMEXPIRACE, 
    NAPREDPIS)
 Values
   (22, 155134532, 'Aspirin', 300, STR_TO_DATE('06/04/2017', '%d/%m/%Y'), 
    0);
Insert into lek
   (lekID, CAROVYKOD, NAZEV, CENA, DATUMEXPIRACE, 
    NAPREDPIS)
 Values
   (23, 13123132, 'Zirtek', 130, STR_TO_DATE('06/04/2017', '%d/%m/%Y'), 
    0);
Insert into lek
   (lekID, CAROVYKOD, NAZEV, CENA, DATUMEXPIRACE, 
    NAPREDPIS)
 Values
   (24, 131321315, 'B-complex', 100, STR_TO_DATE('08/06/2017', '%d/%m/%Y'), 
    0);


-- doplatek
/* SET DEFINE OFF; */
Insert into doplatek
   (doplatekID, CENA, pojistovnaID, lekID)
 Values
   (21, 60, 1, 21);
Insert into doplatek
   (doplatekID, CENA, pojistovnaID, lekID)
 Values
   (22, 30, 2, 21);
Insert into doplatek
   (doplatekID, CENA, pojistovnaID, lekID)
 Values
   (23, 15, 1, 22);
 Insert into doplatek
   (doplatekID, CENA, pojistovnaID, lekID)
 Values
   (24, 45, 2, 23);



-- lekarnik
/* SET DEFINE OFF; */
Insert into lekarnik
   (lekarnikID, JMENO, PRIJMENI, ADRESA, DATUMNAROZENI, 
    RODNECISLO, STAVPRACOVNBIHOPOMERU, pobockaID)
 Values
   (1, 'Alfred', 'Nobel', 'Janovská 5, Brno', STR_TO_DATE('26/03/1897', '%d/%m/%Y'), 
    9501190523, 1, 1);
Insert into lekarnik
   (lekarnikID, JMENO, PRIJMENI, ADRESA, DATUMNAROZENI, 
    RODNECISLO, STAVPRACOVNBIHOPOMERU, pobockaID)
 Values
   (2, 'Jan ', 'Novák', 'Femova 5, Praha 6', STR_TO_DATE('15/03/1990', '%d/%m/%Y'), 
    9761110986, 1, 2);
 Insert into lekarnik
   (lekarnikID, JMENO, PRIJMENI, ADRESA, DATUMNAROZENI, 
    RODNECISLO, STAVPRACOVNBIHOPOMERU, pobockaID)
 Values
   (3, 'Martin ', 'Náhlovský', 'Holešova 42, Zlín', STR_TO_DATE('25/02/1996', '%d/%m/%Y'), 
    8906207277, 1, 1);
 Insert into lekarnik
   (lekarnikID, JMENO, PRIJMENI, ADRESA, DATUMNAROZENI, 
    RODNECISLO, STAVPRACOVNBIHOPOMERU, pobockaID)
 Values
   (4, 'Tomáš ', 'Rychtecký', 'Bezinkova 12, Jihlava', STR_TO_DATE('15/07/1986', '%d/%m/%Y'), 
    9162064615, 0, 2);


-- objednavka
/* SET DEFINE OFF; */
Insert into objednavka
   (objednavkaID, DATUPOBJEDNANI, DATUPDORUCENI, dodavatelID, pobockaID)
 Values
   (1, STR_TO_DATE('17/03/2017', '%d/%m/%Y'), STR_TO_DATE('15/04/2017', '%d/%m/%Y'), 22, 1);
Insert into objednavka
   (objednavkaID, DATUPOBJEDNANI, DATUPDORUCENI, dodavatelID, pobockaID)
 Values
   (2, STR_TO_DATE('01/04/2017', '%d/%m/%Y'), STR_TO_DATE('18/04/2017', '%d/%m/%Y'), 23, 3);


-- objednavkaobsahuje
/* SET DEFINE OFF; */
Insert into objednavkaObsahuje
   (lekID, objednavkaID, MNOZSTVI, CENA)
 Values
   (22, 1, 304, 120);
Insert into objednavkaObsahuje
   (lekID, objednavkaID, MNOZSTVI, CENA)
 Values
   (21, 1, 39, 340);
Insert into objednavkaObsahuje
   (lekID, objednavkaID, MNOZSTVI, CENA)
 Values
   (24, 2, 50, 100);


-- prodej
/* SET DEFINE OFF; */
Insert into prodej
   (prodejID, DATUM, pobockaID, lekarnikID)
 Values
   (1, STR_TO_DATE('09/03/2017', '%d/%m/%Y'), 2, 2);
Insert into prodej
   (prodejID, DATUM, pobockaID, lekarnikID)
 Values
   (2, STR_TO_DATE('01/04/2017', '%d/%m/%Y'), 1, 3);

-- rezervace
/* SET DEFINE OFF; */
Insert into rezervace
   (REZERVACEID, JMENOZAKAZNIKA, DATUMEXPIRACE, VYZVEDNUTO, pobockaID, 
    lekarnikID)
 Values
   (1, 'Franta Popelka', STR_TO_DATE('09/04/2017', '%d/%m/%Y'), 0, 1, 
    1);


-- predpis
/* SET DEFINE OFF; */
Insert into predpis
   (PREDPISID, CISLOPREDPISU, JMENOZAKAZNIKA, PRIJMENIZAKAZNIKA, RODNECISLOZAKAZNIKA, 
    prodejID, pojistovnaID)
 Values
   (1, 329092, 'Lenka', 'Váňová', 9761110986, 
    1, 2);


-- predpisNa
/* SET DEFINE OFF; */
Insert into predpisna
   (lekID, PREDPISID, MNOZSTVI)
 Values
   (21, 1, 7);


-- obsahuje
/* SET DEFINE OFF; */
Insert into obsahuje
   (lekID, REZERVACEID, MNOZSTVI)
 Values
   (22, 1, 7);
Insert into obsahuje
   (lekID, REZERVACEID, MNOZSTVI)
 Values
   (21, 1, 1);


-- sortiment
/* SET DEFINE OFF; */
Insert into sortiment
   (CENA, dodavatelID, lekID)
 Values
   (200, 21, 21);
Insert into sortiment
   (CENA, dodavatelID, lekID)
 Values
   (120, 22, 21);
Insert into sortiment
   (CENA, dodavatelID, lekID)
 Values
   (300, 22, 22);
Insert into sortiment
   (CENA, dodavatelID, lekID)
 Values
   (100, 23, 24);


-- seznamPolozek
/* SET DEFINE OFF; */
Insert into seznampolozek
   (CENA, MNOZSTVI, prodejID, lekID)
 Values
   (120, 7, 1, 21);
Insert into seznampolozek
   (CENA, MNOZSTVI, prodejID, lekID)
 Values
   (300, 1, 1, 22);


-- 
/* SET DEFINE OFF; */
Insert into uskladnen
   (MNOZSTVI, pobockaID, lekID)
 Values
   (346, 1, 21);
Insert into uskladnen
   (MNOZSTVI, pobockaID, lekID)
 Values
   (12, 1, 22);
Insert into uskladnen
   (MNOZSTVI, pobockaID, lekID)
 Values
   (23, 2, 23);

ALTER TABLE uskladnen ADD uskladnenID INT PRIMARY KEY AUTO_INCREMENT;
ALTER TABLE sortiment ADD sortimentID INT PRIMARY KEY AUTO_INCREMENT;
ALTER TABLE seznampolozek ADD seznampolozekID INT PRIMARY KEY AUTO_INCREMENT;
ALTER TABLE predpisna ADD predpisnaID INT PRIMARY KEY AUTO_INCREMENT;
ALTER TABLE obsahuje ADD obsahujeID INT PRIMARY KEY AUTO_INCREMENT;
ALTER TABLE objednavkaobsahuje ADD objednavkaobsahujeID INT PRIMARY KEY AUTO_INCREMENT;

COMMIT;


create table uzivatel (
    uzivatelID integer NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(400) NOT NULL,
    roleID integer NOT NULL,
    lekarnikID integer NOT NULL,
    CONSTRAINT uzivatel_pk PRIMARY KEY (uzivatelID)
) ENGINE=InnoDB CHARSET=utf8;

create table role (
    roleID integer NOT NULL AUTO_INCREMENT,
    definice varchar(400) NOT NULL,
    jmeno varchar(400) NOT NULL,
    CONSTRAINT role_pk PRIMARY KEY (roleID)
) ENGINE=InnoDB CHARSET=utf8;



insert into role (roleID, definice, jmeno) values (1, 'Administrator', 'admin');
insert into role (roleID, definice, jmeno) values (2, 'Lekarnik', 'lekarnik');


insert into uzivatel (uzivatelID, username, password, roleID, lekarnikID) 
  values 
  (1, 'admin', '$2a$04$Rq9RBaCs0oLwxTlh2JeGj.H8BaeEbvIeOrc51A117gcNsyDOPEtwa', 1, 1);



insert into uzivatel (uzivatelID, username, password, roleID, lekarnikID) 
  values 
  (2, 'user', '$2a$04$Rq9RBaCs0oLwxTlh2JeGj.H8BaeEbvIeOrc51A117gcNsyDOPEtwa', 2, 2);