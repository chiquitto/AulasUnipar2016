CREATE TABLE `uf` (	`iduf`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,	`uf`	TEXT NOT NULL);CREATE TABLE `cidade` (	`idcidade`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,	`iduf`	INTEGER NOT NULL,	`cidade`	TEXT NOT NULL);INSERT INTO `uf` VALUES	(null, 'PR'),	(null, 'SP'),	(null, 'RJ');INSERT INTO `cidade` VALUES	(null, 1, 'Cianorte'),	(null, 3, 'Rio de Janeiro'),	(null, 2, 'São Paulo'),	(null, 2, 'Santos'),	(null, 1, 'Maringa'),	(null, 2, 'São Caetano'),	(null, 3, 'Flamengo'),	(null, 3, 'Botafogo'),	(null, 1, 'Curitiba');