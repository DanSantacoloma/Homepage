<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../View/Styles/ntStyle.css">
</head>

<body>

    <div class="container m-4">
        <form action="../Controller/activityRequest.php" method="POST">
            <input type="hidden" name="action" value="createTask">
            <div class="row mb-3 mt-3">
                <label for="taskTitle" class="col-sm-4 col-form-label">Activity Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="taskTitle" placeholder="Title">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-7">
                    <select name="customerName" class="form-select">
                        <option value="" disabled selected>Select a customer </option>
                        <?php
                        include('../Controller/dbconnection.php');
                        $customers = mysqli_query($conn, "SELECT * FROM customer");
                        while ($customer = mysqli_fetch_array($customers)) {
                        ?>
                            <option value="<?php echo $customer['Name']; ?>"> <?php echo $customer['Name']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <button type="button" class="btn btn-dark w-100 mt-3" id="newCustomer">Add New Customer</button>
                </div>
            </div>

            <div class="mb-3">
                <label for="duedate" class="form-label">Due Date:</label>
                <input name="duedate" class="form-control" type="date" />
            </div>
            <div class="mb-3">
                <label for="actWeight" class="form-label">Weight:</label>
                <input type="number" name="actWeight" class="form-control" placeholder="0">
            </div>
            <button type="submit" class="btn btn-dark w-100" name="submitAct">Save</button>
        </form>
    </div>
    <script src="../Scripts/TaskScript.js"></script>
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>