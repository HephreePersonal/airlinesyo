<?php
namespace App\Database;

use PDO;

class FlightRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    /**
     * Insert a flight record into the database.
     *
     * @param array $data Associative array with keys: flight_number, origin,
     *                    destination and flight_date.
     * @return bool True on success, false otherwise.
     */
    public function addFlight(array $data): bool
    {
        $sql = 'INSERT INTO flights (flight_number, origin, destination, flight_date) '
             . 'VALUES (:flight_number, :origin, :destination, :flight_date)';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':flight_number' => $data['flight_number'] ?? null,
            ':origin'        => $data['origin'] ?? null,
            ':destination'   => $data['destination'] ?? null,
            ':flight_date'   => $data['flight_date'] ?? null,
        ]);
    }
}

