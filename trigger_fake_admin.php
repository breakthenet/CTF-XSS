<?php

include "mysql.php";

print "The trap is laid! Waiting for an admin to visit your profile...";
print "<br><br>";

$base_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";

$results = shell_exec('phantomjs fake_admin_browser.js --url '.$base_url.' --password '.getenv('CTF_FLAG').' --profileid '.$_GET['profile_id']);

print "We caught an admin! Our XSS caught this information via alert():";
print "<hr>";
print nl2br($results);
print "<hr>";