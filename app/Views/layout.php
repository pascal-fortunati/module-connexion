<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Définir le thème Bootswatch
$availableThemes = [
  'cerulean',
  'cosmo',
  'cyborg',
  'darkly',
  'flatly',
  'journal',
  'litera',
  'lumen',
  'lux',
  'materia',
  'minty',
  'pulse',
  'sandstone',
  'simplex',
  'sketchy',
  'slate',
  'solar',
  'spacelab',
  'superhero',
  'united',
  'yeti'
];

// Si l'utilisateur change le thème via le select
if (!empty($_GET['theme']) && in_array($_GET['theme'], $availableThemes)) {
  $_SESSION['theme'] = $_GET['theme'];
}

// Thème actuel : session ou défaut
$theme = $_SESSION['theme'] ?? 'sketchy';
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Module Connexion</title>
  <!-- Bootswatch Theme -->
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/<?= $theme ?>/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }

    .card-main {
      margin-top: 50px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .btn-custom {
      min-width: 120px;
    }

    .theme-selector {
      margin-left: 15px;
    }
  </style>
</head>

<body>
  <!-- Navbar centrée en box -->
  <div class="container d-flex justify-content-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-100">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= $baseUrl ?>/index.php">Module Connexion</a>
        <div class="d-flex align-items-center flex-wrap">
          <?php if (!empty($_SESSION['user_login'])): ?>
            <span class="text-white me-3">Connecté : <strong><?= htmlspecialchars($_SESSION['user_login']) ?></strong></span>
            <a class="btn btn-outline-light btn-sm btn-custom me-1" href="<?= $baseUrl ?>index.php?p=profile">Profil</a>
            <?php if ($_SESSION['user_login'] === 'admin'): ?>
              <a class="btn btn-warning btn-sm btn-custom me-1" href="<?= $baseUrl ?>index.php?p=admin">Admin</a>
            <?php endif; ?>
            <a class="btn btn-outline-light btn-sm btn-custom" href="<?= $baseUrl ?>index.php?p=logout">Déconnexion</a>
          <?php else: ?>
            <a class="btn btn-light btn-sm btn-custom me-2" href="<?= $baseUrl ?>index.php?p=login">Connexion</a>
            <a class="btn btn-success btn-sm btn-custom" href="<?= $baseUrl ?>index.php?p=register">Inscription</a>
          <?php endif; ?>

          <!-- Sélecteur de thème -->
          <form method="get" class="theme-selector ms-2">
            <select name="theme" onchange="this.form.submit()" class="form-select form-select-sm">
              <?php foreach ($availableThemes as $t): ?>
                <option value="<?= $t ?>" <?= $t === $theme ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
              <?php endforeach; ?>
            </select>
          </form>
        </div>
      </div>
    </nav>
  </div>

  <!-- Main container -->
  <div class="container d-flex justify-content-center align-items-start">
    <div class="card card-main" style="width: 100%;">
      <?php
      if (isset($fullViewPath) && file_exists($fullViewPath)) {
        require $fullViewPath;
      } else {
        echo '<div class="alert alert-warning">Vue introuvable : ' . htmlspecialchars($fullViewPath ?? '') . '</div>';
      }
      ?>
    </div>
  </div>

</body>

</html>