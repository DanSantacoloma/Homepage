<?php
include_once('../Controller/dbconnection.php');
include_once('../Model/customer.php');

$customer = new customer($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Name = $_POST['customerName'];

    $message = '';
    $success = false;

    // Check if the connection is valid
    if (!$conn) {
        $message = 'Database connection failed. Please try again.';
    } else {
        // Attempt to insert the data into the database
        if ($Name != '') {
            try {
                $insertedId = $customer->create($Name);
                if ($insertedId) {
                    $message = 'New customer added successfully!';
                    $success = true;
                } else {
                    $message = 'Failed to add the customer. Please try again.';
                }
            } catch (Exception $e) {
                $message = 'An error occurred: ' . $e->getMessage() . ' Please try again.';
            }
        } else {
            $message = 'Customer name cannot be blank. Please try again.';
        }
    }
}

$escapedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');


if (!$success) {
    echo "<script type='text/javascript'>
    alert('$escapedMessage');
    window.location.href = '../View/newCustomer.html';
    </script>";
} else {
    echo "<script type='text/javascript'>
    alert('$escapedMessage');
    window.opener.location.reload();  // Refresh the parent window
    window.close();  // Close the current window
    </script>";
}
