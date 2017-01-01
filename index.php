<?php
session_start();
$id = $_SESSION['id'];
if (!$id) {
    header("Location: login.php");
    exit;
}
header('X-XSS-Protection: 0');
include "mysql.php";

if($_POST['profile_desc']) {
    $profile_desc = mysql_real_escape_string($_POST['profile_desc']);
    mysql_query("UPDATE users SET profile_desc='$profile_desc' WHERE id=$id");
}

$id = $_GET['id'];

$is = mysql_query("SELECT * FROM users WHERE id='{$id}'") or die(mysql_error());
$ir = mysql_fetch_array($is);
print "<h1>{$ir['username']}'s Profile</h1>";

?>
<fieldset>
  <legend><select disabled='disabled' alt='Only admins can view all players profiles'>
    <option><?=$ir['username']?></option>
</select>'s Profile</legend>
  <?=$ir['profile_desc']?>
</fieldset>

<br><br>

<fieldset>
  <legend>Update your Profile Description</legend>
  <form action="index.php" method="post" name="login" id="login">
    Current Value: <textarea id="profile_desc" name="profile_desc" rows=5 cols=10 /><?=$ir['profile_desc']?></textarea><br />
    <input type="submit" value="Submit" />
  </form>
</fieldset>

<br><br><br>
&gt; <a href='logout.php'>LOGOUT</a>
