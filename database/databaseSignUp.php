<?php
require 'database.php';

$pdo = db_connect();


// Handle form submission SignUp
function handle_form_submission() {
    global $pdo;
  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $email=$_POST["email"];
      $username=$_POST["username"];
      $password=$_POST["password"];
      $name=$_POST["name"];
      $sql = "INSERT INTO user(id, name, username, email, password) VALUES('',:name,:username,:email, :password)";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':name', $name);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':email', $email);
      $statement->bindValue(':password', $password);
      $statement->execute();
      
        header("Location: index.php");
    }
}


// chech if user name exist
function check_username($type) {
    global $pdo;
    $sql = "SELECT username FROM  user WHERE username='$type' ";
    $result = $pdo->query($sql);
      //int index = 0;
    if ($row = $result->fetch()) {
       return false;

    }
    return true;
}