------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS libros CASCADE;

CREATE TABLE libros
(
      id       bigserial    PRIMARY KEY
    , isbn     varchar(13)  NOT NULL UNIQUE
    , titulo   varchar(255) NOT NULL
    , num_pags int          CONSTRAINT ck_libros_num_pags_positivo
                            CHECK (num_pags >= 0)
);

INSERT INTO libros (isbn, titulo, num_pags)
VALUES ('1111111111111', 'Aaa', 111)
     , ('2222222222222', 'Eee', 112);