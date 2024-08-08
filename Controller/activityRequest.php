<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific HTTP methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight request
    http_response_code(200);
    exit();
}
include_once('../Controller/dbconnection.php');
include_once('../Model/activity.php');

$activity = new Activity($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    $message = '';
    $success = false;

    // Check if the connection is valid
    if (!$conn) {
        $message = 'Database connection failed. Please try again.';
    } else {
        try {
            switch ($action) {
                case 'createTask':
                    $title = $_POST['taskTitle'];
                    $customer = $_POST['customerName'];
                    $duedate = $_POST['duedate'];
                    $weight = $_POST['actWeight'];
                    $completionStatus = 0;

                    $insertedId = $activity->create($customer, $title, $completionStatus, $weight, $duedate);
                    if ($insertedId) {
                        $message = 'New task created successfully!';
                        $success = true;
                    } else {
                        $message = 'Failed to create the task. Please try again.';
                    }
                    $escapedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                    if (!$success) {
                        echo "<script type='text/javascript'>
                        alert('$escapedMessage');
                        window.location.href = '../View/newTask.php'; // Adjust this URL based on the action
                        </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        alert('$escapedMessage');
                        window.opener.location.reload();  // Refresh the parent window
                        window.close();
                        </script>";
                    }
                    break;

                case 'updateCompletion':
                    $TASKID = $_POST['taskId'];
                    $updatedTask = $activity->updateCompletion($TASKID);
                    if ($updatedTask) {
                        $message = 'success';
                        $successM = true;
                    } else {
                        $message = 'failed';
                    }
                    $escapedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                    if (!$successM) {
                        echo $escapedMessage;
                    } else {
                        echo $escapedMessage;
                    }
                    break;


                default:
                    $message = 'Invalid action.';
            }
        } catch (Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage() . ' Please try again.';
        }
    }
}
