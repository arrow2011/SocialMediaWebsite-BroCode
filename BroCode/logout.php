<?php
include('./classes/DB.php');

function isLoggedIn() {
        if (isset($_COOKIE['SNID'])) {
                if (DB::query('SELECT user_id FROM login_table WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
                        $userid = DB::query('SELECT user_id FROM login_table WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
                                return $userid;
                        }
	}
        return false;
}

if (!isLoggedIn()) {
        die("Not logged in.");
}
if (isset($_POST['confirm'])) {
        if (isset($_POST['alldevices'])) {
                DB::query('DELETE FROM login_table WHERE user_id=:userid', array(':userid'=>isLoggedIn()));
        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_table WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                
        }
	
	
	header('Location: welcome.html');
	echo "Logged out.";
}
?>
<h1>Logout of your Account?</h1>
<p>Check the box to log out of all devices. Leave it unchecked it you wanna log out of only this device.</p>
<form action="logout.php" method="post">
        <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
        <input type="submit" name="confirm" value="Confirm">
</form>
