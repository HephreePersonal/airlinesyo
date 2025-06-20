<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\FlightRepository;

$repository = new FlightRepository();
$flights = $repository->getAllFlights();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Flights</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Flight List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Flight Number</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Flight Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?php echo htmlspecialchars($flight['id']); ?></td>
                    <td><?php echo htmlspecialchars($flight['flight_number']); ?></td>
                    <td><?php echo htmlspecialchars($flight['origin']); ?></td>
                    <td><?php echo htmlspecialchars($flight['destination']); ?></td>
                    <td><?php echo htmlspecialchars($flight['flight_date']); ?></td>
                    <td>
                        <a href="edit_flight.php?id=<?php echo $flight['id']; ?>">Edit</a> |
                        <a href="delete_flight.php?id=<?php echo $flight['id']; ?>" onclick="return confirm('Are you sure you want to delete this flight?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="add_flight.php">Add New Flight</a></p>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>