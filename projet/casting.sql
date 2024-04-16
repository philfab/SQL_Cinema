INSERT INTO Personne (prenom, nom, dateNaissance, sexe) VALUES
('Quentin', 'Tarantino', '1963-03-27', 'M'),
('James', 'Cameron', '1954-08-16', 'M'),
('Christopher', 'Nolan', '1970-07-30', 'M'),
('John', 'Travolta', '1954-02-18', 'M'),
('Samuel', 'L. Jackson', '1948-12-21', 'M'),
('Leonardo', 'DiCaprio', '1974-11-11', 'M'),
('Kate', 'Winslet', '1975-10-05', 'F'),
('Brad', 'Pitt', '1963-12-18', 'M'),
('Damien', 'Chazelle', '1985-01-19', 'M'),
('John', 'McTiernan', '1951-01-08', 'M'),
('Adam', 'McKay', '1962-04-17', 'M'),
('Meryl', 'Streep', '1949-06-22', 'F');

INSERT INTO Realisateur (id_personne) VALUES
(1), (2), (3), (9), (10), (11);

INSERT INTO Film (titre, annee_sortie, duree, synopsis, note, id_realisateur) VALUES
('Pulp Fiction', 1994, 154, "L'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood.", 5, 1),
('Titanic', 1997, 195, "Reconstitution du naufrage du Titanic au cours de son voyage inaugural en 1912.", 5, 2),
('Inception', 2010, 148, "Au lieu de subtiliser un rêve, un voleur et son équipe doivent faire l'inverse : implanter une idée dans l'esprit d'un individu.", 5, 3),
('Django Unchained', 2012, 165, "Un chasseur de primes et un esclave noir s'associent pour retrouver la femme de ce dernier.", 5, 1),
('Babylon', 2022, 189, "Récit d’une ambition démesurée et d’excès les plus fous.", 5, 4),
('Une journee en enfer', 1995, 128 , "John McClane est aux prises avec un maître chanteur, facétieux et dangereux, qui dépose des bombes dans New York.", 5, 5),
('Dont Look Up', 2021, 129 , "Deux astronomes s'embarquent dans une gigantesque tournée médiatique tandis qu'une comète se dirige vers la Terre.", 5, 6),
('Jackie Brown', 1998, 150 , "Jackie Brown, une hôtesse de l'air, arrondit ses fins de mois en convoyant de l'argent.", 5, 1);

INSERT INTO Genre (libelle) VALUES
('Action'), ('Drame'), ('Science-Fiction'), ('Historique'), ('Comedie');

INSERT INTO Classifier (id_film, id_genre) VALUES
(1, 2), -- Pulp Fiction = Drame
(2, 2), -- Titanic = Drame
(3, 3), -- Inception = sf
(4, 1), -- Django Unchained = Action
(5, 4), -- Babylon = Historique
(6, 1), -- Une journee en enfer = Action
(7, 5), -- Don’t Look Up = Comedie
(8, 2); -- Jackie Brown = Drame

INSERT INTO Acteur (id_personne) VALUES
(1), (4), (5), (6), (7), (8), (12);

INSERT INTO Role (personnage) VALUES
('Vincent Vega'),
('Jules Winnfield'),
('Jack Dawson'),
('Rose DeWitt'),
('Dom Cobb'),
('Cameo'),
('Stephen'),
('Jack Conrad'),
('Janie Orlean'),
('Randall Mindy'),
('Ordell Robbie'),
('Zeus Carver');

INSERT INTO Casting (id_film, id_acteur, id_role) VALUES
(1, 2, 1), -- John Travolta = vincent vega dans Pulp Fiction
(1, 3, 2), -- Samuel L. Jackson = jules winnfield dans Pulp Fiction
(2, 4, 3), -- Leonardo DiCaprio = jack dawson dans Titanic
(2, 5, 4), -- Kate Winslet = rose deWitt dans Titanic
(3, 4, 5), -- Leonardo DiCaprio = dom cobb dans Inception
(1, 1, 6), -- Quentin Tarantino = cameo dans Pulp Fiction
(4, 3, 7), -- Samuel L. Jackson = stephen dans Django Unchained
(5, 6, 8), -- Brad Pitt = jack conrad dans Babylon
(6, 3, 12), -- Samuel L. Jackson = zeus carver dans Une journee en enfer
(7, 7, 9), -- Meryl Streep = janie orlean dans Don’t Look Up
(7, 4, 10),-- Leonardo DiCaprio = randall mindy dans Don’t Look Up
(8, 3, 11); -- Samuel L. Jackson = ordell robbie dans Jackie Brown