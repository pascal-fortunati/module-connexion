<div class="row justify-content-center">
  <div class="col-md-6">
    <h2 class="mb-4">Connexion</h2>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- Formulaire de connexion -->
    <form method="post" action="<?= $baseUrl ?>index.php?p=login" class="mb-3">
      <input type="hidden" name="_csrf" value="<?= \App\Core\Csrf::start() ?>">
      <div class="mb-3">
        <label class="form-label">Login</label>
        <input type="text" name="login" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Se connecter</button>
    </form>

    <!-- Bloc Démo -->
    <div class="alert alert-info text-center mb-0">
      <strong>Démo :</strong> Login : <code>admin</code> | Mot de passe : <code>azerty83</code>
    </div>
  </div>
</div>