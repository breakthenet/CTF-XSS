<?php

include "mysql.php";

print "Admin login/browse process triggered.<br><br>Running...";

$base_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";
print "Base URL = ".$base_url;
print "<br><br>";

$profile_id = 2;
$results = shell_exec('phantomjs fake_admin_browser.js --url '.$base_url.' --password '.getenv('CTF_FLAG').' --profileid '.$profile_id);

print "Results:";
print "<hr>";
print nl2br($results);
print "<hr>";