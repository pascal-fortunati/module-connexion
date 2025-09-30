<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Csrf;
use App\Models\User;

class AuthController extends Controller
{
    private $userModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $db = Database::getInstance($config['db']);
        $this->userModel = new User($db);
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function index()
    {
        $this->view('index', []);
    }

    public function showLogin(array $errors = [])
    {
        Csrf::start();
        $this->view('auth/login', ['errors' => $errors]);
    }

    public function showRegister(array $errors = [])
    {
        Csrf::start();
        $this->view('auth/register', ['errors' => $errors]);
    }

    public function login()
    {
        $errors = [];
        if (!Csrf::check($_POST['_csrf'] ?? '')) {
            $errors[] = 'Jeton CSRF invalide.';
            return $this->showLogin($errors);
        }

        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$login || !$password) {
            $errors[] = 'Login et mot de passe requis.';
            return $this->showLogin($errors);
        }

        $user = $this->userModel->findByLogin($login);
        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = 'Identifiants invalides.';
            return $this->showLogin($errors);
        }

        // Authentification réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_login'] = $user['login'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];

        $this->redirect('index.php');
    }

    public function register()
    {
        $errors = [];
        if (!Csrf::check($_POST['_csrf'] ?? '')) {
            $errors[] = 'Jeton CSRF invalide.';
            return $this->showRegister($errors);
        }

        $login = trim($_POST['login'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if (!$login || !$prenom || !$nom) $errors[] = 'Tous les champs sont requis.';
        if (strlen($password) < 8) $errors[] = 'Mot de passe trop court (>=8).';
        if ($password !== $password2) $errors[] = 'Les mots de passe ne correspondent pas.';
        if ($this->userModel->findByLogin($login)) $errors[] = 'Login déjà utilisé.';

        if (!empty($errors)) return $this->showRegister($errors);

        $hashed = password_hash($password, PASSWORD_ARGON2ID);
        $created = $this->userModel->create($login, $prenom, $nom, $hashed);
        if (!$created) {
            $errors[] = 'Impossible de créer l\'utilisateur.';
            return $this->showRegister($errors);
        }

        $this->redirect('index.php?p=login');
    }

    public function profile()
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('index.php?p=login');
        }

        $user = $this->userModel->findById($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['_csrf'] ?? '')) {
                return $this->view('auth/profile', ['user' => $user, 'error' => 'Jeton CSRF invalide.']);
            }

            $login = trim($_POST['login'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $nom = trim($_POST['nom'] ?? '');
            $password = $_POST['password'] ?? '';

            $hashed = !empty($password) ? password_hash($password, PASSWORD_ARGON2ID) : null;
            $this->userModel->update($user['id'], $login, $prenom, $nom, $hashed);

            $_SESSION['user_login'] = $login;
            $_SESSION['user_nom'] = $nom;
            $_SESSION['user_prenom'] = $prenom;
            // Redirection pour éviter le re-post du formulaire
            $this->redirect('index.php?p=profile&success=1');
        }

        $success = $_GET['success'] ?? null;
        $this->view('auth/profile', ['user' => $user, 'success' => $success]);
    }


    public function admin()
    {
        if (empty($_SESSION['user_login']) || $_SESSION['user_login'] !== 'admin') {
            $this->redirect('index.php');
        }

        $users = $this->userModel->getAll();
        $this->view('admin/index', ['users' => $users]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('index.php');
    }
}
