<h1>Bienvenue</h1>

<?php if (!empty($_SESSION['user_login'])): ?>
  <p>Bonjour <?= htmlspecialchars($_SESSION['user_login']) ?> !</p>
<?php else: ?>
  <p>Vous n'êtes pas connecté.</p>
<?php endif; ?>