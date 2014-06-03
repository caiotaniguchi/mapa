BEGIN;
CREATE TABLE IF NOT EXISTS modulo (
    id int NOT NULL PRIMARY KEY,
    sala_id int NOT NULL REFERENCES sala (id)
)
;
CREATE TABLE IF NOT EXISTS estado (
    id int NOT NULL PRIMARY KEY,
    modulo_id int NOT NULL REFERENCES modulo (id),
    nome varchar(200) NOT NULL,
    criado datetime NOT NULL
)
;
COMMIT;


