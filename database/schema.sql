-- Maven Weeb — Database Schema
-- MySQL 8.0+ / MariaDB 10.5+
-- Encoding: utf8mb4

CREATE DATABASE IF NOT EXISTS maven_weeb
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE maven_weeb;

-- ============================================================
-- USERS & AUTH
-- ============================================================

CREATE TABLE administradores (
  id_administrador INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  apellido         VARCHAR(50)     NOT NULL,
  nombre           VARCHAR(50)     NOT NULL,
  correo           VARCHAR(100)    NOT NULL UNIQUE,
  usuario          VARCHAR(30)     NOT NULL UNIQUE,
  clave            VARCHAR(255)    NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE clientes (
  id_cliente INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  apellido   VARCHAR(50)     NOT NULL,
  nombre     VARCHAR(50)     NOT NULL,
  correo     VARCHAR(100)    NOT NULL UNIQUE,
  usuario    VARCHAR(30)     NOT NULL UNIQUE,
  clave      VARCHAR(255)    NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE editores (
  id_editor        INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  apellido         VARCHAR(50)     NOT NULL,
  nombre           VARCHAR(50)     NOT NULL,
  correo           VARCHAR(100)    NOT NULL UNIQUE,
  usuario          VARCHAR(30)     NOT NULL UNIQUE,
  clave            VARCHAR(255)    NOT NULL,
  id_administrador INT UNSIGNED    NOT NULL,
  FOREIGN KEY (id_administrador) REFERENCES administradores(id_administrador)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- CONTENT
-- ============================================================

CREATE TABLE blogs (
  id_blog   INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  titulo    VARCHAR(200)    NOT NULL,
  imagen    VARCHAR(255),
  contenido TEXT            NOT NULL,
  fecha     DATE            NOT NULL,
  hora      TIME            NOT NULL,
  id_editor INT UNSIGNED    NOT NULL,
  FOREIGN KEY (id_editor) REFERENCES editores(id_editor)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE servicios (
  id_servicio INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100)    NOT NULL,
  detalle     VARCHAR(500)    NOT NULL,
  precio      DECIMAL(10, 2)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE proyectos (
  id_proyecto INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100)    NOT NULL,
  detalle     VARCHAR(500)    NOT NULL,
  imagen      VARCHAR(255),
  rubro       VARCHAR(100)    NOT NULL,
  fecha       DATE            NOT NULL,
  id_editor   INT UNSIGNED    NOT NULL,
  FOREIGN KEY (id_editor) REFERENCES editores(id_editor)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TRANSACTIONS
-- ============================================================

CREATE TABLE cotizaciones (
  id_cotizacion    INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  codigo           INT UNSIGNED    NOT NULL,
  id_cliente       INT UNSIGNED    NOT NULL,
  id_servicio      INT UNSIGNED    NOT NULL,
  precio           DECIMAL(10, 2)  NOT NULL,
  nombre_servicio  VARCHAR(100)    NOT NULL,
  detalle_servicio VARCHAR(500)    NOT NULL,
  fecha            DATE            NOT NULL,
  hora             TIME            NOT NULL,
  FOREIGN KEY (id_cliente)  REFERENCES clientes(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE mensajes (
  id_mensaje    INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  apellido      VARCHAR(50)     NOT NULL,
  nombre        VARCHAR(50)     NOT NULL,
  celular       VARCHAR(20)     NOT NULL,
  correo        VARCHAR(100)    NOT NULL,
  mensaje_texto VARCHAR(1000)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- SETTINGS (single-row tables)
-- ============================================================

CREATE TABLE empresa (
  id_empresa       INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  nombre           VARCHAR(100)    NOT NULL,
  descripcion      VARCHAR(500)    NOT NULL,
  celular          VARCHAR(20)     NOT NULL,
  correo           VARCHAR(100)    NOT NULL,
  horario          VARCHAR(100)    NOT NULL,
  quienes_somos    TEXT            NOT NULL,
  mision           TEXT            NOT NULL,
  vision           TEXT            NOT NULL,
  valores          TEXT            NOT NULL,
  id_administrador INT UNSIGNED    NOT NULL,
  FOREIGN KEY (id_administrador) REFERENCES administradores(id_administrador)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE inicio (
  id_inicio      INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  banner         VARCHAR(255)    NOT NULL,
  titulo         VARCHAR(200)    NOT NULL,
  texto          TEXT            NOT NULL,
  disenio_uno    VARCHAR(100)    NOT NULL,
  disenio_dos    VARCHAR(100)    NOT NULL,
  desarrollo_uno VARCHAR(100)    NOT NULL,
  desarrollo_dos VARCHAR(100)    NOT NULL,
  id_editor      INT UNSIGNED    NOT NULL,
  FOREIGN KEY (id_editor) REFERENCES editores(id_editor)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
