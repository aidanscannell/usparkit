/*function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}*/
/*function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}*/
function signup(){
	var t = _("userType").value;
	var s = _("sponsor").value;
	var uni = _("university").value;
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var c = _("country").value;
	var status = _("status");
	var clubType = _("clubType").value;
	var clubTypeOther = '';
	if (clubType == 'Other'){
		var clubTypeOther = _("clubTypeOther").value;
	}

	var llCheck = (p1.match(/[a-z]/)) ? 1 : 0;
	var clCheck = (p1.match(/[A-Z]/)) ? 1 : 0;
	var nCheck = (p1.match(/[0-9]/)) ? 1 : 0;

	if(clubTypeOther == "" && clubType == "Other"){
		status.innerHTML = "Fill out all of the form data";
	} else if(t == "" || u == "" || e == "" || p1 == "" || p2 == "" || c == "" || clubType == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(s == "" && uni == "" ){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else if(!llCheck || !clCheck || !nCheck){
		status.innerHTML = "Your password must contain lowercase, uppercase and numeric characters";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "../../resources/views/signup.blade.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "Welcome "+u+", please check your email inbox and junk mail box at <u>"+e+"</u> to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				}
	        }
        }
        ajax.send("t="+t+"&s="+s+"&uni="+uni+"&u="+u+"&e="+e+"&p="+p1+"&c="+c+"&clubTypeOther="+clubTypeOther+"&clubType="+clubType);
	}
}
