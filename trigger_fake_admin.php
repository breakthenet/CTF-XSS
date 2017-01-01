<?php

session_start();
if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}
$userid = $_SESSION['userid'];
include "mysql.php";
$is = mysql_query("SELECT u.*,us.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid WHERE u.userid=$userid") or die(mysql_error());
$ir = mysql_fetch_array($is);

print "Admin login/browse process triggered.<br><br>Running...";

$base_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";
print "Base URL = ".$base_url;
print "<br><br>";

$results = shell_exec('phantomjs fake_admin_browser.js --url '.$base_url);

print "Results:";
print "<hr>";
print nl2br($results);
print "<hr>";