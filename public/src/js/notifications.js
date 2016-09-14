function friendReqHandler(action,reqid,user1,elem){
  bootbox.confirm("Press OK to "+action+" this connection request.", function(result){
    if (result == true){
      //_(elem).innerHTML = "processing ...";
      var ajax = ajaxObj("POST", "php_parsers/friend_system.php");
      ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
          if(ajax.responseText == "accept_ok"){
            //_(elem).innerHTML = "<b>Request Accepted</b><br />Your are now connected.";
            bootbox.alert("You are now connected.", function() {
                console.log("Alert Callback");
                window.location = "notifications.php";
            }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
          } else if(ajax.responseText == "reject_ok"){
            //_(elem).innerHTML = "<b>Request Rejected.</b><br />You chose to reject the connection offer.";
            bootbox.alert("Connection request rejected.", function() {
                console.log("Alert Callback");
                window.location = "notifications.php";
            }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
          } else {
            //_(elem).innerHTML = ajax.responseText;
            bootbox.alert(ajax.responseText, function() {
                console.log("Alert Callback");
                window.location = "notifications.php";
            }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
          }
        }
      }
      ajax.send("action="+action+"&reqid="+reqid+"&user1="+user1);
    }
  }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}

function markRead(id){
  var ajax = ajaxObj("POST", "php_parsers/notifications.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      if (ajax.responseText == 'success'){
        _('notification'+id).style.display = 'none';
      }
    }
  }
  ajax.send("action=markRead&id="+id);
}
