<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->pdo();
    }

    /**
     * Crée un utilisateur
     */
    public function create(string $login, string $prenom, string $nom, string $password): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO utilisateurs (login, prenom, nom, password) 
             VALUES (:login, :prenom, :nom, :password)'
        );
        return $stmt->execute([
            ':login' => $login,
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':password' => $password
        ]);
    }

    /**
     * Récupère un utilisateur par login
     */
    public function findByLogin(string $login)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE login = :login LIMIT 1');
        $stmt->execute([':login' => $login]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Récupère un utilisateur par id
     */
    public function findById(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(int $id, string $login, string $prenom, string $nom, ?string $hashedPassword = null): bool
    {
        if ($hashedPassword) {
            $stmt = $this->pdo->prepare(
                'UPDATE utilisateurs 
                 SET login = :login, prenom = :prenom, nom = :nom, password = :password 
                 WHERE id = :id'
            );
            return $stmt->execute([
                ':login' => $login,
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':password' => $hashedPassword,
                ':id' => $id
            ]);
        } else {
            $stmt = $this->pdo->prepare(
                'UPDATE utilisateurs 
                 SET login = :login, prenom = :prenom, nom = :nom 
                 WHERE id = :id'
            );
            return $stmt->execute([
                ':login' => $login,
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':id' => $id
            ]);
        }
    }

    /**
     * Liste tous les utilisateurs
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM utilisateurs ORDER BY id ASC');
        return $stmt->fetchAll() ?: [];
    }
}
