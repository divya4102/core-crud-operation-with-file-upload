<?php
require 'config.php';
$firstname = $lastname = $email = '';
$profile = 'upload/no-image.jpg';
$firstnameerr = $lastnamerr = $emailerr = $profileerr = '';

if (isset($_POST['addEmployee'])) {
    extract($_POST);

    if (empty($firstname)) {
        $firstnameerr = 'Please enter first name';
    }

    if (empty($lastname)) {
        $lastnamerr = 'Please enter last name';
    }

    if (empty($email)) {
        $emailerr = 'Please enter email address';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = 'Please enter valid email address';
        }
    }

    $profile = $_FILES['profile']['name'];
    $size = $_FILES['profile']['size'];
    $type = $_FILES['profile']['type'];
    $temp = $_FILES['profile']['tmp_name'];

    $path = 'upload/' . $profile;
    if (empty($profile)) {
        $profileerr = 'Please upload profile photo';
    } elseif ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') {
        if (!file_exists($path)) {
            if ($size < 2000000) {
                if (!move_uploaded_file($temp, $path)) {
                    $profileerr = 'Error while uploading file.';
                } else {
                    $uploaded = true;
                }
            } else {
                $profileerr = 'file size sholud not exceed more than 2MB.';
            }
        } else {
            $profileerr = 'file already exits.';
        }
    } else {
        $profileerr = 'Pleae upload file with valid extension (jpg, jpeg, png).';
    }

    if (empty($firstnameerr) && empty($lastnamerr) && empty($emailerr) && empty($profileerr) && $uploaded) {
        $query = "INSERT INTO employees_with_profile (`firstname`, `lastname`, `email`, `profile`) values('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $path . "')";

        $result = mysqli_query($connect, $query);

        $errmsg = '';
        if ($result) {
            header('location: index.php');
        } else {
            echo 'Something went wrong!! Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">

    </style>
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Add New Employee</h2>
                </div>

                <form action="add.php" class="" method="POST" enctype="multipart/form-data">
                    <div class="form-group <?php echo !empty($firstnameerr) ? 'has-error' : '' ?>">
                        <label for="firstname">First name:</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname" value="<?php echo $firstname; ?>">
                        <span class="help-block"><?php echo $firstnameerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($lastnamerr) ? 'has-error' : '' ?>">
                        <label for="firstname">Last name:</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastnamerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($emailerr) ? 'has-error' : '' ?>">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $emailerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($profileerr) ? 'has-error' : '' ?>">
                        <label for="profile">Upload profile photo:</label>
                        <input type="file" class="form-control" id="profile" name="profile">
                        <span class="help-block"><?php echo $profileerr ?></span>                        
                        <img src="<?php echo $profile ?>" class="profile" height="100" width="100" class="img img-fluid" alt="profile">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit" name="addEmployee">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.profile').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#profile").change(function() {
        readURL(this);
    });
</script>