<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();
// Starting session
if (!ISSET($_SESSION['userid'])) {
    session_start();
}

$userid = $_SESSION['userid'];

require_once 'database/databaseOwn.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['filterCategory'])) {
    populateTable($_REQUEST['filterCategory']);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['showBalance'])) {
    populateBalance($_REQUEST['showBalance']);
}


function validate() {
    global $valid;
    global $val_messages;
	
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $valid=true;
        if(isset($_POST["submitCategory"])){
            //validate the category
            if(empty($_POST["category"])){
                
                $val_messages["category"]="Please enter the category";
                $valid = false;
            }else if(!check_category($_POST["category"])){
                $val_messages["category"]="This category already exists. Please enter another category.";
                $valid = false;
            }else{
                $val_messages["category"]= "";
            }
             //check if all input is valid
            if($valid == true){
                handle_form_submission(); 
            }
     

        }
        else if(isset($_POST["submitTransaction"])){
            //validate the value
            if(empty($_POST["value"])){
                
                $val_messages["value"]="Please enter value";
                $valid = false;
            }else if(!is_numeric($_POST["value"])){
                $val_messages["value"]="Please enter value. The value should be a number";
                $valid = false;
            }else{
                $val_messages["value"]= "";
            }
            //validate the description
            if(empty($_POST["description"])){
                
                $val_messages["description"]="Please enter the description";
                $valid = false;
            }else{
                $val_messages["description"]= "";
            }
            //validate the categoryTran
            if(empty($_POST["categoryTran"])){
                
                $val_messages["categoryTran"]="Please chose the category";
                $valid = false;
            }else{
                $val_messages["categoryTran"]= "";
            }
            //validate the type
            if(empty($_POST["type"])){
                
                $val_messages["type"]="Please chose the type";
                $valid = false;
            }else{
                $val_messages["type"]= "";
            }
             //check if all input is valid
            if($valid == true){
                handle_form_transactions(); 
            }
     
        }
       
    }
}

function the_validation_message($type) {

  global $val_messages;

  if($_SERVER['REQUEST_METHOD']== 'POST')  {
	foreach ($val_messages as $key=>$message) {
			if($key==$type){
			echo '<div class="failure-message">';
			echo "$message </div>";
			}
	}
  }
}
//function to populate category
function populateCategory(){

    populateCategoryData();
}

///funcion to populate filter

function populateFilter(){
    populateFilterData();
}
//function to populate table
function populateTable($categoryName) {
    populateTableData($categoryName);
}
//function to populate balance
function populateBalance($temp){

    populateBalanceData($temp);
}
//function to populate username
function populateUserName(){
    populateUserNameData();
}
