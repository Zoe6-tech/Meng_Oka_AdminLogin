<?php
require_once '../load.php';
confirm_logged_in();//only login in user can see the index.php page


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user successful page.</title>
</head>
<body>
    <h2>Hi, <?php echo $_SESSION['user_name'];?>! You have successfuly create a new user. </h2>
    <br>
    <a href="welcome.php">Back</a><br>
    <a href="admin_createuser.php">Create another User</a><br>
    <a href="admin_logout.php">Sign Out</a>

</body>
</html>