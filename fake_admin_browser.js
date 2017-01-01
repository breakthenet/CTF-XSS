// Locally: phantomjs fake_admin_browser.js --url test.com
// Heroku: /app/vendor/phantomjs/bin/phantomjs fake_admin_browser.js --url test.com

var system = require('system');
var base_url = "http://localhost:8888/";
var password = "";
var profileid = 0;

if (system.args.length === 1) {
    console.log('Try to pass some args when invoking this script!');
} else {
    system.args.forEach(function (arg, i) {
        if (i == 2) {
            base_url = arg;
        }
        if (i == 4) {
            password = arg;
        }
        if (i == 6) {
            profileid = arg;
        }
    });
}

function open_target_profile(profileid) {
    var userprofilepage = require('webpage').create();
    console.log("spot 1");
    userprofilepage.onAlert = function(alertmsg) {
        console.log("ALERT:", alertmsg);
        return true;
    }
    userprofilepage.open(base_url+"index.php?id="+profileid, function (status) {
        if (status !== "success") {
            console.log("Failed opening "+base_url+profileurl);
        } else {
            console.log("Successfully opened "+base_url+profileurl);
        }
        setTimeout(function(){
            phantom.exit(0);
        }, 3000);
    });
}

var loginpage = require('webpage').create();
loginpage.open(base_url+'authenticate.php', 'post', 'username=admin&password='+password+'&save=OFF', function (status) {
    if (status !== 'success') {
        console.log('********Login failed!!!!');
        console.log(loginpage.content);
    } else {
        console.log('Login successful.');
    }

    open_target_profile(profileid);
});
