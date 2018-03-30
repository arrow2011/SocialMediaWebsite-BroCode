<?php
include('classes/DB.php');

if(isset($_POST['createaccount'])) {
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

<h1>Register</h1>
<form action="create-account.php" method="post">
<input type="text" name="username" value="" placeholder="Username..."><p />
<input type="text" name="name" value="" placeholder="Name..."><p />
<input type="password" name="password" value="" placeholder="Password..."><p />
<input type="email" name="email" value="" placeholder="Email-id..."><p />
<input type="submit" name="createaccount" value="Create Account">
</form>

