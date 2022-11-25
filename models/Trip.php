<?php
class Trip {
    // Database
    private $conn;
    private $table = 'trip';

    // Cart properties

    public $id;
    public $creator_firstname;
    public $creator_lastname;
    public $hotel;
    public $country;
    public $description;
    public $hotel_url;
    public $activity;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get trip details
    public function read() {
        // Create Query
        $query = "SELECT 
            t.id,
            t.creator_firstname,
            t.creator_lastname,
            t.hotel,
            t.country,
            t.description,
            t.hotel_url,
            GROUP_CONCAT(a.activity) AS 'activity'
        FROM
             " . $this->table . " t
        LEFT JOIN activities a ON t.id = a.trip_id
        GROUP BY
            t.id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}