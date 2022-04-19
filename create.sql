PRAGMA foreign_keys = on;
.mode columns
.headers on
.nullvalue NULL


-- Table: User
DROP TABLE IF EXISTS User;
CREATE TABLE User (
  id            INTEGER PRIMARY KEY,
  username		STRING UNIQUE NOT NULL,
  password	    STRING NOT NULL check(length(password) >= 8),
  adress        STRING,
  phoneNumber   INTEGER
);

-- Table: Category
DROP TABLE IF EXISTS Category;
CREATE TABLE Category (
  id        INTEGER PRIMARY KEY,
  name  		STRING
);

-- Table: Restaurant
DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant (
  id            INTEGER PRIMARY KEY,
  name  		    STRING,
  adress        STRING,
  id_owner      INTEGER References User(id),
  id_category   INTEGER References Category(id)
);

-- Table: FavouriteRestaurant
DROP TABLE IF EXISTS FavouriteRestaurant;
CREATE TABLE FavouriteRestaurant (
  id_user           INTEGER References User(id),
  id_restaurant     INTEGER References Restaurant(id),
  PRIMARY KEY(id_user, id_restaurant)
);

-- Table: Review
DROP TABLE IF EXISTS Review;
CREATE TABLE Review (
  id                INTEGER PRIMARY KEY,
  classification  	INTEGER CHECK(classification > 0 AND classification <= 5),
  comment           STRING,
  answer            STRING,
  id_writer         INTEGER References User(id),
  id_restaurant     INTEGER References Restaurant(id)
);

-- Table: Dish
DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish (
  id                INTEGER PRIMARY KEY,
  name  	          STRING,
  price             INTEGER,
  id_category       INTEGER References Category(id),
  id_restaurant     INTEGER References Restaurant(id)
);

-- Table: FavouriteDish
DROP TABLE IF EXISTS FavouriteDish;
CREATE TABLE FavouriteDish (
  id_user           INTEGER References User(id),
  id_dish            INTEGER References Dish(id),
  PRIMARY KEY(id_user,id_dish)
);

-- Table: Photo
DROP TABLE IF EXISTS Photo;
CREATE TABLE Photo (
  id                INTEGER PRIMARY KEY,
  url               STRING,
  id_dish           INTEGER References Dish(id)
);

-- Table: Orders
DROP TABLE IF EXISTS Orders;
CREATE TABLE Orders (
  id                INTEGER PRIMARY KEY,
  state             STRING,
  date              Date,
  id_restaurant     INTEGER References Restaurant(id),
  id_user           INTEGER References User(id)
);

--Table: OrderDish
DROP TABLE IF EXISTS OrderDish;
CREATE TABLE OrderDish (
  id_order           INTEGER References Orders(id),
  id_dish            INTEGER References Dish(id),
  PRIMARY KEY(id_order,id_dish)
);


INSERT INTO Restaurant VALUES(0,'McDonalds','Avenida dos Aliados, Porto',0,0);
INSERT INTO Category VALUES(0,'Fast Food');
INSERT INTO Dish VALUES(0,'Hamgurguer vegetariano',4.50,0,0);
INSERT INTO User VALUES(0,"lolipop","a3dj!ea","luislollipop@gmail.com",91345928);
INSERT INTO Review VALUES(0,4.0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
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