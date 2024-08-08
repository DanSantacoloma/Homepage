<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../View/Styles/nsStyle.css">
</head>

<body>
    <div class="container m-3">
        <form action="../Controller/activityRequest.php" method="post">
            <input type="hidden" name="action" value="editTask">
            <div class="row w-100">
                <div class="col-8">
                    <?php
                    include_once('../Model/activity.php');
                    include_once('../Model/customer.php');

                    // Retrieve the task ID from the URL and fetch the activity
                    $taskId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    $activity = new Activity($conn);
                    $task = $activity->getActbyID($taskId);

                    // Fetch all customers
                    $customerModel = new Customer($conn);
                    $customers = $customerModel->fetchAll();

                    // Output the input field for task name
                    echo '<label for="">Activity Name:</label>';
                    echo '<input type="text" class="form-control mb-3" style="max-width: 50vh;" name="actName" value="' . htmlspecialchars($task['Title']) . '">';

                    // Start the select element
                    echo '<label for="">Customer:</label>';
                    echo '<select name="customerName" class="form-select mb-3" style="max-width: 50vh;">';

                    // Loop through customers to create option elements
                    foreach ($customers as $customer) {
                        // Check if this customer should be selected
                        $selected = ($customer['Name'] === $task['Customer']) ? ' selected' : '';
                        echo '<option value="' . htmlspecialchars($customer['Name']) . '"' . $selected . '>' . htmlspecialchars($customer['Name']) . '</option>';
                    }

                    // Close the select element
                    echo '</select>';
                    ?>
                </div>
                <div class="col-4 align-items-middle" style="position: sticky; top: 0; max-width: 50vh;">
                    <div class="mb-3">
                        <?php
                        $dueDate = htmlspecialchars($task['DueDate']); // Ensure this is in YYYY-MM-DD format
                        echo '<label for="">Completion date:</label>';
                        echo '<input name="duedate" class="form-control mb-3" style="width: 25vh;" type="date" value="' . $dueDate . '">';
                        ?>
                    </div>
                    <button type="button" class="btn btn-dark mb-3" style="position: absolute; bottom: 0; width:25vh; max-width: 50vh;" id="Delete">Delete Task</button>
                </div>
            </div>
            <div class="row w-100">
                <div class="col-8">
                    <button type="button" class="btn btn-dark w-100 mb-3" style="max-width:50vh" id="newStep">New Step +</button>
                </div>
            </div>
            <div class="row w-100">
                <div class="container-steps ml-3" style="width: 100%;">

                </div>
            </div>
            <div class="row w-100">
                <button type="button" class="btn btn-dark mb-3" style="width: 20vh; margin-left: 39.5%" id="newStep">Save</button>
            </div>

        </form>


    </div>



    <script src="../Scripts/TaskScript.js"></script>
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>