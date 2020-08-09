<?php
// Starting session

if (!ISSET($_SESSION['userid'])) {
    session_start();
}

$userid= $_SESSION["userid"];
require 'database.php';

$pdo = db_connect();


// Handle form submission SignUp
function handle_form_submission() {
    global $pdo;
    global $userid;
    if($_SERVER["REQUEST_METHOD"] == "POST"){

            $category=$_POST["category"];
            $sql = "INSERT INTO category(categoryID, categoryName, userID) VALUES('',:categoryName,:userID)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':categoryName', $category);
            $statement->bindValue(':userID', $userid);
            $statement->execute();
            
            header("Location: login.php");
               
        
      }

}

function handle_form_transactions(){
   
    global $pdo;
    global $userid;
    global $categoryTran;
    global $type;
    global $categoryID;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $value=$_POST["value"];
            foreach ($_POST["categoryTran"] as $select){
                $categoryID=$select;
            }
            foreach ($_POST["type"] as $select2){
                $type=$select2;
            }
            if($type == 'Credit'){
                $value= "-" . $value;
            }
            
            $description=$_POST["description"];
            
        
            $sql = "INSERT INTO transactions(ID,value, description, categoryID, type, userId) VALUES('',:value,:description, :categoryID, :type, :userId)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':value', $value);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':type', $type);
            $statement->bindValue(':userId', $userid);
            $statement->execute();

            
            header("Location: login.php");
    }
}
// chech if category name exist
function check_category($type) {
    global $pdo;
    global $userid;
    $sql = "SELECT categoryName FROM  category WHERE userID='$userid' ";
    $result = $pdo->query($sql);
      
    if ($row = $result->fetch()) {
        if($type == $row['categoryName']){
            return false;
        }
      

    }
    return true;
}
//function to populate category
function populateCategoryData(){
    global $pdo;
    global $userid;

    $sql = "SELECT * FROM  category WHERE userID='$userid'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){

        echo "<option  role=\"menuitem\" tabindex=\"-1\" value=\"" . $row['categoryID'] . "\">" . $row['categoryName'] . "</option>";

    }

}



//function to populate table
function populateTableData($categoryName){
    global $pdo;
    global $userid;
    
    $sql = "";
    if ($categoryName == '') {
        $sql = "SELECT transactions.description, transactions.value, category.categoryName FROM  transactions INNER JOIN category ON category.categoryID=transactions.categoryID WHERE transactions.userID='$userid'";
    } else {
        $sql = "SELECT transactions.description, transactions.value, category.categoryName FROM  transactions INNER JOIN category ON category.categoryID=transactions.categoryID WHERE transactions.userID='$userid' AND category.categoryName like '%$categoryName%'";
    }
    
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        echo "<tr>";
        echo "<td>" . $row["categoryName"];
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["value"]. "</td></tr>";
        echo "</tr>";
    }

}
//function for populate balance
function populateBalanceData($temp){
    global $pdo;
    global $userid;
    $sql="";
    if($temp == ""){
        $sql = "SELECT value FROM  transactions WHERE userID='$userid'";
    }else{
        $sql = "SELECT transactions.value FROM  transactions INNER JOIN category ON category.categoryID=transactions.categoryID  WHERE transactions.userID='$userid' AND category.categoryName ='$temp'";
    }
    $sum=0;
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){

    // $sum= is_numeric($row['value']) + $sum;
    $sum += $row['value'];  
    }
    if($sum > 0){
        echo '<h1 class="showBalance">' .$sum. "</h1>";
    }else{
        echo '<h1 class="showBalance2">' .$sum. "</h1>"; 
    }
}

//function to populate username
function populateUserNameData(){
    global $pdo;
    global $userid;

    $sql = "SELECT name FROM  user WHERE ID='$userid'";
 
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){

        echo "Hello " . $row['name'];

    }
   
}
