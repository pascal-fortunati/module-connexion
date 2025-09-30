# Module Connexion

**Module Connexion** est une application PHP simple permettant la gestion des utilisateurs : inscription, connexion, profil, administration et thèmes Bootstrap avec Bootswatch.

---

## 📌 Fonctionnalités

- ✅ Authentification utilisateur (login / logout)
- ✅ Inscription avec validation et hashage des mots de passe
- ✅ Gestion de profil (modification login, prénom, nom et mot de passe)
- ✅ Protection CSRF pour tous les formulaires
- ✅ Page Admin pour gérer les utilisateurs (accessible uniquement à l'admin)
- ✅ Layout responsive avec card "boxed"
- ✅ Thèmes Bootstrap via Bootswatch avec sélection dynamique
- ✅ Bloc "Démo" sur la page de connexion
- ✅ Routing simple basé sur `?p=` pour GET et POST

---

## 🛠️ Prérequis

- PHP >= 7.4
- MySQL / MariaDB
- Serveur local type Laragon, XAMPP, WAMP, ou Apache/Nginx
- Composer (pour autoloading, si besoin)

---

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-utilisateur/module-connexion.git
cd module-connexion
```

### 2. Copier le projet dans votre serveur local

Placer le dossier dans `www` ou `htdocs` selon votre environnement.

### 3. Créer la base de données MySQL

```sql
CREATE DATABASE moduleconnexion CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### 4. Importer la table utilisateurs

```sql
CREATE TABLE `utilisateurs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `nom` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 5. Créer un compte admin (optionnel)

```sql
INSERT INTO utilisateurs (login, prenom, nom, password)
VALUES ('admin', 'Admin', 'Système', '$argon2id$v=19$m=65536,t=4,p=1$SALT$HASH');
```

> **Note** : Remplacez `$argon2id$...` par un hash généré avec `password_hash('admin', PASSWORD_ARGON2ID)`.

### 6. Configurer le fichier `config/config.php`

```php
<?php
return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=moduleconnexion;charset=utf8mb4',
        'user' => 'root',
        'pass' => '',
    ],
    'base_url' => '/moduleconnexion/public',
];
```

## 🌈 Thèmes

Le projet utilise **Bootswatch** pour changer facilement le thème de l'application.

**Thèmes disponibles** : `cerulean`, `cosmo`, `cyborg`, `darkly`, `flatly`, `journal`, `litera`, `lumen`, `lux`, `materia`, `minty`, `pulse`, `sandstone`, `simplex`, `sketchy`, `slate`, `solar`, `spacelab`, `superhero`, `united`, `yeti`.

---

## 📝 Utilisation

### Accéder à l'application

```
http://localhost/moduleconnexion/public

```

### Fonctionnalités disponibles

- 🎨 Changer le thème depuis la navbar
- 👤 Modifier le profil via la page **Profil**
- 🔧 Accéder à l'**Administration** si connecté en tant qu'admin

---

## 🔐 Sécurité

- 🔒 Protection CSRF pour tous les formulaires
- 🔑 Hashage des mots de passe avec `password_hash()` (Argon2ID)
- 🛡️ Sessions sécurisées pour l'authentification
- 🚫 Validation des entrées utilisateur

---

## 📄 Licence

Ce projet est sous licence **MIT**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 👨‍💻 Auteur

Créé avec ❤️ par **Pascal**

- GitHub : [@pascal-fortunati](https://github.com/pascal-fortunati)
- Email : pascal-fortunati@laplateforme.io

---

**⭐ Si ce projet vous plaît, n'hésitez pas à lui donner une étoile !**
