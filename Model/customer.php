<?php
include_once('../Controller/dbconnection.php');
class Customer
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to add a new customer
    public function create($name)
    {
        $sql = "INSERT INTO customer (Name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    // Method to fetch all customers
    public function fetchAll()
    {
        $sql1 = "SELECT * FROM customer";
        $result = $this->conn->query($sql1);
        if ($result->num_rows > 0) {
            return $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}
