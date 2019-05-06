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

INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (1, 'Classic Thrift Stores',"Trader K's", 'Ithaca Commons, 119 E State St.', 'A more selective thrift store that buys, sells, and trades used women, men, and children clothing, shoes, accessories, and toys. A great option for students looking for a classic thrift store closer to campus.', 'Mon-Sat 10AM-9PM. Sun 11AM-7PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (2, 'Classic Thrift Stores','Salvation Army', '381 Elmira Rd., Ithaca', 'At Salvys you can find almost everything secondhand from clothing, accessories, shoes to furniture, appliances, sporting gear, toys, and cool random knick knacks at bargain prices. Revenues go to several causes like hunger relief and veteran services.', 'Mon-Fri 9AM-8PM. Sat 9AM-5PM.', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (3, 'Classic Thrift Stores','Thrifty Shopper', '376 Elmira Rd., Ithaca', 'Your classic thrift store with lots of variety in secondhand clothing, shoes, bags, books, kitchenware, toys, sporting goods, electronics, small appliances, and furniture. Revenue go towards programs/services to end hunger and homelessness.', 'Mon-Fri 10AM-9PM. Sat 9AM-9PM. Sun 11AM-6PM.', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (4, 'Specialty Clothing','Pertune', 'Ithaca Commons, 126 E State St.', 'Pertune is the place to find unique, collectible vintage and vintage inspired pieces from the late 1800s to the 1980s for men and women!', 'Mon-Thur 11AM-7PM. Fri-Sat 11AM-8PM. Sun 12-6PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (5, 'Specialty Clothing','Old Goat Gear Exchange', 'Ithaca Commons, 320 E State St.', 'Used, new, and sample items of outdoor gear and clothing! They use the buy/sell/trade model and accept consignments of big-ticket items like kayaks, canoes, and bikes.', 'Mon 11AM-9PM. Tues-Sat 10AM-7PM. Sun 11-5PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (6, 'Specialty Clothing',"Plato's Closet", '106 Fairgrounds Memorial Pkwy #500, Ithaca', "Plato's caters to teenagers and young adults, so the brands and styles provided are well suited for college students looking for trendy, current pieces! They also buy everyday and pay on the spot.", 'Mon-Sat 10AM-9PM. Sun 11AM-6PM.', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (7, 'Specialty Clothing','Green Eileen Boutique', 'Ithaca Commons, 112 N Cayuga St.', 'If you love the high quality, yet expensive Eileen Fisher brand, this store is the place for you. By reselling gently used Eileen Fisher clothing, they support non-profit programs like The Garrison Institute and Girls, Inc.', 'Mon-Sat 11AM-6PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (8, 'Specialty Clothing','Mary Durham Boutique', 'Ithaca Commons, 110 W Court St.', "The place to go for colorful and quality womens clothing. Locate in a converted Victorian house to add to the ambience, the boutique help support Women's Opportunity Centers programs.", 'Mon-Thu 10AM-5PM. Fri 10AM-6PM. Sat 10AM-4PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (9, 'Furniture/Books/Other','Mimis Attic', '430 W State Street, Ithaca', 'Stylish and useful vintage items for the home! They sell furniture, housewares, and home decor. If you buy a Mimis item, send a photo of it for a $5 store credit.', 'Mon-Sat 10AM-6PM. Sun 12PM-4PM.', '$$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (10, 'Furniture/Books/Other','Autumn Leaves / Angry Mom Records', 'Ithaca Commons, 115 E State St.', 'Provides the selection and quality of a new book store with used book store prices. Angry Mom Records has over 20,000 new, used, rare, and weird records.', 'Mon-Wed 10AM-8PM. Thu-Sat 10AM-9PM. Sun 11AM-6PM.', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (11, 'Furniture/Books/Other','Ithaca Reuse Center', '214 Elmira Rd., Ithaca', 'The place to go for literally everything - from household goods, furniture, and electronics. Sales from donated used items are reinvested back into the community for other initiatives.', 'Mon-Sat 10AM-6PM. Sun 10AM-5PM.', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (12, 'Sewing and Alteration Supplies','Sew Green', 'Ithaca Commons, 112 N Cayuga, St.', 'Full of donated and affordable fabrics, yarn, and sewing supplies, this store has everything you will need to take your thrifting to another level! They even offer sewing and knitting classes if you need help getting started.', 'Mon-Sat 11AM-6PM', '$');
INSERT INTO stores (id, Category, Name, Address, Description, Hours, Price) VALUES (13, 'Sewing and Alteration Supplies','Art Restart', 'Ithaca Commons, 112 N Cayuga St.', 'Whether you are the next van Gogh or just want to do some coloring, Art ReStart is a must stop. Purchase new and slightly used art materials - from paper to paints to easels - and support teen apprenticeships at SewGreen!', 'Mon-Sat 11AM-6PM', '$');

COMMIT;
