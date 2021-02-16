<?php
//Auto-generate the password for the user
function genRandomString() {
    $length = 8;
    $characters = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[rand(0, strlen($characters))];
    }

    return $string;
}
?>