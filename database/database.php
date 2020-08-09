<?php
require 'config.php';

// Should return a PDO
function db_connect() {

  try {
    // TODO
    // try to open database connection using constants set in config.php
    // return $pdo;
    $connString = "mysql:host=localhost;dbname=financialproject";
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connString,$user,$pass);
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
  catch (PDOException $e){
    die($e->getMessage());
  }
}

