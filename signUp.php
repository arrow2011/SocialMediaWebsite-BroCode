
<?php
include('classes/DB.php');
if (isset($_POST['Login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (DB::query('SELECT user_id FROM user WHERE user_id=:username', array(':username'=>$username))) {
                if (password_verify($password, DB::query('SELECT password FROM user WHERE user_id=:username', array(':username'=>$username))[0]['password'])) {
                        echo 'Logged in!';
                } else {
                        echo 'Incorrect Password!';
                }
        } else {
                echo 'User not registered!';
        }
}

if(isset($_POST['Signup'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email =  $_POST['email'];
	$name = $_POST['name'];
	
	if(!DB::query('SELECT user_id FROM user WHERE user_id=:username', array(':username'=> $username))){
	
		if(strlen($username) >= 3 && strlen($username) <= 20){
		
			if(preg_match('/[a-zA-Z0-9_]+/', $username)){
				
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				
					DB::query('INSERT INTO user VALUES(:username, :name, :email, :password)',array(':username'=>$username, ':name'=>$name, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
					echo "Account Created..."; 
				}
				else {
					echo 'Invalid email.';
				}
			}
			else{
				echo "Invalid Username.	Should contain alphabets, numbers and underscore. ";
			}
		}
		else{
			echo "Invalid Username. Should be of length between 3 to 20.";
		}
	}
	else{
		echo "Change Username, already exists";
	}
}
?>




