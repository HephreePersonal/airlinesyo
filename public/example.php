<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\DatabaseConnection;

class UserExample
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function testConnection()
    {
        try {
            $this->db->query("SELECT 1");
            echo "✅ Database connection successful!\n";
        } catch (\PDOException $e) {
            echo "❌ Connection failed: " . $e->getMessage() . "\n";
        }
    }

    public function createTestTable()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS test_users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            
            $this->db->exec($sql);
            echo "✅ Test table created successfully!\n";
            
        } catch (\PDOException $e) {
            echo "❌ Error creating table: " . $e->getMessage() . "\n";
        }
    }

    public function addTestUser($name, $email)
    {
        try {
            $sql = "INSERT INTO test_users (name, email) VALUES (:name, :email)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email
            ]);
            
            echo "✅ Test user added successfully with ID: " . $this->db->lastInsertId() . "\n";
            
        } catch (\PDOException $e) {
            echo "❌ Error adding user: " . $e->getMessage() . "\n";
        }
    }
}

// Run tests
echo "Starting database tests...\n";
echo "------------------------\n";

$example = new UserExample();
$example->testConnection();
$example->createTestTable();
$example->addTestUser('John Doe', 'john@example.com');

echo "------------------------\n";
echo "Tests completed!\n";
