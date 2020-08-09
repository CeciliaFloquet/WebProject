<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();
// Starting session
//session_start();

require_once 'database/databaseLogin.php';


function validate(){
    global $valid;
    global $val_messages;
	
    if($_SERVER['REQUEST_METHOD']== 'POST')    {
        $valid=true;
      
        if(empty($_POST["username"])){
            
			$val_messages["username"]="Please enter the username";
            $valid = false;
		}else if(!check_username($_POST["username"])){
            $val_messages["username"]="This username does not exist. Please enter another username.";
            $valid = false;
        }else{
            $val_messages["username"]= "";
		}
        
		if(empty($_POST["password"])){
			$val_messages["password"]="Please enter the password";
            $valid = false;
		}else if(!check_password($_POST["username"],$_POST["password"])){
            $val_messages["password"]="Your password is wrong";
            $valid = false;
        }else{
            $val_messages["password"]= "";
        }

        if($valid == true){
            handle_form_submission(); 
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