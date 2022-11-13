CREATE DATABASE "alex-accessories";
CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	emailaddress VARCHAR(255) NOT NULL UNIQUE,
	phonenumber VARCHAR(255),
	role VARCHAR(255),
	password VARCHAR(255),
	status INT(1)
);
INSERT INTO `users` (`id`, `username`, `emailaddress`, `phonenumber`, `role`, `password`, `status`) VALUES (NULL, 'admin', 'admin@gmail.com', '+129876543210', 'Admin', '0192023a7bbd73250516f069df18b500', '1');
-- Username = admin
-- password = admin123