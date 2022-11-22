CREATE SCHEMA contatos;
USE contatos;

CREATE TABLE contatos_crud (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(45) NOT NULL,
    telefone INT(11) NOT NULL,
    email VARCHAR(45) NOT NULL,
    data_nasc DATE NOT NULL,
    idade INT(255) NOT NULL,
    social VARCHAR(45) NOT NULL,
    parente VARCHAR(3) NOT NULL,
    sexo VARCHAR(1) NOT NULL,
    onde VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    hobby VARCHAR(100) NOT NULL
);
