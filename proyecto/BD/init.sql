

CREATE DATABASE IF NOT EXISTS proyecto;

USE proyecto;

CREATE TABLE IF NOT EXISTS proyectos (
  `nombre` varchar(32) NOT NULL,
  `fechaI` date NOT NULL,
  `fechaF` date NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


