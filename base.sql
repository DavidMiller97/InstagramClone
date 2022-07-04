CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS usuarios(

    usuario_id INT AUTO_INCREMENT NOT NULL,
    rol VARCHAR(20) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(200),
    seudonimo VARCHAR(100),
    correo VARCHAR(255),
    password VARCHAR(255),
    imagen VARCHAR(255),
    created_at datetime,
    updated_at datetime,
    remember_token VARCHAR(255),

    CONSTRAINT pk_usuarios PRIMARY KEY (usuario_id)

)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS imagenes(

    imagen_id INT AUTO_INCREMENT NOT NULL,
    usuario_id INT NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_imagenes PRIMARY KEY(imagen_id),
    CONSTRAINT fk_usuario_imagen FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id)

)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comentarios(

    comentario_id INT AUTO_INCREMENT NOT NULL,
    usuario_id INT NOT NULL,
    imagen_id INT NOT NULL,
    contenido TEXT NOT NULL,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_comentarios PRIMARY KEY (comentario_id),
    CONSTRAINT fk_usuario_comentario FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id),
    CONSTRAINT fk_imagen_comentario FOREIGN KEY (imagen_id) REFERENCES imagenes (imagen_id)

)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS likes(

    like_id INT AUTO_INCREMENT NOT NULL,
    usuario_id INT NOT NULL,
    imagen_id INT NOT NULL,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_likes PRIMARY KEY (like_id),
    CONSTRAINT fk_usuario_like FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id),
    CONSTRAINT fk_imagen_like FOREIGN KEY (imagen_id) REFERENCES imagenes (imagen_id)

)ENGINE=InnoDb;

INSERT INTO usuarios (rol, nombre, apellidos, seudonimo, correo, password, imagen, created_at, updated_at) VALUES ('user', 'David', 'Latapi', 'DavidMiller', 'david211910@gmail.com', 'miller97', null, CURTIME(), CURTIME());