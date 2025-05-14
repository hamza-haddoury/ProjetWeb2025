# 🏆 QSport – Quiz Sportif Multijoueur

## 🎓 Membres du groupe

- KHAOUDI Imad 
- HADDOURY Mohamed Hamza

---

## 📄 Présentation du projet

**QSport** est un site web interactif qui propose aux utilisateurs de tester leurs connaissances sportives à travers des quizz minutés dans différentes catégories.

L'utilisateur peut accéder à différentes fonctionnalités selon qu’il soit connecté ou non.

---

## 🛠️ Technologies utilisées

Ce projet met en œuvre les technologies étudiées pendant le cours :

- **HTML / CSS** : structure et design responsive & professionnel  
- **JavaScript** : gestion des événements, manipulation du DOM, minuterie, JSON  
- **PHP** : gestion des sessions, génération de contenu dynamique, lecture/écriture de fichiers utilisateurs  
- **AJAX (fetch)** : récupération asynchrone des questions  
- **CSV** : stockage local des utilisateurs (`users.csv`)  

---

## 📁 Structure du projet

├── index.php # Page d'accueil et point de départ du quizz
├── login.php # Formulaire de connexion
├── register.php # Formulaire d'inscription
├── access.php # Traitement de la connexion
├── logout.php # Déconnexion
├── users.inc.php # Fonctions liées à la gestion des utilisateurs
├── users.csv # Fichier des utilisateurs (login, mdp, email)
├── quizz.json # Base de données des questions
├── requirements.bsh # Script bash de permission sur users.csv
├── css/
│ └── styles1.css
│ └── styles2.css # Feuilles de styles
├── images/ # Images des catégories
└── README.md # Ce fichier


---

## Préparation du projet

Avant de lancer le site, exécutez le fichier `requirements.bsh` pour attribuer les bonnes permissions à `users.csv` :

```bash
bash requirements.bsh
```

Contenu du script :
```
chmod 771 users.csv
```
Cela permet à l’application PHP d’écrire dans le fichier lors de l'enregistrement et de la connexion des utilisateurs.
Fonctionnalités principales


## Connexion / Inscription

Si l’utilisateur n’est pas connecté, il est redirigé automatiquement vers login.php.
Possibilité de créer un nouveau compte via register.php.
Les données sont enregistrées dans users.csv au format :

```
username,password,email
```


Lancer un quiz
Une fois connecté, l'utilisateur peut choisir une catégorie parmi :
Basketball
Boxe
Football
Formule 1
Rugby
Jeux Olympiques

Chaque partie comprend :
10 questions aléatoires
20 secondes par question
Passage automatique à la question suivante si le temps expire

## 🏁 Fin de quiz
Affichage du score final
Option de rejouer (rechargement de la page)

## 🧪 Interactions & restrictions

❌ Accès non autorisé à une catégorie sans connexion → redirection vers login.php
❌ Réinscription avec un nom d’utilisateur existant → message d’erreur
❌ Mots de passe non identiques à l’inscription → blocage avec message d’erreur

## Démonstration vidéo
👉 Lien vers la vidéo YouTube :
🔗 

## 🧩 Diagramme d’architecture
👉 Lien vers le diagramme 
🔗 
👉 Lien vers le dépôt GitHub
🔗 


## Ce projet répond aux objectifs suivants :

Application des notions de base HTML / CSS / JS
Utilisation de PHP côté serveur avec gestion de sessions
Interaction dynamique via AJAX
Stockage local avec fichiers CSV
Interface claire, cohérente et responsive
Vérification des cas d’usage bloquants (connexion, erreurs, redirections)
