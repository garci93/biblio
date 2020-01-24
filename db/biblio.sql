------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
    id    bigserial    PRIMARY KEY
  , denom varchar(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS libros CASCADE;

CREATE TABLE libros
(
    id        bigserial    PRIMARY KEY
  , isbn      varchar(13)  NOT NULL UNIQUE
  , titulo    varchar(255) NOT NULL
  , num_pags  int          CONSTRAINT ck_libros_num_pags_no_negativo
                           CHECK (num_pags >= 0)
  , genero_id bigint       NOT NULL REFERENCES generos (id)
);

INSERT INTO generos (denom)
VALUES ('Informática')
     , ('Contabilidad')
     , ('Suspense')
     , ('Terror')
     , ('Fantasía');

INSERT INTO libros (isbn, titulo, num_pags, genero_id)
VALUES ('1111111111111', 'El nombre de la rosa', 760, 3)
     , ('2222222222222', 'Cómo aprender PHP en 24 horas', 12, 1);
