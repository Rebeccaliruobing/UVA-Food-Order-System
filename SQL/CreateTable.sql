CREATE TABLE user_info
(
  userid varchar(255) NOT NULL,
  passcode varchar(255) NOT NULL,
  address varchar(255),
  phone INT,
  cardnumber INT,
  wallet INT,
  PRIMARY KEY (userid)
);

CREATE TABLE order_info
(
  orderid INT NOT NULL auto_increment,
  total_price INT NOT NULL,
  primary key (orderid)
);

CREATE TABLE order_relation
(
  userid varchar(255) NOT NULL,
  orderid INT NOT NULL,
  order_date date NOT NULL,
  PRIMARY KEY (orderid),
  foreign key (userid) REFERENCES user_info(userid),
  foreign key (orderid) REFERENCES order_info(orderid)
);

CREATE TABLE food_storage
(
  foodname varchar(255) NOT NULL,
  quantity INT NOT NULL,
  unit_price double NOT NULL,
  PRIMARY KEY (foodname)
);

CREATE TABLE order_content
(
  orderid INT NOT NULL,
  foodname varchar(255) NOT NULL,
  quantity INT NOT NULL,
  primary key (orderid, foodname, quantity),
  foreign key (orderid) references order_info(orderid),
  foreign key (foodname) references food_storage(foodname)
);

insert into food_storage (foodname, quantity, unit_price)
values ("Pineapple Juice", 10000, 17.50),
("Green Juice", 10000, 7.99),
("Soft Drinks", 10000, 12.99),
("Carlo Rosee Drinks", 10000, 12.99),
("Beef Steak", 10000, 17.50),
("Tomato with Chicken", 10000, 7.99),
("Sausages from Italy", 10000, 12.99),
("Beef Grilled", 2, 12.99);
