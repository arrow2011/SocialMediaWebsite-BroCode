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
if (isLoggedIn()) {
        echo 'Logged In User : ';
        echo isLoggedIn();
} else {
        echo 'Not logged in';
}
?>
