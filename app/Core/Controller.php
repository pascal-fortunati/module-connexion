<?php

namespace App\Core;

class Controller
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * // Affiche une vue
     * @param string $path Chemin de la vue (relatif à app/Views, sans l'extension .php)
     * @param array $data Données à passer à la vue
     */
    protected function view(string $path, array $data = [])
    {
        extract($data);
        $baseUrl = $this->config['base_url'] ?? '/';

        // Chemin complet de la vue
        $fullViewPath = __DIR__ . '/../../app/Views/' . $path . '.php';

        // Vérifie que la vue existe
        if (file_exists($fullViewPath)) {
            require __DIR__ . '/../../app/Views/layout.php';
        } else {
            echo '<div class="alert alert-warning">Vue introuvable : ' . htmlspecialchars($fullViewPath) . '</div>';
        }
    }

    /**
     * Redirige vers une URL
     */
    protected function redirect(string $path)
    {
        $base = $this->config['base_url'] ?? '/';
        header('Location: ' . rtrim($base, '/') . '/' . ltrim($path, '/'));
        exit;
    }
}
