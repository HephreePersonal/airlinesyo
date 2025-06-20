<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\FlightRepository;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid flight ID.');
}

$id = (int)$_GET['id'];
$repository = new FlightRepository();

try {
    $success = $repository->deleteFlight($id);
    if ($success) {
        header('Location: view_flights.php?message=' . urlencode('Flight deleted successfully.'));
    } else {
        header('Location: view_flights.php?message=' . urlencode('Failed to delete flight.'));
    }
} catch (\PDOException $e) {
    header('Location: view_flights.php?message=' . urlencode('Error: ' . $e->getMessage()));
}
exit;