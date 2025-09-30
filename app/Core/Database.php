<?php
namespace App\Core;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct(array $config)
    {
        $opts = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new \PDO($config['dsn'], $config['user'], $config['pass'], $opts);
    }

    public static function getInstance(array $config)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function pdo()
    {
        return $this->pdo;
    }
}