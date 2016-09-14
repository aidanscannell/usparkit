function replyToPm(pmid,user,message,btn,osender){
  var data = _(message).value;
  if(data == ""){
    bootbox.alert("Please write a reply.", function() {
        console.log("Alert Callback");
    }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
    return false;
  }
  _(btn).disabled = true;
  var ajax = ajaxObj("POST", "php_parsers/pm_system.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      var datArray = ajax.responseText.split("|");
      if(datArray[0] == "reply_ok"){
        var rid = datArray[1];
        _("replyBtn2"+pmid).disabled = false;
        data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
        _("newReply"+pmid).innerHTML += '<div class="comment clearfix" id="status'+datArray[1]+'"><div class="comment-avatar"><img class="img-circle" src="user/'+user+'/<?php echo $log_avatar; ?>" alt="avatar"></div><header><div class="comment-meta">From <a href="user.php?u='+user+'">'+user+'</a> | just now</div></header><div class="comment-content"><div class="comment-body clearfix"><p>'+data+'</p><a class="btn-sm-link link-dark pull-left" onclick="deletePm(\''+datArray[1]+'\',\'status'+datArray[1]+'\',\''+user+'\',\'reply\')" id="deleteBtn'+datArray[1]+'"><i class="fa fa-close"></i> Delete</a></div></div></div>';
        _(message).value = "";
        bootbox.alert("Your reply has been sent.", function() {
            console.log("Alert Callback");
        }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
      } else {
        bootbox.alert(ajax.responseText, function() {
            console.log("Alert Callback");
        }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
      }
    }
  }
  ajax.send("action=pm_reply&pmid="+pmid+"&user="+user+"&data="+data+"&osender="+osender);
}
function deletePm(pmid,wrapperid,originator,type){
  bootbox.confirm("Press OK to delete.", function(result){
    if (result == true){
      var ajax = ajaxObj("POST", "php_parsers/pm_system.php");
      ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
          if(ajax.responseText == "delete_ok"){
            _(wrapperid).style.display = 'none';
          } else {
            bootbox.alert(ajax.responseText, function() {
                console.log("Alert Callback");
            }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
          }
        }
      }
      ajax.send("action=delete_pm&pmid="+pmid+"&originator="+originator);
    }
  }).find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
}
