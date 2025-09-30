-- Création de la base
CREATE DATABASE IF NOT EXISTS moduleconnexion DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE moduleconnexion;

-- Création de la table utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL UNIQUE,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion de l'utilisateur admin
-- Mot de passe : admin (hash Argon2id)
INSERT INTO utilisateurs (login, prenom, nom, password)
VALUES ('admin', 'admin', 'admin', 
        '$argon2id$v=19$m=65536,t=4,p=1$7StYFje+eYYZbUOLwaY+lg$0eBDB+Jp7G5XfYF6LJKnk9bE2y4Gl0wBMXO9wQb3b8o');