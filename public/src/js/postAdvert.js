function iFrameOnAdvert(){
	richTextFieldAdvert.document.designMode = 'On';
}
function iFrameOnRequest(){
	richTextFieldRequest.document.designMode = 'On';
}
function iHeadingAdvert(){
	richTextFieldAdvert.document.execCommand("insertHTML", false, "<h3>"+ richTextFieldAdvert.document.getSelection()+"</h3>");
}
function iHeadingRequest(){
	richTextFieldRequest.document.execCommand("insertHTML", false, "<h3>"+ richTextFieldRequest.document.getSelection()+"</h3>");
}
function iSubHeadingAdvert(){
	richTextFieldAdvert.document.execCommand("insertHTML", false, "<h4>"+ richTextFieldAdvert.document.getSelection()+"</h4>");
}
function iSubHeadingRequest(){
	richTextFieldRequest.document.execCommand("insertHTML", false, "<h4>"+ richTextFieldRequest.document.getSelection()+"</h4>");
}
function iBoldAdvert(){
	richTextFieldAdvert.document.execCommand('bold',false,null);
}
function iBoldRequest(){
	richTextFieldRequest.document.execCommand('bold',false,null);
}
function iUnderlineAdvert(){
	richTextFieldAdvert.document.execCommand('underline',false,null);
}
function iUnderlineRequest(){
	richTextFieldRequest.document.execCommand('underline',false,null);
}
function iItalicAdvert(){
	richTextFieldAdvert.document.execCommand('italic',false,null);
}
function iItalicRequest(){
	richTextFieldRequest.document.execCommand('italic',false,null);
}
function iHorizontalRuleAdvert(){
	richTextFieldAdvert.document.execCommand('inserthorizontalrule',false,null);
}
function iHorizontalRuleRequest(){
	richTextFieldRequest.document.execCommand('inserthorizontalrule',false,null);
}
function iUnorderedListAdvert(){
	richTextFieldAdvert.document.execCommand("InsertOrderedList", false,"newOL");
}
function iUnorderedListRequest(){
	richTextFieldRequest.document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedListAdvert(){
	richTextFieldAdvert.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iOrderedListRequest(){
	richTextFieldRequest.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLinkAdvert(){
	var linkURL = prompt("Enter the URL for this link:", "http://");
	richTextFieldAdvert.document.execCommand("CreateLink", false, linkURL);
}
function iLinkRequest(){
	var linkURL = prompt("Enter the URL for this link:", "http://");
	richTextFieldRequest.document.execCommand("CreateLink", false, linkURL);
}


// Post Advert AJAX
function postAdvert(){
	var theForm = document.getElementById("postAdvertForm");
	var sd = window.frames['richTextFieldAdvert'].document.body.innerHTML;
	var st = _("sponsorship_type").value;
	var csa = _("custom_stash_amount").value;
	var da = _("donation_amount").value;
	var gca = _("gift_card_amount").value;
	var va = _("voucher_amount").value;
	var vt = _("voucherType").value;

	var egArray =  new Array();
	var x=document.getElementById("eligibleGroups");
		for (var i = 0; i < x.options.length; i++) {
			if(x.options[i].selected){
				egArray.push(x.options[i].value);
			}
		}
	egArray.toString();

	var status = _("status");

	if(st == "" || sd == "" || egArray == ""){
		postAdvertStatus.innerHTML = "Fill out all of the form data";
	} else if (csa == "" && da == "" && gca == "" && va == ""){
		postAdvertStatus.innerHTML = "Fill out all of the form data";
	} else {
		_("postAdvertBtn").style.display = "none";
		postAdvertStatus.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "php_parsers/postAdvert.php");
				ajax.onreadystatechange = function() {
					if(ajaxReturn(ajax) == true) {
							if(ajax.responseText != "postAdvert_success"){
					postAdvertStatus.innerHTML = ajax.responseText;
					_("postAdvertBtn").style.display = "block";
				} else {
					_("postAdvertForm").innerHTML = "<p>Your sponsorship advert has been posted.</p>"
				}
					}
				}
				ajax.send("st="+st+"&csa="+csa+"&da="+da+"&gca="+gca+"&va="+va+"&vt="+vt+"&sd="+sd+"&eg="+egArray);
	}
}

// Post Request AJAX
function postRequest(){
	var theForm = document.getElementById("postRequestForm");
	var sd = window.frames['richTextFieldRequest'].document.body.innerHTML;
	var st = _("sponsorship_typeR").value;
	var csa = _("custom_stash_amountR").value;
	var da = _("donation_amountR").value;
	var gca = _("gift_card_amountR").value;
	var va = _("voucher_amountR").value;
	var vt = _("voucherTypeR").value;

	var egArray =  new Array();
	var x=document.getElementById("eligibleGroupsR");
		for (var i = 0; i < x.options.length; i++) {
				if(x.options[i].selected){
					egArray.push(x.options[i].value);
		 }
		}
	egArray.toString();

	if(st == "" || sd == "" || egArray == ""){
		postRequestStatus.innerHTML = "Fill out all of the form data";
	} else if (csa == "" && da == "" && gca == "" && va == ""){
		postRequestStatus.innerHTML = "Fill out all of the form data";
	} else {
		_("postRequestBtn").style.display = "none";
		postRequestStatus.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "php_parsers/postAdvert.php");
				ajax.onreadystatechange = function() {
					if(ajaxReturn(ajax) == true) {
							if(ajax.responseText != "postAdvert_success"){
					postRequestStatus.innerHTML = ajax.responseText;
					_("postRequestBtn").style.display = "block";

				} else {
					_("postRequestForm").innerHTML = "<p>Your sponsorship Request has been posted.</p>"
				}
					}
				}
				ajax.send("st="+st+"&csa="+csa+"&da="+da+"&gca="+gca+"&va="+va+"&vt="+vt+"&sd="+sd+"&eg="+egArray);
	}
}
