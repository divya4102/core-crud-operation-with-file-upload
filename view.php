<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    require 'config.php';

    $id = $_GET['id'];
    $query = "SELECT * FROM employees_with_profile WHERE id=$id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $profile = $row['profile'];
            }
        } else {
            echo 'No records found.';
        }
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($connect);
    }
} else {
    echo "Sorry, you've made an invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $firstname; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $lastname; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p class="form-control-static"><?php echo $email; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Profile</label>
                        <img src="<?php echo $profile ?>" class="img-fluid" style="display: block;" height="100" width="100">
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>