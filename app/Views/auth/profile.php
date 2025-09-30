<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Mon Profil</h2>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">Profil mis à jour avec succès !</div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="hidden" name="_csrf" value="<?= \App\Core\Csrf::start() ?>">

            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" name="login" value="<?= htmlspecialchars($u['login']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>