<h1 class="mb-5 text-center text-primary">Module Connexion</h1>

<div class="container">
  <?php if (!empty($_SESSION['user_login'])): ?>
    <p>Bonjour <?= htmlspecialchars($_SESSION['user_login']) ?> !</p>
  <?php else: ?>
    <p>Vous n'êtes pas connecté.</p>
  <?php endif; ?>
  <!-- Présentation -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">Présentation</h2>
      <p><strong>Module Connexion</strong> est une application PHP simple permettant la gestion des utilisateurs : inscription, connexion, profil, administration et thèmes Bootstrap avec Bootswatch.</p>
    </div>
  </div>

  <!-- Fonctionnalités -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">📌 Fonctionnalités</h2>
      <ul>
        <li>✅ Authentification utilisateur (login / logout)</li>
        <li>✅ Inscription avec validation et hashage des mots de passe</li>
        <li>✅ Gestion de profil (modification login, prénom, nom et mot de passe)</li>
        <li>✅ Protection CSRF pour tous les formulaires</li>
        <li>✅ Page Admin pour gérer les utilisateurs (accessible uniquement à l'admin)</li>
        <li>✅ Layout responsive avec card "boxed"</li>
        <li>✅ Thèmes Bootstrap via Bootswatch avec sélection dynamique</li>
        <li>✅ Bloc "Démo" sur la page de connexion</li>
        <li>✅ Routing simple basé sur <code>?p=</code> pour GET et POST</li>
      </ul>
    </div>
  </div>

  <!-- Prérequis -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">🛠️ Prérequis</h2>
      <ul>
        <li>PHP >= 7.4</li>
        <li>MySQL / MariaDB</li>
        <li>Serveur local type Laragon, XAMPP, WAMP, ou Apache/Nginx</li>
        <li>Composer (pour autoloading, si besoin)</li>
      </ul>
    </div>
  </div>

  <!-- Installation -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">🚀 Installation</h2>

      <h5>1. Cloner le dépôt</h5>
      <pre><code class="language-bash">git clone https://github.com/votre-utilisateur/module-connexion.git
cd module-connexion</code></pre>

      <h5>2. Copier le projet dans votre serveur local</h5>
      <p>Placer le dossier dans <code>www</code> ou <code>htdocs</code> selon votre environnement.</p>

      <h5>3. Créer la base de données MySQL</h5>
      <pre><code class="language-sql">CREATE DATABASE moduleconnexion CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;</code></pre>

      <h5>4. Importer la table utilisateurs</h5>
      <pre><code class="language-sql">CREATE TABLE `utilisateurs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `nom` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</code></pre>

      <h5>5. Créer un compte admin (optionnel)</h5>
      <pre><code class="language-sql">INSERT INTO utilisateurs (login, prenom, nom, password)
VALUES ('admin', 'Admin', 'Système', '$argon2id$v=19$m=65536,t=4,p=1$SALT$HASH');</code></pre>
      <p><strong>Note</strong> : Remplacez <code>$argon2id$...</code> par un hash généré avec <code>password_hash('admin', PASSWORD_ARGON2ID)</code>.</p>

      <h5>6. Configurer <code>config/config.php</code></h5>
      <pre><code class="language-php">&lt;?php
return [
    'db' =&gt; [
        'dsn' =&gt; 'mysql:host=localhost;dbname=moduleconnexion;charset=utf8mb4',
        'user' =&gt; 'root',
        'pass' =&gt; '',
    ],
    'base_url' =&gt; '/module-connexion/public',
];</code></pre>
    </div>
  </div>

  <!-- Thèmes -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">🌈 Thèmes</h2>
      <p>Le projet utilise <strong>Bootswatch</strong> pour changer facilement le thème de l'application.</p>
      <p><strong>Thèmes disponibles :</strong> cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty, pulse, sandstone, simplex, sketchy, slate, solar, spacelab, superhero, united, yeti.</p>
    </div>
  </div>

  <!-- Sécurité -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">🔐 Sécurité</h2>
      <ul>
        <li>Protection CSRF pour tous les formulaires</li>
        <li>Hashage des mots de passe avec <code>password_hash()</code> (Argon2ID)</li>
        <li>Sessions sécurisées pour l'authentification</li>
        <li>Validation des entrées utilisateur</li>
      </ul>
    </div>
  </div>

  <!-- Maquette -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body">
      <h2 class="card-title text-primary">📐 Maquette</h2>
      <p>Vous pouvez consulter la maquette du projet ici : <a href="maquette_module_connexion.pdf">maquette_module_connexion.pdf</a></p>
    </div>
  </div>

  <!-- Auteur & Licence -->
  <div class="card mb-4 shadow-sm border-primary">
    <div class="card-body text-center">
      <h2 class="card-title text-primary">👨‍ Auteur</h2>
      <p>Créé avec ❤️ par <strong>Pascal</strong></p>
      <p>GitHub : <a href="https://github.com/pascal-fortunati">@pascal-fortunati</a> | Email : pascal-fortunati@laplateforme.io</p>
    </div>
  </div>

</div>