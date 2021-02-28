<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    require 'config.php';

    $id = $_GET['id'];

    $query = "SELECT * FROM employees_with_profile WHERE id=$id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profile = $row['profile'];
                unlink($profile);       // delete file from the folder
               
                $query = "DELETE FROM employees_with_profile WHERE id=$id";
                $result = mysqli_query($connect, $query);

                if ($result) {
                    header('Location:index.php');
                } else {
                    echo "ERROR: Could not able to execute $query. " . mysqli_error($connect);
                }
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
