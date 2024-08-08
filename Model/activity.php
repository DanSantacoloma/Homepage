<?php
include_once(__DIR__ . '/../Controller/dbconnection.php');
class Activity
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($customer, $title, $completionStatus, $weight, $duedate)
    {
        $sql = "INSERT INTO task (customer, title, completion_status, weight, duedate) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssiis', $customer, $title, $completionStatus, $weight, $duedate);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM task WHERE Completion_Status = 0";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $activities = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getActbyID($ID)
    {
        $sql = "SELECT * FROM task WHERE ID = $ID";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $task = $result->fetch_assoc();
            return $task;
        } else {
            return null;
        }
    }

    public function updateCompletion($ID)
    {
        $sql = "UPDATE task SET Completion_Status = 1 WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Failed to prepare the SQL statement.");
        }
        $stmt->bind_param("i", $ID);
        $result = $stmt->execute();
        if ($result === false) {
            // Log or handle error
            throw new Exception("Failed to execute the SQL statement.");
        }

        // Optionally return the result
        return $result;
    }
}
