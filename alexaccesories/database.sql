CREATE DATABASE "alex-accessories";

CREATE TABLE users(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	emailaddress VARCHAR(255) NOT NULL UNIQUE,
	phonenumber VARCHAR(255),
	role VARCHAR(255) DEFAULT 'User',
	password VARCHAR(255),
	status INT(1)
);

INSERT INTO `users` (`id`, `username`, `emailaddress`, `phonenumber`, `role`, `password`, `status`) VALUES (NULL, 'admin', 'admin@gmail.com', '+129876543210', 'Admin', '0192023a7bbd73250516f069df18b500', '1');
-- Username = admin
-- password = admin123

CREATE TABLE blog_categary(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL UNIQUE,
	status int(6),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE blog_post(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	category_id BIGINT,
	title VARCHAR(255) NOT NULL,
	content LONGTEXT,
	image VARCHAR(255),
	status int(6),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	FOREIGN KEY (category_id) REFERENCES blog_categary(id),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE blog_comment(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	blog_id BIGINT,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	content LONGTEXT,
	status int(6),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	FOREIGN KEY (blog_id) REFERENCES blog_post(id),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);