// Select Photo Javascript
function selectPhoto(id){
	bootbox.confirm("Press OK to change your profile picture.", function(result){
		if (result == true){
			_("selectlink"+id).style.visibility = "hidden";
			var ajax = ajaxObj("POST", "php_parsers/photo_system.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					if(ajax.responseText == "selected_ok"){
						 bootbox.alert("Your profile picture has been changed. The page will now be refreshed.", function() {
								 console.log("Alert Callback");
								 window.location = "user.php?u=<?php echo $u; ?>";
						 }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					}
				}
			}
			var num = id;
			var idNew = num.toString();
			ajax.send("select=photo&id="+idNew);
		}
	}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}

function friendToggle(type,user,elem){
	var displayMessage = "";
	var user_space = user.replace("-", " ");
	if (type=='friend'){
		var displayMessage = "Press OK if you want to send a connection request to "+user_space+".";
	} else if (type=='unfriend') {
		var displayMessage = "Press OK if you want to remove "+user_space+" as a connection.";
	}
	bootbox.confirm(displayMessage, function(result){
		if (result == true){
			_(elem).innerHTML = 'please wait ...';
			var ajax = ajaxObj("POST", "php_parsers/friend_system.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					if(ajax.responseText == "friend_request_sent"){
						_(elem).innerHTML = 'Connection Request Sent';
						bootbox.alert("Connection Request Sent", function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else if(ajax.responseText == "unfriend_ok"){
						//_(elem).innerHTML = '<button class="btn btn-default" onclick="friendToggle(\'friend\',\''+user+'\',\'friendBtn\')">Request Connection</button>';
						bootbox.alert("Connection Removed", function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else {
						//alert(ajax.responseText);
						//_(elem).innerHTML = 'Try again later';
						bootbox.alert(ajax.responseText, function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					}
				}
			}
			ajax.send("type="+type+"&user="+user);
		}
	}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}

function blockToggle(type,blockee,elem){
	var displayMessage = "";
	if (type=='block'){
		var displayMessage = "Press OK if you want to block this user.";
	} else if (type=='unblock') {
		var displayMessage = "Press OK if you want to unblock this user.";
	}
	bootbox.confirm(displayMessage, function(result){
		if (result == true){
			var elem = document.getElementById(elem);
			elem.innerHTML = 'please wait ...';
			var ajax = ajaxObj("POST", "php_parsers/block_system.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					if(ajax.responseText == "blocked_ok"){
						//elem.innerHTML = '<button class="btn btn-default" onclick="blockToggle(\'unblock\',\''+blockee+'\',\'blockBtn\')">Unblock</button>';
						bootbox.alert("Block successfull.", function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else if(ajax.responseText == "unblocked_ok"){
						//elem.innerHTML = '<button class="btn btn-default" onclick="blockToggle(\'block\',\''+blockee+'\',\'blockBtn\')">Block</button>';
						bootbox.alert("Unblock successfull.", function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else {
						//alert(ajax.responseText);
						//elem.innerHTML = 'Try again later';
						bootbox.alert(ajax.responseText, function() {
								console.log("Alert Callback");
								window.location = "user.php?u=<?php echo $u; ?>";
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					}
				}
			}
			ajax.send("type="+type+"&blockee="+blockee);
		}
	}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}

// Delete Photo AJAX Javascript
function deletePhoto(id){
	bootbox.confirm("Press OK to delete picture.", function(result){
		if (result == true){
		_("deletelink").style.visibility = "hidden";
		var ajax = ajaxObj("POST", "php_parsers/photo_system.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "deleted_ok"){
					bootbox.alert("The picture has been deleted successfully. The page will now be refreshed.", function() {
							console.log("Alert Callback");
							window.location = "user.php?u=<?php echo $u; ?>";
					}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				}
			}
		}
		ajax.send("delete=photo&id="+id);
	};
}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");;
};

// Javascript to show and hide delete and make profile picture photos
function toggleSelectDelete(x,y){
	var x = _(x);
	var y = _(y);
	if(x.style.display == 'block' && y.style.display == 'none'){
		x.style.display = 'none';
	} else if (x.style.display == 'none' && y.style.display == 'block') {
		y.style.display = 'none';
		x.style.display = 'block';
	} else if (x.style.display == 'none' && y.style.display == 'none') {
		x.style.display = 'block';
		y.style.display = 'none';
	}
}

// Javascript to show WYSIWYG profile form
function makeEditable(div,div1){
		if (div.style.display == "none") {
			div.style.display = "block";
			div1.style.display = "none";
		} else {
			div.style.display = "none";
			div1.style.display = "block";
	}
}

// WYSIWYG Edit Content Javascript
function iFrameOn(){
	richTextField.document.designMode = 'On';
}
function iHeading(){
	richTextField.document.execCommand("insertHTML", false, "<h3>"+ richTextField.document.getSelection()+"</h3>");
}
function iSubHeading(){
	richTextField.document.execCommand("insertHTML", false, "<h4>"+ richTextField.document.getSelection()+"</h4>");
}
function iBold(){
	richTextField.document.execCommand('bold',false,null);
}
function iUnderline(){
	richTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	richTextField.document.execCommand('italic',false,null);
}
function iHorizontalRule(){
	richTextField.document.execCommand('inserthorizontalrule',false,null);
}
function iUnorderedList(){
	richTextField.document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedList(){
	richTextField.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLink(){
	var linkURL = prompt("Enter the URL for this link:", "http://");
	richTextField.document.execCommand("CreateLink", false, linkURL);
}

// WYSIWYG AJAX Javascript
function submit_form(){
	var theForm = document.getElementById("wysiwyg");
	//theForm.elements["wysiwygTextArea"].value = window.frames['richTextField'].document.body.innerHTML;
	//theForm.submit();
	var userInputData = window.frames['richTextField'].document.body.innerHTML;

	if(userInputData == ""){
		wysiwygStatus.innerHTML = "Please insert text";
	} else {
		_("wysiwygBtn").style.display = "none";
		wysiwygStatus.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "php_parsers/wysiwygParser.php");
				ajax.onreadystatechange = function() {
					if(ajaxReturn(ajax) == true) {
							if(ajax.responseText != "wysiwyg_success"){
								//wysiwygStatus.innerHTML = ajax.responseText;
								bootbox.alert("New record created successfully.", function() {
										console.log("Alert Callback");
										_("wysiwygBtn").style.display = "block";
										window.location = "user.php?u=<?php echo $u; ?>";
								}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
							} else {
								window.scrollTo(0,0);
								_("wysiwygBtn").style.display = "";
								wysiwygStatus.innerHTML = '';
								//_("wysiwyg").innerHTML = '';
							}
					}
				}
				ajax.send("description="+userInputData);
	}
}

/*function friendToggle(type,user,elem){
	var displayMessage = "";
	if (type=='friend'){
		var displayMessage = "Press OK if you want to send a connection request to "+user+".";
	} else if (type=='unfriend') {
		var displayMessage = "Press OK if you want to remove "+user+" as a connection.";
	}

	bootbox.confirm(displayMessage, function(result){
		if (result == true){
			_(elem).innerHTML = 'please wait ...';
			var ajax = ajaxObj("POST", "php_parsers/friend_system.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					if(ajax.responseText == "friend_request_sent"){
						//_(elem).innerHTML = 'Connection Request Sent';
						bootbox.alert("Connection Request Sent", function() {
								console.log("Alert Callback");
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else if(ajax.responseText == "unfriend_ok"){
						//_(elem).innerHTML = '<button class="btn btn-default" onclick="friendToggle(\'friend\',\''+user+'\',\'friendBtn\')">Request Connection</button>';
						bootbox.alert("Connection Removed", function() {
								console.log("Alert Callback");
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					} else {
						//alert(ajax.responseText);
						//_(elem).innerHTML = 'Try again later';
						bootbox.alert(ajax.responseText, function() {
								console.log("Alert Callback");
						}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
					}
				}
			}
			ajax.send("type="+type+"&user="+user);
		}
	}).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}
function blockToggle(type,blockee,elem){
	var displayMessage = "";
	if (type=='block'){
		var displayMessage = "Press OK if you want to block this user.";
	} else if (type=='unblock') {
		var displayMessage = "Press OK if you want to unblock this user.";
	}
	var conf = confirm(displayMessage);
	if(conf != true){
		return false;
	}
	var elem = document.getElementById(elem);
	elem.innerHTML = 'please wait ...';
	var ajax = ajaxObj("POST", "php_parsers/block_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "blocked_ok"){
				elem.innerHTML = '<button class="btn btn-default" onclick="blockToggle(\'unblock\',\''+blockee+'\',\'blockBtn\')">Unblock</button>';
			} else if(ajax.responseText == "unblocked_ok"){
				elem.innerHTML = '<button class="btn btn-default" onclick="blockToggle(\'block\',\''+blockee+'\',\'blockBtn\')">Block</button>';
			} else {
				alert(ajax.responseText);
				elem.innerHTML = 'Try again later';
			}
		}
	}
	ajax.send("type="+type+"&blockee="+blockee);
}*/
