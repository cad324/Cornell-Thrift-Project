-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables
CREATE TABLE `users` (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `username` TEXT NOT NULL,
    `password` TEXT,
    `eboard` TEXT
);

CREATE TABLE `about_images` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
 	`image_name`	TEXT NOT NULL UNIQUE,
	`ext`    TEXT NOT NULL,
    `job`   TEXT NOT NULL
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

CREATE TABLE 'events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'name' TEXT NOT NULL,
    'date' DATE,
    'location' TEXT,
    'time' TEXT
);

CREATE TABLE 'categories' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'category' TEXT NOT NULL
);

CREATE TABLE 'event_categories' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'event_id' INTEGER NOT NULL,
    'category_id' INTEGER NOT NULL
);

CREATE TABLE 'stores' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'Category' TEXT NOT NULL,
    'Name' TEXT NOT NULL,
    'Address' TEXT NOT NULL,
    'Description' INTEGER,
    'Hours' TEXT,
    'Price' INTEGER
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

INSERT INTO images (file_name, file_ext, desc) VALUES ("1","jpg","none");
INSERT INTO images (file_name, file_ext, desc) VALUES ("2","png","none");


INSERT INTO about_images (image_name, ext, job) VALUES ('Becky', 'jpg', 'Event Planner');
INSERT INTO about_images (image_name, ext, job) VALUES ('Chelsea', 'jpg', 'Treasurer');
INSERT INTO about_images (image_name, ext, job) VALUES ('Clara', 'jpg', 'Executive Director');
INSERT INTO about_images (image_name, ext, job) VALUES ('Dana', 'jpg', 'Operations Managers of West Campus');
INSERT INTO about_images (image_name, ext, job) VALUES ('Jakie', 'jpg', 'Operations Managers of Greek Houses');
INSERT INTO about_images (image_name, ext, job) VALUES ('Kemba', 'jpg', 'Graphics Designer');
INSERT INTO about_images (image_name, ext, job) VALUES ('Meghan', 'jpg', 'Executive Director');
INSERT INTO about_images (image_name, ext, job) VALUES ('Sharon', 'jpg', 'Publicity Director');
INSERT INTO about_images (image_name, ext, job) VALUES ('Stephanie', 'jpg', 'Collaboration Coordinates in the Programming Committee');

-- Events table seed data
INSERT INTO events (name, location) VALUES ('Thrift Exchange Closet: WSH', 'Williard Straight Hall Browsing Library');
INSERT INTO events (name, location) VALUES ('Thrift Exchange Closet: Becker House', 'Carl Becker House Lobby');
INSERT INTO events (name, date, time, location) VALUES ('Spring Cleaning Pop-Up Thrift Store', '2019-03-04', '5-8pm', 'Williard Straight Hall');
INSERT INTO events (name, date, time, location) VALUES ('Pop-Up Shop', '2018-11-29', '5-7pm', 'Williard Straight Hall');
INSERT INTO events (name, date, time, location) VALUES ('The Liberation Thrift Shop', '2018-04-13', '8pm-1am', 'Risley Hall');
INSERT INTO events (name, date, time, location) VALUES ('Cornell Thrift Mending Workshop: Napkin Making Edition!', '2019-05-01', '5-7pm', 'Makerspace, Mann Library');
INSERT INTO events (name, date, time, location) VALUES ('Spring Mending Workshop', '2019-03-27', '5-7pm', 'Makerspace, Mann Library');
INSERT INTO events (name, date, time, location) VALUES ('Mend It! Cornell Thrift x DSCC', '2018-11-29', '5-7pm', 'Williard Straight Hall');
INSERT INTO events (name, date, time, location) VALUES ('Mending Workshop: November Edition', '2018-11-08', '5-7pm', 'Mann Library');
INSERT INTO events (name, date, time, location) VALUES ('Halloween Mending Workshop', '2018-10-18', '5-7pm', 'Mann Library');

INSERT INTO categories (category) VALUES ('Thrift Exchange Closet');
INSERT INTO categories (category) VALUES ('Pop-Up Shop');
INSERT INTO categories (category) VALUES ('Sewing Workshop');

INSERT INTO event_categories (event_id, category_id) VALUES (1, 1);
INSERT INTO event_categories (event_id, category_id) VALUES (2, 1);
INSERT INTO event_categories (event_id, category_id) VALUES (3, 2);
INSERT INTO event_categories (event_id, category_id) VALUES (4, 2);
INSERT INTO event_categories (event_id, category_id) VALUES (5, 2);
INSERT INTO event_categories (event_id, category_id) VALUES (6, 3);
INSERT INTO event_categories (event_id, category_id) VALUES (7, 3);
INSERT INTO event_categories (event_id, category_id) VALUES (8, 3);
INSERT INTO event_categories (event_id, category_id) VALUES (9, 3);
INSERT INTO event_categories (event_id, category_id) VALUES (10, 3);

INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (1, 'Classic Thrift Stores','Trader Ks', 'Ithaca Commons, 119 E State St', 'A more selective thrift store that buys, sells, and trades used women, men, and children clothing, shoes, accessories, and toys. A great option for students looking for a classic thrift store closer to campus.', 'Mon-Sat 10AM-9PM. Sun 11AM-7PM.', '$$');

COMMIT;
