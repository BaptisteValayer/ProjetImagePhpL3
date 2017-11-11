CREATE TABLE image (
id int primary key,
path varchar(1024),
category varchar(64),
comment varchar(1024), 
jugement int, 
album int
);

CREATE TABLE album(
id integer primary key autoincrement,
nom varchar);
