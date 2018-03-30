<?php
include('classes/DB.php');
if (isset($_POST['login'])) {
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
?>
<h1>Login to your account</h1>
<form action="login.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="submit" name="login" value="Login">
</form>
