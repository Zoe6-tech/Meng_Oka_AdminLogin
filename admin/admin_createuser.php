<?php
require_once '../load.php';

//make sure this page only access to login admin
confirm_logged_in();

// header('Access-Control-Allow-Origin:*');
//  header('Content-Type: application/json: charset=utf-8');
$results = [];
$user_fname = '';
$user_name = '';
$user_email = '';
$user_password = '';
// $fnameError= $usernameError=$emailError= '';

// gain submit data
if(isset($_POST['submit'])){
//user first name
    if(empty($_POST['fname'])) { 
        $results['message'] = 'first name is required'; 
        echo json_encode($results);
        // $fnameError='first name is required'; 
        die(); 
    } else {
        $user_fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    } 
//user name
    if(empty($_POST['username'])) { 
        $results['message'] = 'username is required'; 
        echo json_encode($results);
        die(); 
    } else{
        $user_name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    }
//user email
    if (empty($_POST['email'])) {
        $results['message'] ='email is required';
        echo json_encode($results);
        die();
    } else {
        $user_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    }


    $data = array(
        'fname' => trim($_POST['fname']),
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'email' => trim($_POST['email'])
    );

    $message = createUser($data);

}


//prepare email
$email_recipient = $user_email; 
$email_subject = "This a email that remind that you can login in now";
$email_message = sprintf('Your username is: %s, Your email is: %s', $user_name, $user_email);
$email_headers = "From: The Sender Name <admin@admin@gmail>\r\n";
$email_headers .= "To: $user_email\r\n";
$email_headers .= "Content-Type: text/html\r\n";

//  Send the email
$email_result = mail($email_recipient, $email_subject, $email_message,  $email_headers);
if($email_result){
    $results['message'] = sprintf('You have successfully create a new user: %s', $user_name);
}else{
    $results['message'] = sprintf('Email sent fail.');
}

echo json_encode($results);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Page</title>
</head>
<body>
    <h2>Create User</h2>
    <?php echo !empty($message)?$message:'';?> <!--if $message isnt empty, print $message info-->

    <form action="admin_createuser.php" method="post">
        <label for="first_name">First Name:</label><br>
        <input type="text" name="fname"  id="first_name" placeholder="enter first name" value=""><br><br>
        <!-- <span class="error">* <?php echo $nameErr;?></span><br><br> -->

        <label for="user_name">User Name:</label><br>
        <input type="text" name="username"  id="user_name" placeholder="enter user name" value=""><br><br>

        <label for="password">Password:</label><br>
        <input type="text" name="password"  id="password" placeholder="enter password" value=""><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email"  id="email" placeholder="enter email" value=""><br><br>

        <button class="subimt-createuser" type="submit" name="submit">Create user</button>
    </form>

    <script src=".../js/mail.js" type="module"></script>
</body>
</html>