function showGallery(gallery,user){
  _("galleries").style.display = "none";
  _("section_title").innerHTML = user+'&#39;s Gallery &nbsp; <button class="btn btn-default" onclick="backToGalleries()">Go back to all galleries</button>';
  _("photos").style.display = "block";
  _("photos").innerHTML = 'loading photos ...';
  var ajax = ajaxObj("POST", "php_parsers/photo_system.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      _("photos").innerHTML = '';
      var pics = ajax.responseText.split("|||");
      for (var i = 0; i < pics.length; i++){
        var pic = pics[i].split("|");
        _("photos").innerHTML += '<div><div class="col-xs-12 col-sm-6 col-md-3" id="pic[0]"><img onclick="photoShowcase(\''+pics[i]+'\')" src="user/'+user+'/thumb_'+pic[1]+'" alt="pic"></div></div>';
      }
    }
  }
  ajax.send("show=galpics&gallery="+gallery+"&user="+user);
}
function backToGalleries(){
  _("photos").style.display = "none";
  _("section_title").innerHTML = "<?php echo $u; ?>&#39;s Photo Gallery";
  _("galleries").style.display = "block";
}
function photoShowcase(picdata){
  var data = picdata.split("|");
  _("section_title").style.display = "none";
  _("photos").style.display = "none";
  _("picbox").style.display = "block";
  _("picbox").innerHTML = '<img src="user/<?php echo $u; ?>/'+data[1]+'" alt="photo">';
  _("picbox").innerHTML += '<button class="btn btn-default" onclick="closePhoto()">Close</button>';
  if("<?php echo $isOwner ?>" == "yes"){
    _("picbox").innerHTML += '<input type="button" class="btn btn-default" id="deletelink" onclick="return false;"  onmousedown="deletePhoto(\''+data[0]+'\')" value="Delete this photo"/>';
  }
}
function closePhoto(){
  _("picbox").innerHTML = '';
  _("picbox").style.display = "none";
  _("photos").style.display = "block";
  _("section_title").style.display = "block";
}
function deletePhoto(id){
  var conf = confirm("Press Ok To Delete Photo");
  if(conf != true){
    return false;
  }
  _("deletelink").style.visibility = "hidden";
  var ajax = ajaxObj("POST", "php_parsers/photo_system.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      if(ajax.responseText == "deleted_ok"){
        alert("This picture has been deleted successfully. We will now refresh the page for you.");
        window.location = "photos.php?u=<?php echo $u; ?>";
      }
    }
  }
  ajax.send("delete=photo&id="+id);
}
