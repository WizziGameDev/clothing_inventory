# DDL
CREATE DATABASE fp_web;

-- Table Contact
CREATE TABLE contact(
    id VARCHAR(100) NOT NULL PRIMARY KEY ,
    number BIGINT(25) NOT NULL
)ENGINE InnoDB;

-- Table Address
CREATE TABLE address(
    id VARCHAR(100) NOT NULL PRIMARY KEY ,
    city VARCHAR(100) NOT NULL ,
    state VARCHAR(100) NOT NULL ,
    country VARCHAR(100) NOT NULL
)ENGINE InnoDB;

-- Table Customer
CREATE TABLE customer(
    code VARCHAR(100) NOT NULL PRIMARY KEY ,
    name VARCHAR(100) NOT NULL ,
    contact_id VARCHAR(100) NOT NULL ,
    address_id VARCHAR(100) NOT NULL,
    FOREIGN KEY (contact_id) REFERENCES contact(id),
    FOREIGN KEY (address_id) REFERENCES address(id),
    UNIQUE (contact_id, address_id)
)ENGINE InnoDB;

-- Table Supplier
CREATE TABLE supplier(
    code VARCHAR(100) NOT NULL PRIMARY KEY ,
    name VARCHAR(100) NOT NULL ,
    email VARCHAR(100) NOT NULL ,
    contact_id VARCHAR(100) NOT NULL ,
    address_id VARCHAR(100) NOT NULL,
    FOREIGN KEY (contact_id) REFERENCES contact(id),
    FOREIGN KEY (address_id) REFERENCES address(id),
    UNIQUE (contact_id, address_id)
)ENGINE InnoDB;

-- Table Item
CREATE TABLE item(
    code VARCHAR(100) NOT NULL PRIMARY KEY ,
    name VARCHAR(100) NOT NULL ,
    price BIGINT NOT NULL ,
    stock INT NOT NULL ,
    category VARCHAR(100) NOT NULL
)ENGINE InnoDB;

-- Table Purchase
CREATE TABLE purchase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tgl_purchase DATE NOT NULL,
    supplier_code VARCHAR(100) NOT NULL,
    FOREIGN KEY (supplier_code) REFERENCES supplier(code)
) ENGINE InnoDB;

-- Table Detail Purchase
CREATE TABLE detail_purchase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_id INT NOT NULL,
    item_code VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price BIGINT NOT NULL,
    total_price BIGINT NOT NULL ,
    FOREIGN KEY (purchase_id) REFERENCES purchase(id),
    FOREIGN KEY (item_code) REFERENCES item(code)
) ENGINE InnoDB;

-- Table Sale
CREATE TABLE sale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tgl_sale DATE NOT NULL,
    customer_code VARCHAR(100) NOT NULL,
    FOREIGN KEY (customer_code) REFERENCES customer(code)
) ENGINE InnoDB;

-- Table Detail Sale
CREATE TABLE detail_sale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    item_code VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price BIGINT NOT NULL,
    total_price BIGINT NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sale(id),
    FOREIGN KEY (item_code) REFERENCES item(code)
) ENGINE InnoDB;

# DML
-- Dicode nya cari ya di bagian repository, nahh tinggal pilih, ss query









  