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

    /**
     * Retrieve all flights from the database.
     *
     * @return array List of flights.
     */
    public function getAllFlights(): array
    {
        $stmt = $this->db->query('SELECT * FROM flights ORDER BY flight_date DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve a single flight by ID.
     *
     * @param int $id Flight ID.
     * @return array|null Flight data or null if not found.
     */
    public function getFlightById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM flights WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $flight = $stmt->fetch(PDO::FETCH_ASSOC);
        return $flight ?: null;
    }

    /**
     * Update flight details.
     *
     * @param int $id Flight ID.
     * @param array $data Flight data to update.
     * @return bool True on success, false otherwise.
     */
    public function updateFlight(int $id, array $data): bool
    {
        $sql = 'UPDATE flights SET flight_number = :flight_number, origin = :origin, '
             . 'destination = :destination, flight_date = :flight_date WHERE id = :id';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':flight_number' => $data['flight_number'] ?? null,
            ':origin'        => $data['origin'] ?? null,
            ':destination'   => $data['destination'] ?? null,
            ':flight_date'   => $data['flight_date'] ?? null,
            ':id'            => $id,
        ]);
    }

    /**
     * Delete a flight by ID.
     *
     * @param int $id Flight ID.
     * @return bool True on success, false otherwise.
     */
    public function deleteFlight(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM flights WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
