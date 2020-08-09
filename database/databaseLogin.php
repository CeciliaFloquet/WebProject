<?php
// Starting session
//session_start();
require 'database.php';

$pdo = db_connect();


// Handle form submission SignUp
function handle_form_submission() {
    global $pdo;
  
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username=$_POST["username"];
        $sql = "SELECT ID FROM  user WHERE username='$username' ";
        $result = $pdo->query($sql);
          
        if ($row = $result->fetch()) {
            $_SESSION["userid"] =$row['ID'];
    
        }

        header("Location: login.php");
    }
}


// chech if user name exist
function check_username($type) {
    global $pdo;
    $sql = "SELECT username FROM  user WHERE username='$type' ";
    $result = $pdo->query($sql);
      //int index = 0;
    if ($row = $result->fetch()) {
       return true ;

    }
    return false;
}

// check if password is correct
function check_password($type, $type2) {
    global $pdo;
    $sql = "SELECT * FROM  user WHERE username='$type' ";
    $result = $pdo->query($sql);
      //int index = 0;
    if ($row = $result->fetch()) {
        if($row['password']== $type2){
            return true ;
        }

    }
    return false;
}