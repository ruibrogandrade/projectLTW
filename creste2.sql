-- Table: User
DROP TABLE IF EXISTS User;
CREATE TABLE User (
  id            INTEGER PRIMARY KEY,
  username		STRING UNIQUE NOT NULL,
  password	    STRING NOT NULL,
  adress        STRING,
  phoneNumber   INTEGER
);

-- Table: Category
DROP TABLE IF EXISTS Category;
CREATE TABLE Category (
  id            INTEGER PRIMARY KEY,
  name  		STRING
);

-- Table: Restaurant
DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant (
  id            INTEGER PRIMARY KEY,
  name  		STRING,
  adress        STRING,
  id_owner      INTEGER References User(id),
  id_category   INTEGER References Category(id)
);

-- Table: Order2
DROP TABLE IF EXISTS Order2;
CREATE TABLE Order2 (
  id            INTEGER PRIMARY KEY,
  name  		STRING,
  adress        STRING
);
