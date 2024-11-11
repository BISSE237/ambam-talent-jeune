-- Créer la base de données
CREATE DATABASE concours_beaute;

-- Utiliser la base de données
USE concours_beaute;

-- Créer la table pour stocker les informations des candidats
CREATE TABLE candidats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);