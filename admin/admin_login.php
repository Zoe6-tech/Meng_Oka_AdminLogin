<?php
require_once '../load.php';

$ip = $_SERVER['REMOTE_ADDR'];//"REMOTE_ADDR" => The IP address from which the user is viewing the current page.
//we want get the value $ip, and add it in login() as the third parameter

//gain username and password, empty check
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); //The trim() function removes whitespace and other predefined characters from both sides of a string.
    
    
    if(!empty($username) && !empty($password)){//if username and password both not empty
        $result = login($username, $password, $ip);//allow login, login function in login.php
        $message = $result;
    }else{
        echo "<br />\n";
        $message = 'Plesase fill out the request field';
    }
}

//Account complete lockout after 3 failed login attempts.
  $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? ($_SESSION['login_attempts'] + 1) : 0;
  // do checking on number of attempts
  if ($_SESSION['login_attempts'] > 5)
  {
    echo "Login failure: Maximum login attempts was exceeded !";
    echo "<br />\n"; 
    echo " * Your IP is locked by server due to repeatedly fails logins. If you have any questions, please contact administrator.";
    echo "<br />\n"; 

    //echo "Please wait 30 seconds...";

    die();

  }


//if user already log in, redirect user to welcome.php, dont allow login in user access admin_login.php again
if(isset($_SESSION['user_id'])){
    redirect_to('welcome.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the admin panel</title>
</head>
<body>
    <?php echo !empty($message)?$message:'';?> <!--if $message isnt empty, print $message info-->
     <h2>User Login</h2>
    <form action="admin_login.php" method="post">
       <label for="username">Username:</label><br>
       <input id="username" type="text" name="username" value="" placeholder="Enter username">
       <br><br>
       <label for="password">Password:</label><br>
       <input id="password" type="text" name="password" value="" placeholder="Enter password">
       <br><br>
       <button type="submit" name="submit">Login</button>
       <h4>* Login Attempt: <?php echo $_SESSION['login_attempts']; ?> </h4>
        <h5>Account will complete lockout after you 5 failed login attempts, please be careful ！！！</h5>
        <h6>admin</h6><h6>admin123</h6>
    </form>
</body>
</html>