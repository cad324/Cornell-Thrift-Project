-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- TODO: initial seed data

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
