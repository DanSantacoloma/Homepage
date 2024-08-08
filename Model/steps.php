<?php
include_once('../Controller/dbconnection.php');
class Step
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}
