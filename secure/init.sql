-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables
CREATE TABLE `users` (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `username` TEXT NOT NULL,
    `password` TEXT,
    `eboard` TEXT
);

CREATE TABLE `messages` (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `message` TEXT NOT NULL
);

CREATE TABLE `mail_list` (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `email` TEXT NOT NULL
);

CREATE TABLE `sessions` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`user_id` INTEGER NOT NULL,
	`session` TEXT NOT NULL UNIQUE
);


-- TODO: initial seed data

-- USERS
INSERT INTO users(username, password, eboard) VALUES("bryant1", "$2y$10$mamfvo1fEFz3xiZaizVE9.Bf1W5EkuURsKarHIQi33N.ZCQzVhAky", "yes");
-- password: donkey
INSERT INTO users(username, password) VALUES("sharon10", "$2y$10$.PRPlORbQUPaTVSeiGK5vuv6T.qW4kYhdfgBqGiwi2GTb1LC1/rf2");
-- password: dolphin

-- MESSAGES
INSERT INTO messages(name, email, message) VALUES("Clive", "cad324@cornell.edu",
        "Please tell me more about your club");
INSERT INTO messages(name, email, message) VALUES("John Doe", "jd11@gmail.com",
        "How do I become a part of this club");

-- MAIL_LIST
INSERT INTO mail_list(email) VALUES("cad324@cornell.edu");
INSERT INTO mail_list(email) VALUES("gf123@cornell.edu");
INSERT INTO mail_list(email) VALUES("jim@gmail.com");
INSERT INTO mail_list(email) VALUES("ww90@cornell.edu");
INSERT INTO mail_list(email) VALUES("willy@yahoo.com");

-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!

CREATE TABLE images (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	file_name TEXT NOT NULL,
	file_ext TEXT NOT NULL,
	desc TEXT
);

INSERT INTO images (id, file_name, file_ext, desc) VALUES (1,"1","jpg","none");
INSERT INTO images (id, file_name, file_ext, desc) VALUES (2,"2","jpg","none");
INSERT INTO images (id, file_name, file_ext, desc) VALUES (3,"3","jpg","none");

COMMIT;
