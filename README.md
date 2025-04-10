# 🛒 Projet E-commerce - MH Multirayons

Bienvenue sur le dépôt GitHub de notre site e-commerce **MH Multirayons**, spécialisé dans la vente d'électroménagers : réfrigérateurs, congélateurs, LED, plaques de cuisson, fours, et plus encore.

## 👥 Membres de l’équipe

- **Sayeh Wiem**
- **Aya Telmoudi**

## 📹 Démonstration

Une **vidéo de démonstration du projet**.  
👉 [Voir la vidéo](https://drive.google.com/file/d/1TYD_i2s6OmA-DoGxmwHc9e68P7wXjM6P/view?usp=drive_link)

## 🗂️ Structure du Projet

Le projet suit une architecture **MVC** et utilise le **design pattern Singleton**.


## 💻 Technologies utilisées

- **PHP** (version 8.x)
- **MySQL** (via phpMyAdmin)
- **HTML/CSS/JavaScript**
- **WAMP Server**
- **GitHub** pour la gestion de version

## 📦 Base de Données

Nom de la base : `project-societemh`

### Tables principales :

- `users` : infos des clients et admins
- `products` : détails des produits
- `categories` : catégories de produits
- `orders` : commandes passées
- `order_items` : détails des articles commandés
- `cart` : panier des utilisateurs
- `reviews` : avis clients
- `admins_logs` : actions des administrateurs

📥 Le fichier d’extraction SQL est disponible dans le dépôt : [`project-societemh.sql`](./project-societemh (1).sql)

> ℹ️ Le script inclut la structure complète de la base + des données de test + des triggers comme `update_order_total_price`.

## ✅ Fonctionnalités principales

### 👨‍💻 Côté Administrateur
- Authentification administrateur
- Gestion des produits (CRUD)
- Suivi des commandes des clients
- Gestion des catégories
- Logs d'activités des admins

### 🧑‍💼 Côté Client
- Parcourir le catalogue
- Ajouter des produits au panier
- Gestion du panier (modifier/supprimer)
- Passer une commande
- Suivi du statut de commande
- Authentification client

## 🔐 Authentification
- Redirection vers la page de login lors du passage à la caisse si l'utilisateur n'est pas connecté
- Validation des utilisateurs depuis la base de données (via PDO)

## 🛠️ Outils & Bonnes pratiques

- Gestion de projet via **Git** (branches individuelles puis merge dans `master`)
- Chaque développeur travaille sur une branche séparée (`wiem`, `[ta-branche]`)
- Conventions de nommage et commentaires clairs
- Respect du modèle MVC pour une séparation claire des responsabilités

## 📌 TODOs / Prochaines étapes

- ✔️ Finaliser le système de commandes
- ✔️ Ajout des triggers SQL pour mise à jour automatique du prix total
- ☐ Implémenter l’envoi d’email après commande
- ☐ Optimisation du CSS / UX
- ☐ Implémenter la gestion des avis clients


## 📞 Contact

Pour toute question ou retour :

- 📧 [aya.telmoudi@enis.tn](mailto:votre.email@example.com)

---

