CREATE DATABASE libras;

USE libras;

CREATE TABLE usuario (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    nome            VARCHAR(255)    NOT NULL,
    email           VARCHAR(255)    NOT NULL, 
    senha           VARCHAR(255)    NOT NULL,
    foto            VARCHAR(255),
    tipo            CHAR(1)         NOT NULL
);

CREATE TABLE licao (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    titulo          VARCHAR(50)     NOT NULL,
    posicao         INT(11)         UNIQUE,
    video           VARCHAR(255)    NOT NULL,
    artigo          VARCHAR(255)    NOT NULL,
    icone           VARCHAR(255)    NOT NULL
);

CREATE TABLE tentativa (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    status          VARCHAR(9)      NOT NULL,
    id_usuario      INT(11)         NOT NULL,
    id_licao        INT(11)         NOT NULL,

    FOREIGN KEY     (id_usuario)    REFERENCES      usuario (id),
    FOREIGN KEY     (id_licao)      REFERENCES      licao   (id)
);

CREATE TABLE questao (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    url_pergunta    VARCHAR(255)    NOT NULL,
    id_licao        INT(11)         NOT NULL,

    FOREIGN KEY     (id_licao)      REFERENCES      licao   (id)
);

CREATE TABLE resposta (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    texto           VARCHAR(255)    NOT NULL,
    valor           BOOLEAN         NOT NULL,
    id_questao      INT(11)         NOT NULL,

    FOREIGN KEY     (id_questao)    REFERENCES      questao   (id)
);


