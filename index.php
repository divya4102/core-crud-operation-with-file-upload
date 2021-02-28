<?php
require 'config.php';
?>
<html>

<head>
    <title>Simple CRUD Operation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2>List Employees</h2>
                    <a class="btn btn-success float-right" href="add.php">Add new employee</a>
                </div>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Profile</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM employees_with_profile";
                        $result = mysqli_query($connect, $query);

                        if ($result) {
                            if (mysqli_num_rows($result)) {
                                while ($record = mysqli_fetch_assoc($result)) {
                        ?>
                                    <tr>
                                        <td><?php echo $record['id']; ?></td>
                                        <td><?php echo $record['firstname']; ?></td>
                                        <td><?php echo $record['lastname']; ?></td>
                                        <td><?php echo $record['email']; ?></td>
                                        <td><img src="<?php echo $record['profile']; ?>" alt="profile" width="100" height="100" class="img img-fluid"> </td>
                                        <td><a href="view.php?id=<?php echo $record['id']; ?>">View</a></td>
                                        <td><a href="edit.php?id=<?php echo $record['id']; ?>">Edit</a></td>
                                        <td><a href="delete.php?id=<?php echo $record['id']; ?>">Delete</a></td>                                        
                                    </tr>
                        <?php
                                }
                            } else {
                                echo '<tr><td colspan=6>No records found.</td></tr>';
                            }
                        } else {
                            echo "ERROR: Could not able to execute $query. " . mysqli_error($connect);
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>