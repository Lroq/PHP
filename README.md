# 📄 Projet CV/Portfolio en PHP

Bienvenue sur mon projet de CV en ligne ! Ce site web en PHP permet de créer un CV complet et interactif. J'y ai intégré plusieurs fonctionnalités pour que les utilisateurs puissent voir et modifier leur CV, et voir leur portfolio de projets de manière dynamique.

## 🎯 Objectifs
L'objectif est de présenter un CV/Portfolio interactif en suivant les bonnes pratiques PHP. J'ai structuré ce site pour qu'il soit facilement navigable et qu'il offre des options de personnalisation.

## 🌐 Fonctionnalités du Site

### 1. Pages principales
Chaque page répond à un besoin spécifique :
- **Accueil** : page d'introduction statique.
- **Contact** : formulaire de contact.
- **CV** : présentation du parcours, des expériences et des compétences, avec option d'édition.
- **Projets** : liste des projets.
- **Connexion/Déconnexion** : pour gérer un accès sécurisé.
- **Profil** : page personnelle modifiable par l'utilisateur.

### 2. Fonctionnalités clés

#### Contact
- **Formulaire de contact** pour envoyer des messages directement.

#### Authentification
- **Connexion/Déconnexion** sécurisées pour accéder aux fonctions avancées.
- Ajout d’utilisateurs avec des rôles spécifiques.

#### CV
- **Visualisation et édition** du CV pour les utilisateurs connectés.

#### Projets / Portfolio
- Ajout et gestion des projets, visibles dans un portfolio.

#### Profil
- Modification des informations personnelles par l’utilisateur connecté.

## ⚙️ Structure des Données

Les informations sont organisées autour de trois principaux objets :
- **Utilisateur** : contient l'email, le prénom, le nom, le mot de passe et le rôle.
- **CV** : regroupe le titre, la description, les compétences (titre, description, années d'expérience), les expériences professionnelles (titre, dates) et la formation (établissement, dates).
- **Projet** : chaque projet comporte un titre, une description et une image.

## 🚀 Lancement du Projet

Pour utiliser ce site en local :

1. Ouvrez **Docker Desktop**.
2. Dans un terminal, démarrez le site en lançant la commande :

```bash
docker compose up
```

3. Accédez au site via l'URL suivante :
```bash
http://127.0.0.1
```

