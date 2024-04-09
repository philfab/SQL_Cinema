-- a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur 
    SELECT f.titre, f.annee_sortie, SEC_TO_TIME(f.duree * 60) AS duree_film, p.prenom, p.nom
	FROM Film f
	INNER JOIN Realisateur r ON f.id_realisateur = r.id_realisateur
	INNER JOIN Personne p ON r.id_personne = p.id_personne
	WHERE f.id_film = 1;

-- b. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)
	SELECT f.titre, f.annee_sortie, SEC_TO_TIME(duree * 60) AS duree_film
	FROM Film f
	WHERE f.duree > 135
	ORDER BY f.duree DESC;

-- c. Liste des films d’un réalisateur (en précisant l’année de sortie) 
    SELECT f.titre, f.annee_sortie
    FROM Film f
    INNER JOIN Realisateur r ON f.id_realisateur = r.id_realisateur
    INNER JOIN Personne p ON r.id_personne = p.id_personne
    WHERE p.prenom ='Quentin' AND p.nom = 'Tarantino';

-- d. Nombre de films par genre (classés dans l’ordre décroissant)
    SELECT g.libelle, COUNT(c.id_film) AS nombre_films
    FROM Genre g
    INNER JOIN classifier c ON g.id_genre = c.id_genre
    GROUP BY g.id_genre
    ORDER BY nombre_films DESC;

-- e. Nombre de films par réalisateur (classés dans l’ordre décroissant)
    SELECT p.prenom, p.nom, COUNT(f.id_film) AS nombre_films
    FROM Personne p
    INNER JOIN Realisateur r ON p.id_personne = r.id_personne
    INNER JOIN Film f ON r.id_realisateur = f.id_realisateur
    GROUP BY p.id_personne
    ORDER BY nombre_films DESC;

-- f. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
    SELECT p.prenom, p.nom, p.sexe
    FROM Personne p
    INNER JOIN Acteur a ON p.id_personne = a.id_personne
    INNER JOIN Casting c ON a.id_acteur = c.id_acteur
    WHERE c.id_film = 1;

-- g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)
    SELECT f.titre, r.personnage, f.annee_sortie
    FROM Casting c
    INNER JOIN Film f ON c.id_film = f.id_film
    INNER JOIN Role r ON c.id_role = r.id_role
    WHERE c.id_acteur = 3
    ORDER BY f.annee_sortie DESC;

-- h. Liste des personnes qui sont à la fois acteurs et réalisateurs
    SELECT p.prenom, p.nom
    FROM Personne p
    INNER JOIN Acteur a ON p.id_personne = a.id_personne
    INNER JOIN Realisateur r ON p.id_personne = r.id_personne;

-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
    SELECT f.titre, f.annee_sortie
    FROM Film f
    WHERE f.annee_sortie >= YEAR(CURDATE()) - 5
    ORDER BY f.annee_sortie DESC;

-- j. Nombre d’hommes et de femmes parmi les acteurs
    SELECT p.sexe, COUNT(*) AS nombre
    FROM Personne p
    INNER JOIN Acteur a ON p.id_personne = a.id_personne
    GROUP BY p.sexe;

-- k.Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
    SELECT p.prenom, p.nom, TIMESTAMPDIFF(YEAR, p.dateNaissance, CURDATE()) AS age
    FROM Personne p
    INNER JOIN Acteur a ON p.id_personne = a.id_personne
    WHERE TIMESTAMPDIFF(YEAR, p.dateNaissance, CURDATE()) > 50;


--l Acteurs ayant joué dans 3 films ou plus
    SELECT p.prenom, p.nom
    FROM Personne p
    INNER JOIN Acteur a ON p.id_personne = a.id_personne
    INNER JOIN Casting c ON a.id_acteur = c.id_acteur
    GROUP BY a.id_acteur
    HAVING COUNT(c.id_film) >= 3;
