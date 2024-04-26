INSERT INTO Personne (prenom, nom, dateNaissance, sexe, photo) VALUES
('Quentin', 'Tarantino', '1963-03-27', 'M',"https://fr.web.img6.acsta.net/c_310_420/pictures/19/05/22/10/33/5945451.jpg"),
('James', 'Cameron', '1954-08-16', 'M',"https://fr.web.img6.acsta.net/c_310_420/pictures/22/12/07/15/19/3602099.jpg"),
('Christopher', 'Nolan', '1970-07-30', 'M',"https://fr.web.img5.acsta.net/c_310_420/pictures/14/10/30/10/59/215487.jpg"),
('John', 'Travolta', '1954-02-18', 'M',"https://fr.web.img6.acsta.net/c_310_420/pictures/18/05/15/15/20/5209194.jpg"),
('Samuel', 'L. Jackson', '1948-12-21', 'M',"https://fr.web.img3.acsta.net/c_310_420/pictures/15/07/27/12/24/354255.jpg"),
('Leonardo', 'DiCaprio', '1974-11-11', 'M',"https://fr.web.img3.acsta.net/c_310_420/pictures/15/06/24/14/36/054680.jpg"),
('Kate', 'Winslet', '1975-10-05', 'F',"https://fr.web.img3.acsta.net/c_310_420/pictures/15/09/15/10/01/065591.jpg"),
('Brad', 'Pitt', '1963-12-18', 'M',"https://fr.web.img6.acsta.net/c_310_420/pictures/20/02/10/10/37/1374948.jpg"),
('Damien', 'Chazelle', '1985-01-19', 'M',"https://fr.web.img3.acsta.net/c_310_420/pictures/17/01/10/11/57/215425.jpg"),
('John', 'McTiernan', '1951-01-08', 'M',"https://fr.web.img4.acsta.net/c_310_420/pictures/18/09/17/17/12/5258047.jpg"),
('Adam', 'McKay', '1962-04-17', 'M',"https://fr.web.img3.acsta.net/c_310_420/pictures/15/11/24/10/41/165155.jpg"),
('Meryl', 'Streep', '1949-06-22', 'F',"https://fr.web.img2.acsta.net/c_310_420/pictures/17/01/10/13/53/476324.jpg");

INSERT INTO Realisateur (id_personne) VALUES
(1), (2), (3), (9), (10), (11);

INSERT INTO Film (titre, annee_sortie, duree, synopsis, note, id_realisateur, affiche) VALUES
('Pulp Fiction', 1994, 154, "L'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood.", 5, 1, "https://fr.web.img2.acsta.net/c_310_420/medias/nmedia/18/36/02/52/18846059.jpg"),
('Titanic', 1997, 195, "Reconstitution du naufrage du Titanic au cours de son voyage inaugural en 1912.", 5, 2, "https://fr.web.img6.acsta.net/c_310_420/pictures/23/01/10/16/06/0622119.jpg"),
('Inception', 2010, 148, "Au lieu de subtiliser un rêve, un voleur et son équipe doivent faire l'inverse : implanter une idée dans l'esprit d'un individu.", 5, 3,"https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/72/34/14/19476654.jpg"),
('Django Unchained', 2012, 165, "Un chasseur de primes et un esclave noir s'associent pour retrouver la femme de ce dernier.", 5, 1,"https://fr.web.img4.acsta.net/c_310_420/medias/nmedia/18/90/08/59/20366454.jpg"),
('Babylon', 2022, 189, "Récit d’une ambition démesurée et d’excès les plus fous.", 5, 4,"https://fr.web.img5.acsta.net/c_310_420/pictures/22/12/02/16/03/2536613.jpg"),
('Une journee en enfer', 1995, 128 , "John McClane est aux prises avec un maître chanteur, facétieux et dangereux, qui dépose des bombes dans New York.", 5, 5,"https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/36/04/16/18686568.jpg"),
('Dont Look Up', 2021, 129 , "Deux astronomes s'embarquent dans une gigantesque tournée médiatique tandis qu'une comète se dirige vers la Terre.", 5, 6,"https://fr.web.img6.acsta.net/c_310_420/pictures/21/11/16/17/11/5656957.jpg"),
('Jackie Brown', 1998, 150 , "Jackie Brown, une hôtesse de l'air, arrondit ses fins de mois en convoyant de l'argent.", 5, 1,"https://fr.web.img4.acsta.net/c_310_420/medias/04/05/00/040500_af.jpg");

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