<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\FlightRepository;

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_number = $_POST['flight_number'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $flight_date = $_POST['flight_date'] ?? '';

    $repository = new FlightRepository();

    try {
        $repository->addFlight([
            'flight_number' => $flight_number,
            'origin'        => $origin,
            'destination'   => $destination,
            'flight_date'   => $flight_date,
        ]);

        $message = 'Flight added successfully!';
    } catch (\PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Flight</title>
</head>
<body>
    <h1>Add a Flight</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="flight_number">Flight Number:</label><br>
        <input type="text" id="flight_number" name="flight_number" required><br>

        <label for="origin">Origin:</label><br>
        <input type="text" id="origin" name="origin" required><br>

        <label for="destination">Destination:</label><br>
        <input type="text" id="destination" name="destination" required><br>

        <label for="flight_date">Flight Date:</label><br>
        <input type="date" id="flight_date" name="flight_date" required><br><br>

        <button type="submit">Add Flight</button>
    </form>
</body>
</html>
