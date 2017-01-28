------ Delete old logins if they exist ------
IF EXISTS
    (SELECT name
     FROM master.sys.server_principals
     WHERE name = 'maria')
BEGIN
	USE [master]
    DROP LOGIN maria;
END

IF EXISTS
    (SELECT name
     FROM master.sys.server_principals
     WHERE name = 'panagiotis')
BEGIN
	USE [master]
    DROP LOGIN panagiotis;
END

IF EXISTS
    (SELECT name
     FROM master.sys.server_principals
     WHERE name = 'sofia')
BEGIN
	USE [master]
    DROP LOGIN sofia;
END

IF EXISTS
    (SELECT name
     FROM master.sys.server_principals
     WHERE name = 'vaya')
BEGIN
	USE [master]
    DROP LOGIN vaya;
END

------ Grant permissions to users ------
USE workofart
GRANT SELECT,INSERT,UPDATE,DELETE ON dbo.favourites TO users;
GRANT SELECT,UPDATE ON dbo.users (email) TO users;


------ Create new logins ------
CREATE LOGIN maria WITH PASSWORD = '1234', DEFAULT_DATABASE=workofart;
USE workofart;
IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = 'maria')
BEGIN
	CREATE USER [maria] FOR LOGIN [maria]
	EXEC sp_addrolemember admin, 'maria';
  EXEC sp_addsrvrolemember 'maria', 'sysadmin';
END;

INSERT INTO users (username,email)
VALUES ('maria','mkotouza@ece.auth.gr')

CREATE LOGIN panagiotis WITH PASSWORD = '1234', DEFAULT_DATABASE=workofart;
USE workofart;
IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = 'panagiotis')
BEGIN
	CREATE USER [panagiotis] FOR LOGIN [panagiotis]
	EXEC sp_addrolemember admin, 'panagiotis';
  EXEC sp_addsrvrolemember 'panagiotis', 'sysadmin';
END;

INSERT INTO users (username,email)
VALUES ('panagiotis','nkpanagi@ece.auth.gr')

CREATE LOGIN sofia WITH PASSWORD = '1234', DEFAULT_DATABASE=workofart;
USE workofart;
IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = 'sofia')
BEGIN
	CREATE USER [sofia] FOR LOGIN [sofia]
	EXEC sp_addrolemember users, 'sofia'
END;

INSERT INTO users (username,email)
VALUES ('sofia','sofisyso@ece.auth.gr')

CREATE LOGIN vaya WITH PASSWORD = '1234', DEFAULT_DATABASE=workofart;
USE workofart;
IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = 'vaya')
BEGIN
	CREATE USER [vaya] FOR LOGIN [vaya]
	EXEC sp_addrolemember users, 'vaya'
END;



------ Insert data ------
USE workofart;

INSERT INTO users (username,email)
VALUES ('vaya','rousvaia@ece.auth.gr')

INSERT INTO favourites
VALUES	('maria', 101)

INSERT INTO favourites
VALUES	('maria', 103)

INSERT INTO favourites
VALUES	('panagiotis', 110)

INSERT INTO favourites
VALUES	('sofia', 102)

INSERT INTO favourites
VALUES	('sofia', 104)

INSERT INTO favourites
VALUES	('vaya', 105)

INSERT INTO favourites
VALUES	('vaya', 108)

/*-----exhibit 11------*/
INSERT INTO city_country
VALUES  (1019, 'Rome', 'Italy');

INSERT INTO city_country
VALUES  (1020, 'Naples', 'Italy');


INSERT INTO location
VALUES  (511, 1019, 'Piazzale del Museo Borghese', 5);


INSERT INTO exhibition
VALUES  (411, 'Galleria Borghese', 1903, 511)

INSERT INTO exhibit
VALUES  (111, 'Apollon and Daphne', 1625, 'The sculpture depicts the climax of the story of Daphne and Phoebus in Ovids Metamorphoses', 305, 411)

 INSERT INTO artist
VALUES  (211, ' Gian Lorenzo Bernini', 1598, 1680, 1020)

INSERT INTO sculpture
VALUES  (111, 243.00)


INSERT INTO sculpture_material
VALUES  (111, 601)

INSERT INTO artist_movement
VALUES  (211, 305)

INSERT INTO exhibit_artist
VALUES  (111, 211)


/*-----exhibit 12------*/
INSERT INTO city_country
VALUES  (1021, 'Madrid', 'Spain');

INSERT INTO city_country
VALUES  (1022, 'Malaga', 'Spain');

INSERT INTO location
VALUES  (512, 1021, 'Calle de Santa Isabel', 52);

INSERT INTO exhibition
VALUES  (412, 'Museo Reina Sofia', 1992, 512);

INSERT INTO exhibit
VALUES  (112, 'Guernica', 1937, 'Guernica shows the tragedies of war and the suffering it inflicts upon individuals, particularly innocent civilians.', 307, 412);

 INSERT INTO artist
VALUES  (212, ' Pablo Picasso', 1881, 1973, 1022);

INSERT INTO artist_movement
VALUES  (212, 307);

INSERT INTO exhibit_artist
VALUES  (112, 212);

INSERT INTO painting
VALUES  (112, 350, 780)

INSERT INTO painting_paint_type
VALUES  (112, 801);


/*-----exhibit 13------*/
INSERT INTO city_country
VALUES  (1023, 'Melbourne', 'Australia');

INSERT INTO city_country
VALUES  (1024, 'Liverpool', 'England');

INSERT INTO location
VALUES  (513, 1023, 'St Kilda Rd',180);

INSERT INTO exhibition
VALUES  (413, 'National Gallery of Victoria', 1861, 513);

INSERT INTO exhibit
VALUES  (113, 'Lion Attacking a Horse', 1765, 'The painting shows a horse attacked by a lion perched on its back.', 311, 413);

 INSERT INTO artist
VALUES  (213, ' George Stubbs', 1724, 1806, 1024);

INSERT INTO artist_movement
VALUES  (213, 311);

INSERT INTO exhibit_artist
VALUES  (113, 213);


INSERT INTO painting
VALUES  (113, 243.8, 332.7)

INSERT INTO painting_paint_type
VALUES  (113, 801);



/*---------exhibit 14---------------*/


INSERT INTO city_country
VALUES  (1025, 'Pieve di Cadore', 'Italy');

INSERT INTO location
VALUES  (514, 1014, 'Piazzale degli Uffizi', 6);

INSERT INTO exhibition
VALUES  (414, 'Uffizi', 1581, 514);

INSERT INTO exhibit
VALUES  (114, 'Venus of Urbino', 1538, 'It depicts a nude young woman, identified with the goddess Venus, reclining on a couch or bed in the sumptuous surroundings of a Renaissance palace.', 301, 414);

 INSERT INTO artist
VALUES  (214, 'Titian', 1488, 1576, 1025);

INSERT INTO artist_movement
VALUES  (214, 301);

INSERT INTO exhibit_artist
VALUES  (114, 214);


INSERT INTO painting
VALUES  (114, 119, 165)

INSERT INTO painting_paint_type
VALUES  (114, 801);

/*-------exhibit 15-----------------*/

INSERT INTO city_country
VALUES  (1026, 'Tokyo', 'Japan');

INSERT INTO art_movement
VALUES  (312, 'Ukiyo-e', 1700, 1900);

INSERT INTO exhibit
VALUES  (115, 'The Great Wave off Kanagawa', 1832, ' It depicts an enormous wave threatening boats off the coast of the prefecture of Kanagawa.', 312, 410);

INSERT INTO artist
VALUES  (215, 'Katsushika Hokusai', 1760, 1849, 1026);

INSERT INTO artist_movement
VALUES  (215, 312);

INSERT INTO exhibit_artist
VALUES  (115, 215);

INSERT INTO print_making
VALUES  (115, 'woodblock');
