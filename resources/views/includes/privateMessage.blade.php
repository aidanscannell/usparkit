<?php
// Script included on user page for sending private message
// If user is on pm page, add search contact box otherwise do not
$whatPageCheck = $_SERVER['PHP_SELF'];

// Initialize our ui
$pm_ui = "";
// Build ui carry the profile id, vistor name, pm subject and comment to js
if($pageOwner->username != $userOwner->username &&  $_SERVER['PHP_SELF'] == "/index.php/User"){
	$pm_ui = "";
	$pm_ui = '<div class="center-block p-30 light-gray-bg border-clear "><div class="comments-form">
    <h2 class="title">Send a Private Message</h2>
    <form id="form" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
		<div class="form-group has-feedback">
        <label for="subject1">Subject</label>
        <input class="form-control" rows="8" id="subject1" placeholder="" onkeyup="statusMax(this,50)" required>
        <i class="fa fa-navicon form-control-feedback"></i>
      </div>
      <div class="form-group has-feedback">
        <label for="message1">Message</label>
        <textarea class="form-control" rows="8" id="message1" placeholder="" onkeyup="statusMax(this,300)" required></textarea>
        <i class="fa fa-envelope-o form-control-feedback"></i>
      </div>
      <button id="pmBtn" type="button" class="btn btn-default" onclick="postPm(\''.$u.'\',\''.$log_username.'\',\'subject1\',\'message1\')">Post</button>
    </form>
  </div>
	</div>';

}
// If user is on pm inbox
if($whatPageCheck != "/main_website/root/user.php"){
	$pm_ui = "";
	$pm_ui = '<div class="comments-form center-block p-30 light-gray-bg border-clear">
    <!--<h2 class="title">Send a Private Message</h2>-->
		<h3 class="title">Send a New Message</h3>
		<div class="separator-2"></div>
    <form id="form" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
		<div class="form-group has-feedback">
		<label for="recipient">To</label>
		<input type="text" class="form-control" id="recipient">
		<i class="fa fa-search form-control-feedback"></i>
	</div>
	<div class="form-group has-feedback">
        <label for="subject1">Subject</label>
        <input class="form-control" rows="8" id="subject1" placeholder="" onkeyup="statusMax(this,50)" required>
        <i class="fa fa-navicon form-control-feedback"></i>
      </div>
      <div class="form-group has-feedback">
        <label for="message1">Message</label>
        <textarea class="form-control" rows="8" id="message1" placeholder="" onkeyup="statusMax(this,300)" required></textarea>
        <i class="fa fa-envelope-o form-control-feedback"></i>
      </div>
      <button id="pmBtn" type="button" class="btn btn-default" onclick="postPm(\'recipient\',\''.$log_username.'\',\'subject1\',\'message1\')">Post</button>
    </form>
  </div>';
}
?>
<script>
function postPm(tuser,fuser,subject1,message1){
  var data = _(subject1).value;
	var data2 = _(message1).value;
	var data3 = tuser;
	var flag = false;
	if (tuser == 'recipient'){
		var flag = true;
		var data3 = _(tuser).value;
		if(data3 == ""){
			//alert("Please fill all fields");
			bootbox.alert("Please fill all fields", function() {
					console.log("Alert Callback");
			}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
			return false;
		}
	}
	if(data == "" || data2 == ""){
		//alert("Please fill all fields");
		bootbox.alert("Please fill all fields", function() {
				console.log("Alert Callback");
		}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
		return false;
	} else {
  	_("pmBtn").disabled = true;
  	var ajax = ajaxObj("POST", "php_parsers/pm_system.php");
  	ajax.onreadystatechange = function() {
  		if(ajaxReturn(ajax) == true) {
  			if(ajax.responseText == "pm_sent"){
  				//alert("Your message has been sent.");
					bootbox.alert("Your message has been sent.", function() {
							console.log("Alert Callback");
					}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
  				_("pmBtn").disabled = false;
  				_(subject1).value = "";
  				_(message1).value = "";
					if(flag = true){
						_(recipient).value = "";
					}
  			} else {
  				//alert(ajax.responseText);
					bootbox.alert(ajax.responseText, function() {
							console.log("Alert Callback");
							location.reload('/Applications/MAMP/htdocs/main_website/root');
					}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
  			}
  		}
  	}
  	ajax.send("action=new_pm&fuser="+fuser+"&tuser="+data3+"&data="+data+"&data2="+data2);
  }
}
function statusMax(field, maxlimit) {
	if (field.value.length > maxlimit){
		//alert(maxlimit+" maximum character limit reached");
		bootbox.alert(maxlimit+" maximum character limit reached", function() {
				console.log("Alert Callback");
		}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
		field.value = field.value.substring(0, maxlimit);
	}
}
</script>
<div id="statusui">
  <?php echo $pm_ui; ?>
</div>
