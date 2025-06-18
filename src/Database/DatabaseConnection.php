<?php
namespace App\Database;

use App\Config\ConfigManager;
use PDO;
use PDOException;

class DatabaseConnection
{
    private static $instance = null;
    private $connection = null;

    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $config = ConfigManager::getInstance()->get('database', 'default');
            
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            
            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options'] ?? []
            );
            
        } catch (PDOException $e) {
            throw new \RuntimeException("Could not connect to database: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}