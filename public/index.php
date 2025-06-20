<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\DatabaseConnection;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Flight Management Dashboard</title>
</head>
<body>
    <h1>Flight Management Dashboard</h1>
    <nav>
        <ul>
            <li><a href="add_flight.php">Add Flight</a></li>
            <li><a href="view_flights.php">View Flights</a></li>
        </ul>
    </nav>
    <?php
    // Example of fetching data from MySQL
    try {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->query("SELECT 'Connected to MySQL successfully!' as message");
        $row = $stmt->fetch();
        echo "<p>" . htmlspecialchars($row['message']) . "</p>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</body>
</html>
