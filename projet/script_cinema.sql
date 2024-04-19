CREATE DATABASE IF NOT EXISTS Cinema;
USE Cinema;

CREATE TABLE IF NOT EXISTS Personne (
    id_personne INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50),
    nom VARCHAR(50),
    dateNaissance DATE,
    sexe CHAR(1),
    photo VARCHAR(255) DEFAULT 'photo.jpg'
);

CREATE TABLE IF NOT EXISTS Realisateur (
    id_realisateur INT AUTO_INCREMENT PRIMARY KEY,
    id_personne INT,
    FOREIGN KEY (id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE IF NOT EXISTS Genre (
    id_genre INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Film (
    id_film INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    annee_sortie INT,
    duree INT,
    synopsis TEXT,
    note INT,
    affiche VARCHAR(255) DEFAULT 'affiche.jpg',
    id_realisateur INT,
    FOREIGN KEY (id_realisateur) REFERENCES Realisateur(id_realisateur)
);

CREATE TABLE IF NOT EXISTS Classifier (
    id_film INT,
    id_genre INT,
    PRIMARY KEY (id_film, id_genre),
    FOREIGN KEY (id_film) REFERENCES Film(id_film),
    FOREIGN KEY (id_genre) REFERENCES Genre(id_genre)
);

CREATE TABLE IF NOT EXISTS Acteur (
    id_acteur INT AUTO_INCREMENT PRIMARY KEY,
    id_personne INT,
    FOREIGN KEY (id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE IF NOT EXISTS Role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    personnage VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Casting (
    id_film INT,
    id_acteur INT,
    id_role INT,
    PRIMARY KEY (id_film, id_acteur, id_role),
    FOREIGN KEY (id_film) REFERENCES Film(id_film),
    FOREIGN KEY (id_acteur) REFERENCES Acteur(id_acteur),
    FOREIGN KEY (id_role) REFERENCES Role(id_role)
);
