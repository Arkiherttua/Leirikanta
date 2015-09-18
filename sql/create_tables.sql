CREATE TABLE Leiripaikka(
    id SERIAL PRIMARY KEY,
    paikannimi varchar(50) NOT NULL,
    sijainti varchar(70) NOT NULL,
    nettisivu varchar(70),
    kokki varchar(50),
    kuvaus varchar(100)
);

CREATE TABLE Leiri(
    id SERIAL PRIMARY KEY,
    leirinnimi varchar(50) NOT NULL,
    alkupv DATE,
    loppupv DATE,
    leirilaistenIka varchar(50),
    leiripaikka_id INTEGER REFERENCES Leiripaikka(id)
);

CREATE TABLE Kayttaja(
    id SERIAL PRIMARY KEY,
    tunnus varchar(50) NOT NULL,
    password varchar(50) NOT NULL, --emt onko password jotenkin taikasana niin olkoon enkuksi
    email varchar(50) NOT NULL,
    syntymaaika DATE NOT NULL,
    onkoJohtaja boolean DEFAULT FALSE
);

CREATE TABLE Hakemus(
    id SERIAL PRIMARY KEY,
    kayttaja_id INTEGER REFERENCES Kayttaja(id),
    kokemus text,
    vapaaKuvaus text
);

CREATE TABLE Leiriohjaajuus(
    id SERIAL PRIMARY KEY,
    hakemus_id INTEGER REFERENCES Hakemus(id),
    leiri_id INTEGER REFERENCES Leiri(id),
    onkoValittu BOOLEAN DEFAULT FALSE,
    onkoJohtaja BOOLEAN DEFAULT FALSE
);