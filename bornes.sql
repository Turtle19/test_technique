-- commande pour installer la table sur postgreSql
-- psql -h webtp.fil.univ-lille1.fr -U dialloai -f test_technique.sql

CREATE TABLE bornes (
    id numeric not null,
    power character varying(15) not null,
    num_borne numeric not null,
    timestamp timestamp not null
);

ALTER TABLE ONLY bornes
    ADD CONSTRAINT bornes_pkey PRIMARY KEY (id);
