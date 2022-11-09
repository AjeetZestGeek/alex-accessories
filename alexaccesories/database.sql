CREATE DATABASE alex-accessories;
CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	emailaddress VARCHAR(255) NOT NULL UNIQUE,
	phonenumber VARCHAR(255),
	role VARCHAR(255),
	password VARCHAR(255),
	status INT(1)
)