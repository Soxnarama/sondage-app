-- Création de la base de données
CREATE DATABASE sondage;
USE sondage;

-- Table user (utilisateurs)
CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    mail VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    domaine VARCHAR(100),
    username VARCHAR(50) UNIQUE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user' NOT NULL -- Champ pour gérer les rôles
);

-- Table theme (thèmes de sondages)
CREATE TABLE theme (
    id_theme INT AUTO_INCREMENT PRIMARY KEY,
    nom_theme VARCHAR(100) NOT NULL UNIQUE
);

-- Table modele_personnalisable (modèles de sondages personnalisables)
CREATE TABLE modele_personnalisable (
    id_model INT AUTO_INCREMENT PRIMARY KEY,
    id_theme INT NOT NULL,
    FOREIGN KEY (id_theme) REFERENCES theme(id_theme) ON DELETE CASCADE
);

-- Table sondage (sondages créés par les utilisateurs)
CREATE TABLE sondage (
    id_sondage INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    titre_sondage VARCHAR(255) NOT NULL,
    logo VARCHAR(255),
    statut ENUM('brouillon', 'publié') DEFAULT 'brouillon',
    url VARCHAR(255) UNIQUE,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

-- Table question_predefinie (questions prédéfinies pour les modèles)
CREATE TABLE question_predefinie (
    id_ques_predefinie INT AUTO_INCREMENT PRIMARY KEY,
    intitule_question TEXT NOT NULL -- Ajout d'un champ pour l'intitulé de la question
);

-- Table question (questions créées dans les sondages)
CREATE TABLE question (
    id_question INT AUTO_INCREMENT PRIMARY KEY,
    id_sondage INT NOT NULL,
    intitule_question TEXT NOT NULL,
    obligatoire BOOLEAN DEFAULT FALSE,
    typeQuestion ENUM('choix_unique', 'choix_multiple', 'texte', 'nombre') NOT NULL,
    description TEXT,
    id_ques_predefinie INT,
    FOREIGN KEY (id_sondage) REFERENCES sondage(id_sondage) ON DELETE CASCADE,
    FOREIGN KEY (id_ques_predefinie) REFERENCES question_predefinie(id_ques_predefinie) ON DELETE SET NULL
);

-- Table option_reponse (options de réponse pour les questions à choix)
CREATE TABLE option_reponse (
    id_option INT AUTO_INCREMENT PRIMARY KEY,
    intitule_option TEXT NOT NULL,
    id_question INT NOT NULL,
    FOREIGN KEY (id_question) REFERENCES question(id_question) ON DELETE CASCADE
);

-- Table reponse (réponses données par les utilisateurs)
CREATE TABLE reponse (
    id_reponse INT AUTO_INCREMENT PRIMARY KEY,
    id_question INT NOT NULL,
    id_user INT NOT NULL,
    intitule_reponse TEXT NOT NULL,
    FOREIGN KEY (id_question) REFERENCES question(id_question) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);
