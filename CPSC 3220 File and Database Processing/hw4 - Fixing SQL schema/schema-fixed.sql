DROP SCHEMA IF EXISTS SuperStore;
CREATE SCHEMA SuperStore;
USE SuperStore;
-- changed price and base_cost to dec(13,2)


CREATE TABLE SuperStore.address (
  address_id INT NOT NULL AUTO_INCREMENT,
  street varchar(100) NOT NULL,
  city varchar(100) NOT NULL,
  state varchar(100) NOT NULL,
  zip varchar(100) NOT NULL,
  CONSTRAINT address_pk PRIMARY KEY (address_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.product (
  product_id INT NOT NULL AUTO_INCREMENT,
  product_name varchar(100) NOT NULL,
  description varchar(100) NOT NULL,
  weight varchar(100) NOT NULL,
  base_cost dec(13,2) NOT NULL,
  CONSTRAINT product_pk PRIMARY KEY (product_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.customer (
  customer_id INT NOT NULL AUTO_INCREMENT,
  first_name varchar(100) NOT NULL,
  last_name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(100) NOT NULL,
  CONSTRAINT customer_pk PRIMARY KEY (customer_id),
  address_id INT NOT NULL,
  CONSTRAINT customer_address_fk FOREIGN KEY (address_id) REFERENCES SuperStore.address(address_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.order (
  order_id INT NOT NULL AUTO_INCREMENT,
  CONSTRAINT order_pk PRIMARY KEY (order_id),
  customer_id INT NOT NULL,
  address_id INT NOT NULL,
  CONSTRAINT order_customer_fk FOREIGN KEY (customer_id) REFERENCES SuperStore.customer(customer_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT order_address_fk FOREIGN KEY (address_id) REFERENCES SuperStore.address(address_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.order_item (
  quantity varchar(100) NOT NULL,
  price dec(13,2) NOT NULL,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  CONSTRAINT item_order_fk FOREIGN KEY (order_id) REFERENCES SuperStore.order(order_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT item_product_fk FOREIGN KEY (product_id) REFERENCES SuperStore.product(product_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.warehouse (
  warehouse_id INT NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  CONSTRAINT warehouse_pk PRIMARY KEY (warehouse_id),
  address_id INT NOT NULL,
  CONSTRAINT warehouse_address_fk FOREIGN KEY (address_id) REFERENCES SuperStore.address(address_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

CREATE TABLE SuperStore.product_warehouse (
  product_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  CONSTRAINT product_warehouse_product_fk FOREIGN KEY (product_id) REFERENCES SuperStore.product(product_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT product_warehouse_warehouse_fk FOREIGN KEY (warehouse_id) REFERENCES SuperStore.warehouse(warehouse_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;
