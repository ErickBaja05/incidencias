CREATE TABLE usuarios (
    username varchar(50) NOT NULL,
    passwd varchar(255) NOT NULL,
    CONSTRAINT pk_usuarios PRIMARY KEY (username)
);

CREATE TABLE incidencias (
    id INT AUTO_INCREMENT NOT NULL,
    usuario_username VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion varchar(200) NOT NULL,
    prioridad VARCHAR(10) NOT NULL CHECK (prioridad IN ('alta', 'media', 'baja')),
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_incidencias PRIMARY KEY (id),
    CONSTRAINT fk_indicencias_usuario FOREIGN KEY (usuario_username) REFERENCES usuarios (username) ON UPDATE CASCADE ON DELETE RESTRICT
);
