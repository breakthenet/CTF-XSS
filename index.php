<?php
session_start();
$id = $_SESSION['id'];
if (!$id) {
    header("Location: login.php");
    exit;
}

include "mysql.php";

if($_POST['profile_desc']) {
    $profile_desc = mysql_real_escape_string($_POST['profile_desc']);
    mysql_query("UPDATE users SET profile_desc='$profile_desc' WHERE userid=$id");
}

$is = mysql_query("SELECT * FROM users WHERE id='{$id}'") or die(mysql_error());
$ir = mysql_fetch_array($is);
print "<h1>{$ir['username']}'s Profile</h1>";

?>

<fieldset>
  <legend>Profile Description</legend>
  <?=$ir['profile_desc']?>
</fieldset>


<fieldset>
  <legend>Update your Profile Description</legend>
  <form action="index.php" method="post" name="login" id="login">
    Current Value: <textarea name="profile_desc" /><?=$ir['profile_desc']?></textarea><br />
    <input type="submit" value="Submit" />
  </form>
</fieldset>

<br><br><br>
&gt; <a href='logout.php'>LOGOUT</a>
