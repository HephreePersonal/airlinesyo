<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\FlightRepository;

$repository = new FlightRepository();
$message = null;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid flight ID.');
}

$id = (int)$_GET['id'];
$flight = $repository->getFlightById($id);

if (!$flight) {
    die('Flight not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_number = $_POST['flight_number'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $flight_date = $_POST['flight_date'] ?? '';

    try {
        $repository->updateFlight($id, [
            'flight_number' => $flight_number,
            'origin'        => $origin,
            'destination'   => $destination,
            'flight_date'   => $flight_date,
        ]);

        $message = 'Flight updated successfully!';
        $flight = $repository->getFlightById($id); // Refresh data
    } catch (\PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Flight</title>
</head>
<body>
    <h1>Edit Flight</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="flight_number">Flight Number:</label><br>
        <input type="text" id="flight_number" name="flight_number" value="<?php echo htmlspecialchars($flight['flight_number']); ?>" required><br>

        <label for="origin">Origin:</label><br>
        <input type="text" id="origin" name="origin" value="<?php echo htmlspecialchars($flight['origin']); ?>" required><br>

        <label for="destination">Destination:</label><br>
        <input type="text" id="destination" name="destination" value="<?php echo htmlspecialchars($flight['destination']); ?>" required><br>

        <label for="flight_date">Flight Date:</label><br>
        <input type="date" id="flight_date" name="flight_date" value="<?php echo htmlspecialchars($flight['flight_date']); ?>" required><br><br>

        <button type="submit">Update Flight</button>
    </form>
    <p><a href="view_flights.php">Back to Flight List</a></p>
</body>
</html>