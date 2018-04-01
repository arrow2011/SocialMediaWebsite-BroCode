<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        if (isset($_POST['changepassword'])) {
                $oldpassword = $_POST['oldpassword'];
                $newpassword = $_POST['newpassword'];
                $newpasswordrepeat = $_POST['newpasswordrepeat'];
                $userid = Login::isLoggedIn();
                if (password_verify($oldpassword, DB::query('SELECT password FROM user WHERE user_id=:userid', array(':userid'=>$userid))[0]['password'])) {
                        if ($newpassword == $newpasswordrepeat) {
                                if (strlen($newpassword) >= 6 && strlen($newpassword) <= 60) {
                                        DB::query('UPDATE user SET password=:newpassword WHERE user_id=:userid', array(':newpassword'=>password_hash($newpassword, PASSWORD_BCRYPT), ':userid'=>$userid));
                                        echo 'Password changed successfully!';

                                }
                        } else {
                                echo 'Passwords don\'t match!';
                        }
                } else {
                        echo 'Incorrect old password!';
                }
        }
} else {
        die('Not logged in');
}
?>
<h1>Change your Password</h1>
<form action="changePassword.php" method="post">
        <input type="password" name="oldpassword" value="" placeholder="Current Password ..."><p />
        <input type="password" name="newpassword" value="" placeholder="New Password ..."><p />
        <input type="password" name="newpasswordrepeat" value="" placeholder="Repeat Password ..."><p />
        <input type="submit" name="changepassword" value="Change Password">
</form>

