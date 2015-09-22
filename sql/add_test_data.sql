INSERT INTO Leiripaikka (paikannimi, sijainti, nettisivu, kuvaus) VALUES ('Saari', 'Suomi', 'google.fi', 'Kiva paikka');
INSERT INTO Leiripaikka (paikannimi, sijainti, nettisivu, kokki, kuvaus) VALUES ('Järvenranta', 'Suomi', 'google.fi', 'palkataan kaksi kokkia', 'Oikein kiva paikka');
INSERT INTO Leiripaikka (paikannimi, sijainti, nettisivu, kokki, kuvaus) VALUES ('Helsinki', 'Etelä-Suomi', 'google.fi', 'palkataan yksi kokki', 'Mukava mesta tämäkin');

INSERT INTO Leiri (leirinnimi, leirilaistenIka, leiripaikka_id) VALUES ('Saaren alkukesän lastenleiri', '7-12 v', '1');
INSERT INTO Leiri (leirinnimi, alkupv, loppupv, leirilaistenIka, leiripaikka_id) VALUES ('Saaren loppukesän lastenleiri', '2015-08-01', '2015-08-06', '7-12 v', '1');
INSERT INTO Leiri (leirinnimi, alkupv, loppupv, leirilaistenIka, leiripaikka_id) VALUES ('Päiväleiri', '2015-08-01', '2015-08-06', '7-10 v', '3');

INSERT INTO Kayttaja (tunnus, nimi, salasana, email, syntymaaika) VALUES ('user', 'Minttupetteri', 'salasana', 'user@hotmail.com', '1990-01-01');
