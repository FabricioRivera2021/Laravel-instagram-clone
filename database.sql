CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;

CREATE TABLE IF NOT EXISTS users(
    id                  INT(255) auto_increment NOT NULL,
    role                VARCHAR(20),
    name                VARCHAR(100),
    surname             VARCHAR(200),
    nick                VARCHAR(100),
    email               VARCHAR(255),
    password            VARCHAR(255),
    image               VARCHAR(255),
    created_at          datetime,
    updated_at          datetime,
    remember_token      VARCHAR(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Fabricio', 'Rivera', 'FRivera', 'Fabricio.Rivera@gmail.com', 'password', null, CURTIME(), CURTIME(), null);
INSERT INTO users VALUES(NULL, 'user', 'Agustin', 'Grau', 'AGrau', 'Agustin.Grau@gmail.com', 'password', null, CURTIME(), CURTIME(), null);
INSERT INTO users VALUES(NULL, 'user', 'Paola', 'Gasco', 'PGasco', 'Paola.Gasco@gmail.com', 'password', null, CURTIME(), CURTIME(), null);

CREATE TABLE IF NOT EXISTS images(
    id                  INT(255) auto_increment NOT NULL,
    user_id             INT(255),
    image_path          VARCHAR(255),
    description         TEXT,
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(null, 1, 'test.jpg', 'descripcion de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 1, 'playa.jpg', 'descripcion de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 2, 'cielo.jpg', 'descripcion de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 2, 'cerro.jpg', 'descripcion de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 2, 'montevideo.jpg', 'descripcion de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 3, 'pasto.jpg', 'descripcion de prueba', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id                  INT(255) auto_increment NOT NULL,
    user_id             INT(255),
    image_id            INT(255),
    content             TEXT,
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(null, 1, 4, 'Buena foto del cerro', CURTIME(), CURTIME());
INSERT INTO comments VALUES(null, 2, 1, 'Buena foto del testeo', CURTIME(), CURTIME());
INSERT INTO comments VALUES(null, 2, 4, 'Quedo tremenda!', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
    id                  INT(255) auto_increment NOT NULL,
    user_id             INT(255),
    image_id            INT(255),
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(null, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 2, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 2, 1, CURTIME(), CURTIME());