<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Inscription</h2>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= $baseUrl ?>index.php?p=register">
      <input type="hidden" name="_csrf" value="<?= \App\Core\Csrf::start() ?>">

      <div class="mb-3">
        <label class="form-label">Login</label>
        <input type="text" name="login" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" name="prenom" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirmer le mot de passe</label>
        <input type="password" name="password2" class="form-control" required>
      </div>

      <button class="btn btn-success">S'inscrire</button>
    </form>
  </div>
</div>