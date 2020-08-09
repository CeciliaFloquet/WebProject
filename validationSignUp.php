<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();
require_once 'database/databaseSignUp.php';


function validate(){
    global $valid;
    global $val_messages;
	
    if($_SERVER['REQUEST_METHOD']== 'POST')    {
        $valid=true;
        
        if(empty($_POST["name"])){
			$val_messages["name"]="Please enter your name";
            $valid = false;
		}else{
            $val_messages["name"]= "";
		}
        if(empty($_POST["username"])){
            
			$val_messages["username"]="Please enter your username";
            $valid = false;
		}else if(!check_username($_POST["username"])){
            $val_messages["username"]="This username already exists. Please enter another username.";
            $valid = false;
        }else{
            $val_messages["username"]= "";
		}
		if(empty($_POST["email"])){ 
			$val_messages["email"]="Email enter your email";
            $valid = false;
        }
        else if(!preg_match('#^(.+)@([^\.].*)\.([a-z]{2,})$#', $_POST["email"])){
            $val_messages["email"]="Email is not correct format. Try: email@email.com";
            $valid = false;
        }else{
            $val_messages["email"]= "";
		}
		if(empty($_POST["password"])){
			$val_messages["password"]="Please enter the password";
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