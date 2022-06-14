PRAGMA foreign_keys = on;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS FavouriteRestaurant;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS FavouriteDish;
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS OrderDish;

-- Create tables

-- Table: User
CREATE TABLE User (
  id            INTEGER PRIMARY KEY,
  isOwner     BOOLEAN,
  username		STRING UNIQUE NOT NULL,
  password	    STRING NOT NULL check(length(password) >= 8),
  address        STRING,
  phoneNumber   INTEGER NOT NULL check(length(phoneNumber) == 9)
);

-- Table: Category
CREATE TABLE Category (
  id        INTEGER PRIMARY KEY,
  name  		STRING
);

-- Table: Restaurant
CREATE TABLE Restaurant (
  id            INTEGER PRIMARY KEY,
  name  		    STRING,
  address        STRING,
  id_Owner      INTEGER References User(id),
  id_Category   INTEGER References Category(id)
);

-- Table: FavouriteRestaurant
CREATE TABLE FavouriteRestaurant (
  id_user           INTEGER References User(id),
  id_restaurant     INTEGER References Restaurant(id),
  PRIMARY KEY(id_user, id_restaurant)
);

-- Table: Review
CREATE TABLE Review (
  id                INTEGER PRIMARY KEY,
  classification  	INTEGER CHECK(classification > 0 AND classification <= 5),
  comment           STRING,
  answer            STRING,
  id_writer         INTEGER References User(id),
  id_restaurant     INTEGER References Restaurant(id)
);

-- Table: Dish
CREATE TABLE Dish (
  id                INTEGER PRIMARY KEY,
  name  	          STRING,
  price             FLOAT,
  id_category       INTEGER References Category(id),
  id_restaurant     INTEGER References Restaurant(id)
);

-- Table: FavouriteDish
CREATE TABLE FavouriteDish (
  id_user           INTEGER References User(id),
  id_dish            INTEGER References Dish(id),
  PRIMARY KEY(id_user,id_dish)
);

-- Table: Orders
CREATE TABLE Orders (
  id                INTEGER PRIMARY KEY,
  state             STRING CHECK(state == 'ready' OR state == 'preparing' OR state == 'received' OR state == 'delivered'),
  date              Date,
  id_restaurant     INTEGER References Restaurant(id),
  id_user           INTEGER References User(id)
);

-- Table: OrderDish
CREATE TABLE OrderDish (
  id_order           INTEGER References Orders(id),
  id_dish            INTEGER References Dish(id),
  PRIMARY KEY(id_order,id_dish)
);


--Populate tables

INSERT INTO "User" VALUES(0,1,"admin","$2y$12$13I6XfLEA.cjA7apPdaOSOVAXlgXbK.fvUlUFpRq9NDNZk9Jzl1HK","Avenida dos Aliados",913459281);
INSERT INTO "User" VALUES(1,1,"sraloladinha","$2y$12$APo31FX3lrhYUiM6LSJB8eHv7Nhsj3qR6dqzjcrDeYVxBLlEWLrvS","Rua da Consituição",913459282);
INSERT INTO "User" VALUES(2,0,"johndoe","$2y$12$zVhnjfO2JWF8i/xwH5zShutgIr0nqWTmxmss7jVDsHfsdaDylZobK","Rua da Boavista",913459283);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (3,0,'Rui','ce74ecea394dc6748744f0edfec0686eb865f19134ac359d5bf3054a360111ce','rui@gmail.com',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (4,0,'andrekt','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','testeteste@gmail.com',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (5,1,'ruiowner','7c569aa09653644376f00da84c22bad7894d1dbe17a46532512fa36b4698500c','ruiowner@gmail.com',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (6,1,'manueljamorim','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','Av. Dom Afonso Henriques N6',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (7,1,'admin2','1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8','Av. Dom Afonso Henriques N6',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (8,0,'rui1234','$2y$12$25yi3sX9IVEmFcCtXT5un.rorw08R1raKwQhWfdFyc/0pp.xAo9/K','Rua Nova',913459281);
INSERT INTO "User" ("id","isOwner","username","password","address","phoneNumber") VALUES (9,0,'rui12345','$2y$12$EPFmy5tJRj0CCyh78owQH.v9M73xDpypxdsCsNj0C9kwqlpbYwoS6','Ruaaaaa',913459281);


INSERT INTO "Category" ("id","name") VALUES (0,'Fast Food');
INSERT INTO "Category" ("id","name") VALUES (1,'Coffe');
INSERT INTO "Category" ("id","name") VALUES (2,'Japanese Food');
INSERT INTO "Category" ("id","name") VALUES (3,'Ice Cream');
INSERT INTO "Category" ("id","name") VALUES (4,'Brazilian Food');
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (0,'McDonalds','Avenida dos Aliados, Porto',1,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (1,'KFC','Rua Rosa Teixeira, Porto',5,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (2,'Starbucks','Avenida Eça de Queirós, Porto',0,1);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (3,'Mc Donalds','Combatentes, Porto',0,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (4,'Pizza Hut','Trindade, Porto',1,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (5,'Papa Johns','Marquês do Pombal, Porto',5,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (6,'SushiPlace','Estádio do Dragão, Porto',6,2);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (7,'Sabor gaucho','Alameda Shopping, Porto',7,4);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (8,'Pans','NorteShopping, Porto',1,0);
INSERT INTO "Restaurant" ("id","name","address","id_Owner","id_Category") VALUES (9,'Ola','Rua de Santa Catarina, Porto',5,3);
INSERT INTO "FavouriteRestaurant" ("id_user","id_restaurant") VALUES (0,7);
INSERT INTO "FavouriteRestaurant" ("id_user","id_restaurant") VALUES (0,6);
INSERT INTO "FavouriteRestaurant" ("id_user","id_restaurant") VALUES (0,8);
INSERT INTO "FavouriteRestaurant" ("id_user","id_restaurant") VALUES (0,1);
INSERT INTO "Review" ("id","classification","comment","answer","id_writer","id_restaurant") VALUES (1,5,'Adorei! Recomendo','Muito obrigado',6,3);
INSERT INTO "Review" ("id","classification","comment","answer","id_writer","id_restaurant") VALUES (2,3,'Comida um pouco fria','',3,3);
INSERT INTO "Review" ("id","classification","comment","answer","id_writer","id_restaurant") VALUES (3,3,'Comida um pouco fria','',3,2);
INSERT INTO "Review" ("id","classification","comment","answer","id_writer","id_restaurant") VALUES (4,3,'Comida um pouco fria','Ta calado',4,3);
INSERT INTO "Review" ("id","classification","comment","answer","id_writer","id_restaurant") VALUES (5,3,'Comida um pouco fria','Pedimos desculpa',5,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (0,'Mc Chickens',4.5,0,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (1,'Mc Flurry',2.5,0,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (2,'Big Tasty',5.08,1,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (3,'Wrap',7,NULL,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (4,'Big Mac',4.04,NULL,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (5,'Temaki Home',13,NULL,6);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (6,'Pocke Bowl',20,NULL,6);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (7,'Sushi 20px',40,NULL,6);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (8,'Coca Cola',2,NULL,3);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (9,'Big mac',5.5,NULL,0);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (10,'Mc Wrap',6,NULL,0);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (11,'Sundae',3,NULL,0);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (12,'Coca Cola',2,NULL,0);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (13,'Bowl 1',7,NULL,1);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (14,'Pack Bowl',15,NULL,1);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (15,'Hamburguer',8,NULL,1);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (16,'Milkshake 1',7.5,NULL,2);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (17,'Milkshake 2',7.5,NULL,2);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (18,'Milkshake 3',7.5,NULL,2);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (19,'Pizza 1',12,NULL,4);
INSERT INTO "Dish" ("id","name","price","id_category","id_restaurant") VALUES (20,'Pizza 2',13,NULL,4);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (0,8);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (0,16);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (7,15);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (7,8);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (7,16);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (0,13);
INSERT INTO "FavouriteDish" ("id_user","id_dish") VALUES (0,14);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (1,'ready','03/06/2022 14:58',3,0);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (2,'delivered','03/06/2022 14:00',3,2);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (3,'preparing','03/06/2022 12:00',3,3);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (4,'preparing','06/06/2022 13:48',6,6);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (6,'preparing','06/06/2022 14:48',3,6);
INSERT INTO "Orders" ("id","state","date","id_restaurant","id_user") VALUES (9,'preparing','06/06/2022 14:45',2,6);
INSERT INTO "OrderDish" ("id_order","id_dish") VALUES (9,16);
INSERT INTO "OrderDish" ("id_order","id_dish") VALUES (9,17);
INSERT INTO "OrderDish" ("id_order","id_dish") VALUES (6,1);
INSERT INTO "OrderDish" ("id_order","id_dish") VALUES (6,4);
