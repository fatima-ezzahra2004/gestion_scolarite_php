CREATE DATABASE gestion_scolarite
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE gestion_scolarite;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    role ENUM(
        'admin',
        'agent',
        'enseignant',
        'etudiant',
        'parent'
    ) NOT NULL DEFAULT 'agent',

    reset_token VARCHAR(255),
    token_expire DATETIME,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE employes (
    id_employe INT AUTO_INCREMENT PRIMARY KEY,

    nom_fr VARCHAR(100) NOT NULL,
    prenom_fr VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100),
    prenom_ar VARCHAR(100),

    cin VARCHAR(20) NOT NULL UNIQUE,
    sexe ENUM('M','F'),

    date_naissance DATE,
    date_embauche DATE,

    id_categorie INT NOT NULL,

    pays VARCHAR(100),
    telephone VARCHAR(20),
    whatsapp VARCHAR(20),
    email VARCHAR(120) UNIQUE,

    adresse VARCHAR(255),
    salaire DECIMAL(10,2),

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_employe_categorie
        FOREIGN KEY (id_categorie)
        REFERENCES categories_employes(id_categorie)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);CREATE TABLE categories_employes (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100),
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);CREATE TABLE rendez_vous (
    id_rdv INT AUTO_INCREMENT PRIMARY KEY,

    id_prospect INT NOT NULL,
    id_employe INT NOT NULL,

    titre VARCHAR(150) NULL,
    type_rdv ENUM('Demande d information','Consultation') NOT NULL,
    date_rdv DATE NOT NULL,
    heure_rdv TIME NOT NULL,

    statut ENUM('planifié','traité','annulé') DEFAULT 'planifié',
    notes TEXT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_rdv_prospect
        FOREIGN KEY (id_prospect) REFERENCES prospects(id_prospect)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_rdv_employe
        FOREIGN KEY (id_employe) REFERENCES employes(id_employe)
        ON DELETE RESTRICT ON UPDATE CASCADE
);CREATE TABLE prospects (
    id_prospect INT AUTO_INCREMENT PRIMARY KEY,

    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100) NULL,
    prenom_ar VARCHAR(100) NULL,

    telephone VARCHAR(20) NOT NULL,
    whatsapp VARCHAR(20) NULL,
    email VARCHAR(120) NULL UNIQUE,
    cin VARCHAR(20) NULL UNIQUE,

    adresse VARCHAR(255) NULL,
    ville VARCHAR(100) NULL,
    ville_ar VARCHAR(100) NULL,

    genre ENUM('M','F') NOT NULL,
    civilite ENUM('Monsieur','Madame','Mademoiselle') NOT NULL,
    date_naissance DATE NULL,
    nationalite VARCHAR(100) NULL,

    id_tuteur INT NULL,
    id_source INT NULL,
    id_canal INT NULL,
    id_etat INT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_prospect_tuteur
        FOREIGN KEY (id_tuteur) REFERENCES tuteurs(id_tuteur)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_prospect_source
        FOREIGN KEY (id_source) REFERENCES sources(id_source)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_prospect_canal
        FOREIGN KEY (id_canal) REFERENCES canaux(id_canal)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_prospect_etat
        FOREIGN KEY (id_etat) REFERENCES etats_prospect(id_etat)
        ON DELETE SET NULL ON UPDATE CASCADE
);CREATE TABLE etats_prospect (
    id_etat INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    nom_ar VARCHAR(100) NULL,
    statut BOOLEAN DEFAULT TRUE,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);CREATE TABLE canaux (
    id_canal INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    nom_ar VARCHAR(100) NULL,
    statut BOOLEAN DEFAULT TRUE,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);CREATE TABLE sources (
    id_source INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    nom_ar VARCHAR(100) NULL,
    statut BOOLEAN DEFAULT TRUE,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);CREATE TABLE tuteurs (
    id_tuteur INT AUTO_INCREMENT PRIMARY KEY,

    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100) NULL,
    prenom_ar VARCHAR(100) NULL,

    cin VARCHAR(20) NOT NULL UNIQUE,
    telephone VARCHAR(20) NULL,
    whatsapp VARCHAR(20) NULL,
    email VARCHAR(120) NULL,
    lien_parente VARCHAR(50) NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); 

📘 TABLE : matieres
CREATE TABLE matieres (
    id_matiere INT AUTO_INCREMENT PRIMARY KEY,
    nom_fr VARCHAR(150) NOT NULL,
    nom_ar VARCHAR(150),
    description TEXT,
    statut BOOLEAN DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

📘 TABLE : formations
CREATE TABLE formations (
    id_formation INT AUTO_INCREMENT PRIMARY KEY,
    type_formation ENUM(
        'Préscolaire','Primaire','Collège','Lycée',
        'Enseignement supérieur','Professionnelle',
        'Licence','Master','Certificat','Formation continue'
    ) NOT NULL,
    nom VARCHAR(150) NOT NULL,
    date_debut DATE,
    date_fin DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

📘 TABLE : groupes
CREATE TABLE groupes (
    id_groupe INT AUTO_INCREMENT PRIMARY KEY,
    id_formation INT NOT NULL,
    nom_fr VARCHAR(150),
    nom_ar VARCHAR(150),
    effectif_max INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_formation) REFERENCES formations(id_formation)
        ON DELETE CASCADE
);

📘 TABLE : etudiants
CREATE TABLE etudiants (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100),
    prenom_ar VARCHAR(100),
    telephone VARCHAR(20),
    whatsapp VARCHAR(20),
    email VARCHAR(120) UNIQUE,
    cin VARCHAR(20) UNIQUE,
    adresse VARCHAR(255),
    ville VARCHAR(100),
    ville_ar VARCHAR(100),
    genre ENUM('M','F') NOT NULL,
    civilite ENUM('Monsieur','Madame','Mademoiselle') NOT NULL,
    date_naissance DATE,
    nationalite VARCHAR(100),
    id_tuteur INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_tuteur) REFERENCES tuteurs(id_tuteur)
        ON DELETE SET NULL
);

📘 TABLE : formation_matiere
CREATE TABLE formation_matiere (
    id_formation_matiere INT AUTO_INCREMENT PRIMARY KEY,
    id_formation INT NOT NULL,
    id_matiere INT NOT NULL,
    volume_horaire INT,
    coefficient DECIMAL(5,2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_formation) REFERENCES formations(id_formation)
        ON DELETE CASCADE,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere)
        ON DELETE CASCADE,

    UNIQUE (id_formation, id_matiere)
);

📘 TABLE : enseignant_matiere
CREATE TABLE enseignant_matiere (
    id_enseignant_matiere INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT NOT NULL,
    id_matiere INT NOT NULL,
    id_groupe INT,
    date_debut DATE,
    date_fin DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_employe) REFERENCES employes(id_employe)
        ON DELETE CASCADE,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere)
        ON DELETE CASCADE,
    FOREIGN KEY (id_groupe) REFERENCES groupes(id_groupe)
        ON DELETE SET NULL,

    UNIQUE (id_employe, id_matiere, id_groupe)
);

📘 TABLE : inscriptions
CREATE TABLE inscriptions (
    id_inscription INT AUTO_INCREMENT PRIMARY KEY,
    id_etudiant INT NOT NULL,
    id_formation INT NOT NULL,
    id_groupe INT NOT NULL,
    date_inscription DATE NOT NULL,
    statut ENUM('active','abandonnée','archivée') DEFAULT 'active',
    raison_abandon TEXT,
    raison_archivage TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant)
        ON DELETE CASCADE,
    FOREIGN KEY (id_formation) REFERENCES formations(id_formation)
        ON DELETE CASCADE,
    FOREIGN KEY (id_groupe) REFERENCES groupes(id_groupe)
        ON DELETE CASCADE,

    UNIQUE (id_etudiant, id_formation)
);