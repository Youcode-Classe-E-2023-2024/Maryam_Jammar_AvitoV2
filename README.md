# Projet de Refactorisation Avito

## Objectif

Ce projet vise à redéfinir les modèles du site d'annonces Avito. Les tâches incluent la création d'un diagramme de cas d'utilisation, d'un diagramme de classes, et l'implémentation de code PHP/MySQL pour initialiser la base de données, insérer des données via un formulaire, et lire les données à partir de la base.

## Structure du Projet

Le projet est organisé en plusieurs étapes :

1. [Diagramme de Cas d'Utilisation](#1-diagramme-de-cas-dutilisation)
2. [Diagramme de Classes](#2-diagramme-de-classes)
3. [Initialisation de la Base de Données](#3-initialisation-de-la-base-de-données)
4. [Insertion de Données](#4-insertion-de-données)
5. [Lecture de Données](#5-lecture-de-données)

## 1. Diagramme de Cas d'Utilisation

![Diagramme de Cas d'Utilisation]![image](https://github.com/Youcode-Classe-E-2023-2024/MaryamJammar-Avito/assets/132862036/914aa01a-a499-4cdb-90af-647abaa13362)


Le diagramme de cas d'utilisation représente les interactions entre les acteurs et les différentes fonctionnalités du système Avito.

Acteurs :
Utilisateur

Cas d'utilisation :
  +Consulter les annonces : Les utilisateurs peuvent consulter les annonces disponibles.
  +Ajouter une annonce : Les utilisateurs peuvent ajouter de nouvelles annonces.
  +Modifier une annonce : Les utilisateurs peuvent modifier les annonces.
  +Supprimer une annonce : Les utilisateurs peuvent supprimer les annonces.


## 2. Diagramme de Classes

![Diagramme de Classes]![image](https://github.com/Youcode-Classe-E-2023-2024/MaryamJammar-Avito/assets/132862036/9d3ec99d-c200-4c13-b676-f61bb37d9485)


Le diagramme de classes modélise les différentes entités et leurs relations dans le système Avito.

Classes :
  .Annonce
  .Utilisateur

Relations :
  Un utilisateur peut ajouter plusieurs annonces.
  Une annonce est creer par un seul utilisateur.

## 3. Initialisation de la Base de Données

### Schéma de la Base de Données

Description de la Base de Données Avito :
La base de données Avito est conçue pour stocker les informations relatives aux utilisateurs et aux annonces. Elle comporte deux tables principales : Utilisateurs et Annonces.

Table Utilisateurs :
id (INT, Clé primaire) : Identifiant unique de l'utilisateur.
username (VARCHAR(255)) : Nom de l'utilisateur.
password (VARCHAR(255)) : mot de passe de l'utilisateur.
email (VARCHAR(255)) : Adresse e-mail de l'utilisateur.
phone (int(10)) : tel de l'utilisateur.

Table Annonces :
- id (INT, Clé primaire) : Identifiant unique de l'annonce.
- titre (VARCHAR(255)) : Titre de l'annonce.
- description (VARCHAR(255)) : Description détaillée de l'annonce.
- prix (DECIMAL(10, 2)) : Prix de l'annonce.
- date_publication (date) : Date de publication de l'annonce.
- image_url (VARCHAR(255)) : URL de l'image associée à l'annonce.
- id_utilisateur (INT, Clé étrangère vers Utilisateurs) : Référence à l'utilisateur qui a créé l'annonce.

Le script annonces.sql initialise la base de données avec les tables nécessaires. 

## 4. Insertion de Données
Le formulaire d'insertion de données permet aux utilisateurs  d'ajouter de nouvelles annonces.
Pour ajouter une nouvelle annonce, suivez ces étapes :

1-Accédez à la page d'ajout d'annonces.
2-Remplissez le formulaire avec les détails de votre annonce.
3-Soumettez le formulaire.

Le formulaire d'insertion de données est disponible à l'adresse /create.php. Utilisez ce formulaire pour ajouter de nouvelles annonces à la base de données.


## 5. Lecture de Données
Le code de lecture de données permet de récupérer des annonces en fonction de certains critères.
Pour afficher la liste des annonces, suivez ces étapes :

1-Accédez à la page de liste des annonces.
2-Les annonces sont récupérées de la base de données.
3-Elles sont affichées sous forme de tableau sur la page.

Le script index.php récupère et affiche toutes les annonces de la base de données.


