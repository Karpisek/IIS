DROP TABLE Osetrovatel;
DROP TABLE Uklizec;
DROP TABLE Zvire;
DROP TABLE Pomucky;

DROP TABLE Krmeni;
DROP TABLE Krmivo;

DROP TABLE Expo;
DROP TABLE Akvarium;
DROP TABLE Pavilon;
DROP TABLE Vybeh;

DROP TABLE Ex_Osetrovatel;
DROP TABLE Osetrovani;
DROP TABLE Zaskoleni;
DROP TABLE Druh;


--ALTER TABLE Pavilon ADD CONSTRAINT `FK_ExpoPavilon` FOREIGN KEY (`idExpo`) REFERENCES `Expo` ON DELETE CASCADE;

CREATE TABLE login(
  user VARCHAR NOT NULL PRIMARY KEY,
  pass VARCHAR NOT NULL
  );

CREATE TABLE Osetrovatel(
  idOsetrovatel INT NOT NULL AUTO_INCREMENT,
  jmeno VARCHAR(25) NOT NULL,
  prijmeni VARCHAR(25) NOT NULL,
  mail VARCHAR(40) NOT NULL,
  narozeni DATE NOT NULL,
  vzdelani VARCHAR(25) NOT NULL,
  titul VARCHAR(3),
  rodneCislo INT NOT NULL,
  plat INT NOT NULL,
  smlouva DATE NOT NULL,
  PRIMARY KEY (idOsetrovatel)
);

CREATE TABLE Uklizec(
  idUklizec INT NOT NULL AUTO_INCREMENT,
  jmeno VARCHAR(25) NOT NULL,
  prijmeni VARCHAR(25) NOT NULL,
  mail VARCHAR(40) NOT NULL,
  narozeni DATE NOT NULL,
  vzdelani VARCHAR(25) NOT NULL,
  titul VARCHAR(3),
  rodneCislo INT NOT NULL,
  plat INT NOT NULL,
  smlouva DATE NOT NULL,
  PRIMARY KEY (idUklizec)
);

CREATE TABLE Expo(
  idExpo INT NOT NULL AUTO_INCREMENT,
  idUklizec INT NOT NULL,
  PRIMARY KEY (idExpo)
);

CREATE TABLE Zvire(
  idZvire INT NOT NULL AUTO_INCREMENT,
  idExpo INT NOT NULL,
  pohlavi VARCHAR(1) NOT NULL,
  vyskyt VARCHAR(25) NOT NULL,
  narozeni DATE NOT NULL,
  umrti DATE,
  PRIMARY KEY (idZvire)
);

CREATE TABLE Druh(
  idDruh VARCHAR(25) NOT NULL PRIMARY KEY,
  idZvire INT NOT NULL,
  puvod VARCHAR(25) NOT NULL,
  strava VARCHAR(25) NOT NULL
  );



CREATE TABLE Pomucky(
  idPomucky INT NOT NULL AUTO_INCREMENT,
  druh VARCHAR(25) NOT NULL,
  PRIMARY KEY (idPomucky)
);

CREATE TABLE Krmeni(
  idKrmeni INT NOT NULL AUTO_INCREMENT,
  idOsetrovatel INT NOT NULL,
  idZvire INT NOT NULL,
  od TIMESTAMP NOT NULL,
  do TIMESTAMP NOT NULL,
  PRIMARY KEY (idKrmeni)
);

CREATE TABLE Krmivo(
  idKrmiva INT NOT NULL AUTO_INCREMENT,
  idKrmeni INT NOT NULL,
  druh VARCHAR(25) NOT NULL,
  trvanlivost DATE NOT NULL,
  kategorie VARCHAR(25) NOT NULL,
  alergeny INT NOT NULL,
  PRIMARY KEY (idKrmiva)
);


CREATE TABLE Zaskoleni(
  idZaskoleni INT NOT NULL AUTO_INCREMENT,
  idOsetrovatel INT NOT NULL,
  idZvire INT,
  idExpo INT,
  druh VARCHAR(25) NOT NULL,
  vystaveni DATE NOT NULL,
  PRIMARY KEY (idZaskoleni)
);

CREATE TABLE Ex_Osetrovatel(
  idEx_Osetrovatel INT NOT NULL PRIMARY KEY,
  idOsetrovatel INT NOT NULL,
  idExpo INT NOT NULL,
  od DATE NOT NULL,
  do DATE NOT NULL
);


CREATE TABLE Pavilon(
  idExpo INT NOT NULL PRIMARY KEY,
  cas INT NOT NULL,
  rozloha FLOAT
);

CREATE TABLE Vybeh(
  idExpo INT NOT NULL PRIMARY KEY,
  rozloha FLOAT
);

CREATE TABLE Akvarium(
  idExpo INT NOT NULL PRIMARY KEY,
  voda VARCHAR(25),
  rozloha FLOAT,
  teplota FLOAT
);

CREATE TABLE Uklizeni(
 idUklizeni INT NOT NULL AUTO_INCREMENT,
 idUklizec INT NOT NULL,
 idPomucky INT NOT NULL,
 idExpo INT NOT NULL,
 od TIMESTAMP NOT NULL,
 do TIMESTAMP NOT NULL,
 PRIMARY KEY (idUklizeni)
 );


CREATE TABLE Osetrovani(
  idOsetrovani INT NOT NULL AUTO_INCREMENT,
  idOsetrovatel INT NOT NULL,
  idZvire INT NOT NULL,
  stav VARCHAR(20) NOT NULL,
  onemocneni VARCHAR(100) NOT NULL,
  doba TIMESTAMP NOT NULL,
  PRIMARY KEY (idOsetrovani)
);


ALTER TABLE  `xkolar64`.`Krmivo` DROP INDEX  `FK_SPOTREBUJE` ,
ADD INDEX  `FK_SPOTREBUJE` (  `idKrmeni` );

ALTER TABLE  `Krmivo` DROP FOREIGN KEY  `Krmivo_ibfk_1` ;
ALTER TABLE  `Krmivo` ADD FOREIGN KEY (  `idKrmeni` ) REFERENCES  `xkolar64`.`Krmeni` ( `idKrmeni` ) ON DELETE CASCADE ON UPDATE CASCADE ;



ALTER TABLE  `xkolar64`.`Krmeni` DROP INDEX  `FK_PROVADI` ,
ADD INDEX  `FK_PROVADI` (  `idOsetrovatel` );

ALTER TABLE  `xkolar64`.`Krmeni` DROP INDEX  `FK_PROVADI` ,
ADD INDEX  `FK_PROVADI` (  `idOsetrovatel` );

ALTER TABLE  `Krmeni` DROP FOREIGN KEY  `Krmeni_ibfk_3` ;
ALTER TABLE  `Krmeni` ADD FOREIGN KEY (  `idOsetrovatel` ) REFERENCES  `xkolar64`.`Osetrovatel` ( `idOsetrovatel` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `Krmeni` DROP FOREIGN KEY  `Krmeni_ibfk_4` ;
ALTER TABLE  `Krmeni` ADD FOREIGN KEY (  `idZvire` ) REFERENCES  `xkolar64`.`Zvire` ( `idZvire` ) ON DELETE CASCADE ON UPDATE CASCADE ;




ALTER TABLE  `xkolar64`.`Zaskoleni` DROP INDEX  `FK_JeZadano` ,
ADD INDEX  `FK_JeZadano` (  `idExpo` );

ALTER TABLE  `xkolar64`.`Zaskoleni` DROP INDEX  `FK_jeZaskolen` ,
ADD INDEX  `FK_jeZaskolen` (  `idOsetrovatel` );

ALTER TABLE  `xkolar64`.`Zaskoleni` DROP INDEX  `FK_SiZada` ,
ADD INDEX  `FK_SiZada` (  `idZvire` );

ALTER TABLE  `Zaskoleni` DROP FOREIGN KEY  `Zaskoleni_ibfk_2` ;
ALTER TABLE  `Zaskoleni` ADD FOREIGN KEY (  `idOsetrovatel` ) REFERENCES  `xkolar64`.`Osetrovatel` ( `idOsetrovatel` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `Zaskoleni` DROP FOREIGN KEY  `Zaskoleni_ibfk_3` ;
ALTER TABLE  `Zaskoleni` ADD FOREIGN KEY (  `idZvire` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `Zaskoleni` DROP FOREIGN KEY  `Zaskoleni_ibfk_4` ;
ALTER TABLE  `Zaskoleni` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Osetrovatel` ( `idOsetrovatel` ) ON DELETE CASCADE ON UPDATE CASCADE ;




ALTER TABLE  `xkolar64`.`Zvire` ADD INDEX  `FK_OBYVA` (  `idExpo` );

ALTER TABLE  `Zvire` DROP FOREIGN KEY  `Zvire_ibfk_1` ;
ALTER TABLE  `Zvire` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;



ALTER TABLE  `xkolar64`.`Ex_Osetrovatel` ADD INDEX  `FK_VYKLIZI` (  `idOsetrovatel` );
ALTER TABLE  `xkolar64`.`Ex_Osetrovatel` ADD INDEX  `FK_jeVyklizena` (  `idExpo` );

ALTER TABLE  `Ex_Osetrovatel` DROP FOREIGN KEY  `Ex_Osetrovatel_ibfk_2` ;
ALTER TABLE  `Ex_Osetrovatel` DROP FOREIGN KEY  `Ex_Osetrovatel_ibfk_3` ;

ALTER TABLE  `Ex_Osetrovatel` ADD FOREIGN KEY (  `idOsetrovatel` ) REFERENCES  `xkolar64`.`Osetrovatel` ( `idOsetrovatel` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Ex_Osetrovatel` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;



ALTER TABLE  `xkolar64`.`Pomucky` ADD INDEX  `FK_maVypujceno` (  `idOsetrovatel` );
ALTER TABLE  `xkolar64`.`Pomucky` ADD INDEX  `FK_POTREBUJE` (  `idExpo` );


ALTER TABLE  `xkolar64`.`Osetrovani` DROP INDEX  `FK_jeOsetrovano` ,
ADD INDEX  `FK_jeOsetrovano` (  `idZvire` );
ALTER TABLE  `xkolar64`.`Osetrovani` DROP INDEX  `FK_Osetruje` ,
ADD INDEX  `FK_Osetruje` (  `idOsetrovatel` );

ALTER TABLE  `Osetrovani` ADD FOREIGN KEY (  `idOsetrovatel` ) REFERENCES  `xkolar64`.`Osetrovatel` ( `idOsetrovatel` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Osetrovani` ADD FOREIGN KEY (  `idZvire` ) REFERENCES  `xkolar64`.`Zvire` ( `idZvire` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `xkolar64`.`Uklizeni` ADD INDEX  `FK_PouzivaSe` (  `idPomucky` );
ALTER TABLE  `xkolar64`.`Uklizeni` DROP INDEX  `FK_UKLIZI` ,
ADD INDEX  `FK_UKLIZI` (  `idUklizec` );

ALTER TABLE  `xkolar64`.`Uklizeni` DROP INDEX  `FK_uklExpo` ,
ADD INDEX  `FK_uklExpo` (  `idExpo` );

ALTER TABLE  `Uklizeni` ADD FOREIGN KEY (  `idUklizec` ) REFERENCES  `xkolar64`.`Uklizec` ( `idUklizec` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Uklizeni` ADD FOREIGN KEY (  `idPomucky` ) REFERENCES  `xkolar64`.`Pomucky` ( `idPomucky` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Uklizeni` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `xkolar64`.`Druh` ADD INDEX  `FK_DruhZvirete` (  `idZvire` );
ALTER TABLE  `Druh` ADD FOREIGN KEY (  `idZvire` ) REFERENCES  `xkolar64`.`Zvire` ( `idZvire` ) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `xkolar64`.`Expo` ADD INDEX  `FK_UkliziSe` (  `idUklizeni` );
ALTER TABLE  `Expo` ADD FOREIGN KEY (  `idUklizeni` ) REFERENCES  `xkolar64`.`Uklizeni` ( `idUklizeni` ) ON DELETE CASCADE ON UPDATE CASCADE ;





ALTER TABLE  `Pavilon` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Vybeh` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `Akvarium` ADD FOREIGN KEY (  `idExpo` ) REFERENCES  `xkolar64`.`Expo` ( `idExpo` ) ON DELETE CASCADE ON UPDATE CASCADE ;


INSERT INTO `Osetrovatel`(`idOsetrovatel`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10]);


INSERT INTO `xkolar64`.`Osetrovatel` (`idOsetrovatel`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'Filip', 'Novák', 'filip.nov@gmail.com', '1988-04-17', 'VŠ Veterinární', 'Mgr', '880417113', '18000', '2020-12-17'), (NULL, 'Filip', 'Novák', 'michal.pach@centrum.cz', '1989-07-05', 'VŠ Ošetřovatelská', 'Mgr', '890705113', '18000', '2018-01-04');
INSERT INTO `xkolar64`.`Osetrovatel` (`idOsetrovatel`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'Tomáš', 'Šumlianský', 'sumli12@volny.cz', '1978-12-28', 'VŠ Ošetřovatelská', 'Mgr', '781228143', '19000', '2021-01-01');
INSERT INTO `Uklizec`(`idUklizec`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'David', 'Kalanov', 'kala12@seznam.cz', '1977-09-29', 'VŠ Veterinární', 'Mgr', '770929143', '16000', '2019-01-30');
INSERT INTO `Uklizec`(`idUklizec`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'Miroaslav', 'Kuba', 'koub@seznam.cz', '1982-11-11', 'VŠ Veterinární', 'Mgr', '821111325', '16000', '2018-10-01');
INSERT INTO `Uklizec`(`idUklizec`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'Jonáš', 'Tran', 'trana@gmail.com', '1990-09-17', 'VŠ Veterinární', 'Bc', '900917133', '16000', '2018-01-01');
INSERT INTO `Uklizec`(`idUklizec`, `jmeno`, `prijmeni`, `mail`, `narozeni`, `vzdelani`, `titul`, `rodneCislo`, `plat`, `smlouva`) VALUES (NULL, 'Vladimír', 'Volný', 'volnas@centrum.cz', '1995-06-18', 'VŠ Veterinární', 'Bc', '950618', '16000', '2019-01-01');


INSERT INTO  `xkolar64`.`Expo` ( `idExpo` ) VALUES ( '001' );
INSERT INTO  `xkolar64`.`Expo` ( `idExpo` ) VALUES ( '002' );
INSERT INTO  `xkolar64`.`Expo` ( `idExpo` ) VALUES ( '003' );
INSERT INTO  `xkolar64`.`Expo` ( `idExpo` ) VALUES ( '004' );
INSERT INTO  `xkolar64`.`Expo` ( `idExpo` ) VALUES ( '005' );

INSERT INTO `xkolar64`.`Zvire` (`idZvire`, `idExpo`, `pohlavi`, `vyskyt`, `narozeni`, `umrti`) VALUES (NULL, '1', 'M', 'Jižní Amerika', '2008-12-01', NULL), (NULL, '2', 'F', 'Afrika', '2010-03-13', NULL);
INSERT INTO `xkolar64`.`Zvire` (`idZvire`, `idExpo`, `pohlavi`, `vyskyt`, `narozeni`, `umrti`) VALUES ('003', '3', 'M', 'Severní Amerika', '2017-09-29', NULL), ('004', '4', 'F', 'Evropa', '2013-11-04', NULL);


INSERT INTO `xkolar64`.`Pomucky` (`idPomucky`, `druh`) VALUES (NULL, 'lopata'), (NULL, 'kolečka');
INSERT INTO `xkolar64`.`Pomucky` (`idPomucky`, `druh`) VALUES (NULL, 'hrábě'), (NULL, 'igelit');
INSERT INTO `xkolar64`.`Pomucky` (`idPomucky`, `druh`) VALUES (NULL, 'krumpáč');


INSERT INTO `xkolar64`.`Druh` (`idDruh`, `idZvire`, `puvod`, `strava`) VALUES ('psovitá šelma', '1', 'ZOO lešná', 'masožravec');
INSERT INTO `xkolar64`.`Druh` (`idDruh`, `idZvire`, `puvod`, `strava`) VALUES ('buvol', '2', 'rekreace', 'býložravec'), ('puma', '3', 'ZOO Zlín', 'masožravec');
INSERT INTO `xkolar64`.`Druh` (`idDruh`, `idZvire`, `puvod`, `strava`) VALUES ('Rejnok', '4', 'ZOO Tábor', 'masožravec');


INSERT INTO `xkolar64`.`Ex_Osetrovatel` (`idEx_Osetrovatel`, `idOsetrovatel`, `idExpo`, `od`, `do`) VALUES ('1', '1', '1', '2017-12-01', '2017-12-06'), ('2', '2', '2', '2017-11-26', '2017-12-01');
INSERT INTO `xkolar64`.`Ex_Osetrovatel` (`idEx_Osetrovatel`, `idOsetrovatel`, `idExpo`, `od`, `do`) VALUES ('3', '3', '3', '2017-12-18', '2017-12-23'), ('4', '4', '4', '2017-11-30', '2017-12-07');

INSERT INTO `xkolar64`.`Zaskoleni` (`idZaskoleni`, `idOsetrovatel`, `idZvire`, `idExpo`, `druh`, `vystaveni`) VALUES ('1', '4', '4', '4', 'Mořští Živočichové', '2017-12-01'), ('2', '3', '3', '3', 'Kočkovité šelmy', '2017-11-30');


INSERT INTO `xkolar64`.`Krmeni` (`idKrmeni`, `idOsetrovatel`, `idZvire`, `od`, `do`) VALUES (NULL, '1', '1', '2017-11-26 13:30:00', '2017-11-26 14:45:00'), (NULL, '2', '2', '2017-11-26 08:00:00', '2017-11-26 09:00:00');
INSERT INTO `xkolar64`.`Krmeni` (`idKrmeni`, `idOsetrovatel`, `idZvire`, `od`, `do`) VALUES (NULL, '3', '3', '2017-11-26 07:00:00', '2017-11-26 09:00:00'), (NULL, '4', '4', '2017-11-26 06:30:00', '2017-11-26 08:00:00');

INSERT INTO `xkolar64`.`Krmivo` (`idKrmiva`, `idKrmeni`, `druh`, `trvanlivost`, `kategorie`, `alergeny`) VALUES ('1', '1', 'Hovězí směs', '2017-12-08', 'protein', '7'), ('2', '2', 'Seno', '2017-12-30', 'vláknina', '2');
INSERT INTO `xkolar64`.`Krmivo` (`idKrmiva`, `idKrmeni`, `druh`, `trvanlivost`, `kategorie`, `alergeny`) VALUES (NULL, '3', 'Hovězí maso', '2017-12-08', 'protein', '7'), (NULL, '4', 'Rybí maso', '2017-12-08', 'protein', '7');

INSERT INTO `xkolar64`.`Akvarium` (`idExpo`, `voda`, `rozloha`, `teplota`) VALUES ('4', 'mořská', '20m2', '10.5');
INSERT INTO `xkolar64`.`Vybeh` (`idExpo`, `rozloha`) VALUES ('2', '850');
INSERT INTO `xkolar64`.`Pavilon` (`idExpo`, `cas`, `rozloha`) VALUES ('1', '10', '488'), ('3', '10', '500');

INSERT INTO `xkolar64`.`Osetrovani` (`idOsetrovani`, `idOsetrovatel`, `idZvire`, `stav`, `onemocneni`, `do`, `od`) VALUES (NULL, '1', '1', 'zdravý', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), (NULL, '2', '2', 'zdravý', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `xkolar64`.`Osetrovani` (`idOsetrovani`, `idOsetrovatel`, `idZvire`, `stav`, `onemocneni`, `do`, `od`) VALUES (NULL, '3', '3', 'nemocný', 'chlupy v žaludku', '2017-11-25 06:00:00', '2017-11-28 12:00:00'), (NULL, '4', '4', 'zdravý', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

INSERT INTO `xkolar64`.`Uklizeni` (`idUklizeni`, `idUklizec`, `idPomucky`, `od`, `do`, `idExpo`) VALUES (NULL, '1', '2', '2017-11-26 08:30:00', '2017-11-26 16:00:00', '1'), (NULL, '2', '3', '2017-11-26 10:00:00', '2017-11-26 13:00:00', '3');
INSERT INTO `xkolar64`.`Uklizeni` (`idUklizeni`, `idUklizec`, `idPomucky`, `od`, `do`, `idExpo`) VALUES (NULL, '2', '1', '2017-11-26 08:30:00', '2017-11-26 16:00:00', '1'), (NULL, '2', '4', '2017-11-26 10:00:00', '2017-11-26 13:00:00', '3');













