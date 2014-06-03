BEGIN;
CREATE TABLE "edificio" (
    "id" integer NOT NULL PRIMARY KEY,
    "nome" varchar(200) NOT NULL,
    "andar_inicial" integer NOT NULL,
    "andar_final" integer NOT NULL
)
;
CREATE TABLE "andar" (
    "id" integer NOT NULL PRIMARY KEY,
    "numAndar" integer NOT NULL,
    "planta" varchar(200) NOT NULL,
    "edificio_id" integer NOT NULL REFERENCES "edificio" ("id")
)
;
CREATE TABLE "sala" (
    "id" integer NOT NULL PRIMARY KEY,
    "nome" varchar(200) NOT NULL,
    "posicao_x" real NOT NULL,
    "posicao_y" real NOT NULL,
    "contorno" varchar (200) NOT NULL,
    "andar_id" integer NOT NULL REFERENCES "andar" ("id")
)
;
CREATE TABLE "modulo" (
    "id" integer NOT NULL PRIMARY KEY,
    "sala_id" integer NOT NULL REFERENCES "sala" ("id")
)
;
CREATE TABLE "leituracritica" (
    "id" integer NOT NULL PRIMARY KEY,
    "modulo_id" integer NOT NULL REFERENCES "modulo" ("id"),
    "interesse" varchar(200) NOT NULL,
    "valor" varchar(200) NOT NULL,
    "criado" datetime NOT NULL
)
;
CREATE TABLE "estado" (
    "id" integer NOT NULL PRIMARY KEY,
    "modulo_id" integer NOT NULL REFERENCES "modulo" ("id"),
    "nome" varchar(200) NOT NULL,
    "criado" datetime NOT NULL
)
;
CREATE TABLE "condicaobool" (
    "id" integer NOT NULL PRIMARY KEY,
    "sala_id" integer NOT NULL REFERENCES "sala" ("id"),
    "tipo" varchar(200) NOT NULL,
    "interesse" varchar(200) NOT NULL,
    "valor_critico" bool NOT NULL
)
;
CREATE TABLE "condicaorange" (
    "id" integer NOT NULL PRIMARY KEY,
    "sala_id" integer NOT NULL REFERENCES "sala" ("id"),
    "tipo" varchar(200) NOT NULL,
    "interesse" varchar(200) NOT NULL,
    "min" real NOT NULL,
    "max" real NOT NULL
)
;

COMMIT;
