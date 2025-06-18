<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\DatabaseConnection;

?>
<!DOCTYPE html>
<html>
<head>
    <title>My First PHP Website</title>
</head>
<body>
<h1>Hello, World!</h1>
<?php
// Example of fetching data from MySQL
try {
    $db = DatabaseConnection::getInstance()->getConnection();
    $stmt = $db->query("SELECT 'Hello from MySQL!' as message");
    $row = $stmt->fetch();
    echo "<p>" . htmlspecialchars($row['message']) . "</p>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>