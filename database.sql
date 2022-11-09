CREATE DATABASE polytechnic_college

CREATE TABLE users(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	student_number VARCHAR(255) UNIQUE,
	name VARCHAR(255),
	email VARCHAR(255) UNIQUE,
	program VARCHAR(255),
	ongoing_term VARCHAR(255),
	password VARCHAR(255),
	status int(6)
);