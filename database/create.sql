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
  phoneNumber   INTEGER
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

INSERT INTO User VALUES(0,1,"lolipop","a3dj!eadwqdw","luislollipop@gmail.com",91345928);
INSERT INTO User VALUES(1,1,"lolipop2","a3dj!eadwqwd","luislollipop@gmail.com",91345928);
INSERT INTO User VALUES(2,0,"lolipop3","a3dj!eadwdqww","luislollipop@gmail.com",91345928);

INSERT INTO Category VALUES(0,'Fast Food');
INSERT INTO Category VALUES(1,'Cofee');
INSERT INTO Category VALUES(2,'Japanese Food');
INSERT INTO Category VALUES(3,'Ice Cream');
INSERT INTO Category VALUES(4,'Brazilian Food');


INSERT INTO Restaurant VALUES(0,'McDonalds','Avenida dos Aliados, Porto',1,0);
INSERT INTO Restaurant VALUES(1,'KFC','Rua Rosa Teixeira, Porto',1,0);
INSERT INTO Restaurant VALUES(2,'Starbucks','Avenida Eça de Queirós, Porto',1,1);
INSERT INTO Restaurant VALUES(3,'Burguer King','Combatentes, Porto',1,0);
INSERT INTO Restaurant VALUES(4,'Pizza Hut','Trindade, Porto',1,0);
INSERT INTO Restaurant VALUES(5,'Papa Johns','Marquês do Pombal, Porto',1,0);
INSERT INTO Restaurant VALUES(6,'SushiPlace','Estádio do Dragão, Porto',1,2);
INSERT INTO Restaurant VALUES(7,'Sabor gaucho','Alameda Shopping, Porto',1,4);
INSERT INTO Restaurant VALUES(8,'Pans','NorteShopping, Porto',1,0);
INSERT INTO Restaurant VALUES(9,'Ola','Rua de Santa Catarina, Porto',1,3);




--INSERT INTO Dish VALUES(0,'Hamgurguer vegetariano',4.50,0,0);




/*INSERT INTO Review VALUES(0,4.0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Nunc lacinia dolor vitae neque condimentum, vel convallis quam sodales. 
Suspendisse pellentesque dictum mi in imperdiet. 
Pellentesque efficitur odio viverra facilisis posuere. 
Aenean auctor ut erat sed dapibus. Aenean pretium elementum lacus, 
semper consectetur lacus euismod quis. 
Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
Fusce faucibus, odio nec tristique posuere, 
metus augue ultricies arcu, in venenatis nunc felis quis odio.','Duis sed dapibus nulla. Nam in luctus ex.
 Vivamus ultricies posuere ex quis faucibus. Cras pretium lectus ut pharetra luctus. 
 Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; 
 Ut sem lectus, semper a dui vehicula, elementum elementum sem. Sed eget lorem sit amet diam pharetra
euismod quis lobortis metus. Maecenas eu blandit turpis. 
Nulla mollis gravida diam, eu pulvinar purus mollis eleifend.',0,0);
*/
