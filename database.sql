CREATE DATABASE polytechnic_college

CREATE TABLE users(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	student_number VARCHAR(255) NOT NULL UNIQUE,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	program VARCHAR(255),
	ongoing_term VARCHAR(255),
	password VARCHAR(255),
	role VARCHAR(255) DEFAULT 'User',
	status int(6)
);

INSERT INTO `users` (`id`, `student_number`, `name`, `email`, `program`, `ongoing_term`, `password`, `role`, `status`) VALUES (NULL, 'admin', 'Admin', 'admin@gmail.com', '', NULL, '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', 'Admin', '1');
-- Admin Credintial --
-- UserId :- admin / admin@gmail.com
-- Password :- admin@123

CREATE TABLE priority(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL UNIQUE,
	created_by_id BIGINT,
	status int(6),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE routine(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	content LONGTEXT,
	image VARCHAR(255),
	event_date VARCHAR(255) NOT NULL,
	from_time VARCHAR(255) NOT NULL,
	to_time VARCHAR(255) NOT NULL,
	is_globel int(1) DEFAULT 0,
	priority_id BIGINT, 
	created_at VARCHAR(255),
	updated_at VARCHAR(255),
	created_by_id BIGINT,
	status int(6),
	FOREIGN KEY (created_by_id) REFERENCES users(id),
	FOREIGN KEY (priority_id) REFERENCES priority(id)
);

CREATE TABLE comment(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	routine_id BIGINT,
	feedback VARCHAR(255), 
	created_at VARCHAR(255),
	updated_at VARCHAR(255),
	created_by_id BIGINT,
	status int(6),
	FOREIGN KEY (created_by_id) REFERENCES users(id),
	FOREIGN KEY (routine_id) REFERENCES routine(id)
);