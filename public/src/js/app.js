$('#mainWysiwyg').find('#mainWysiwygBtn').on('click', function(e){
  e.preventDefault();
  var richTextField = window.frames['richTextField'].document.body.innerHTML;
  $.ajax({
    method: 'POST',
    url: url,
    data: {richTextField: richTextField, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#wysiwygStatus').show().html(message); //this is my div with messages
    },
    error: function(data)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#wysiwygStatus').show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    $('#wysiwygData').html(msg['richTextFieldSentBack']);
  });
});

// AJAX for advert modal private message on user page
$('[name^=form]').find('#pmBtn').on('click', function(e){
  e.preventDefault();
  var id = this.name.slice(5);
  var subject = $('#'+id+'Subject').val();
  var message = $('#'+id+'Message').val();
  var recipient = $('#'+id+'Recipient').val();
  $.ajax({
    method: 'POST',
    url: url2,
    data: {recipient: recipient, subject: subject, message: message, id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#advertModalStatus'+id).show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#advertModalStatus'+id).show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#advertModalStatus'+id).show().html(message); //this is my div with messages
  });
});

// AJAX for private message on user page
$('#messagingFormMain').find('#mainPmBtn').on('click', function(e){
  e.preventDefault();
  var subject = $('#mainSubject').val();
  var message = $('#mainMessage').val();
  var recipient = $('#mainRecipient').val();
  $.ajax({
    method: 'POST',
    url: url2,
    data: {recipient: recipient, subject: subject, message: message, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#mainPmStatus').show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#mainPmStatus').show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#mainPmStatus').show().html(message); //this is my div with messages
  });
});

// AJAX form private messaging on inbox page with recipient
$('#pmForm').find('#pmBtn').on('click', function(e){
  e.preventDefault();
  var recipient = $('#recipient').val();
  var subject = $('#subject').val();
  var pm = $('#message').val();
  $.ajax({
    method: 'POST',
    url: url,
    data: {recipient: recipient, subject: subject, message: pm, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#pmFormStatus').show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#pmFormStatus').show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#pmFormStatus').show().html(message); //this is my div with messages
  });
});

// AJAX for reply on messages page
$('[name^=replyForm]').find('#replyBtn').on('click', function(e){
  e.preventDefault();
  var id = this.name.slice(8);
  var recipient = $('#recipient'+id).val();
  var pm = $('#message'+id).val();
  $.ajax({
    method: 'POST',
    url: url2,
    data: {recipient: recipient, message: pm, id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#replyStatus'+id).show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#replyStatus'+id).show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    //console.log(JSON.stringify(msg));
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#replyStatus'+id).show().html(message); //this is my div with messages
    location.reload();
    //$('#newReply'+id).show().html('<div class="comment clearfix" id="status'+id+'"><div class="comment-avatar"><img class="img-circle" src="/userz/{{ Auth::user()->username }}/{{ Auth::user()->avatar }}" alt=""></div><header><div class="comment-meta">From  | </div></header><div class="comment-content"><div class="comment-body clearfix"><p></p><a class="btn-sm-link link-dark pull-left"  id="deleteBtn'+id+'"><i class="fa fa-close"></i> Delete </a></div></div></div>')
  });
});

// AJAX for delete reply on messages page
$('[name^=replyMessages]').find('#deleteBtn').on('click', function(){
  //e.preventDefault();
  var id = this.name.slice(9);
  var ids = id.split('-');
  var reply_id = ids[0];
  var msg_id = ids[1];
  $.ajax({
    method: 'POST',
    url: url3,
    data: {msg_id: msg_id, reply_id: reply_id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#replyStatus'+msg_id).show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#replyStatus'+msg_id).show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    console.log(JSON.stringify(msg));
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#replyStatus'+msg_id).show().html(message); //this is my div with messages
  });
});

// AJAX for select profile picture on user page
$('#modalListSelect').find('[name=selectLink]').on('click', function(e){
  e.preventDefault();
  var id = this.id.slice(10);
  $.ajax({
    method: 'POST',
    url: url3,
    data: {id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#selectPicStatus').show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#selectPicStatus').show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    var message = '<div class="row" style="padding-left:20px;padding-right:20px;"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#selectPicStatus').show().html(message); //this is my div with messages
    $('#profilePicture').attr("src", ('/userz/'+msg['username']+'/'+msg['filename']));
  });
});

// AJAX for delete picture on user page
$('#modalListDelete').find('[name=deleteLink]').on('click', function(e){
  e.preventDefault();
  var id = this.id.slice(10);
  $.ajax({
    method: 'POST',
    url: url4,
    data: {id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#deletePicStatus').show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#deletePicStatus').show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    var message = '<div class="row" style="padding-left:20px;padding-right:20px;"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#deletePicStatus').show().html(message); //this is my div with messages
    $('#deleteDiv'+id).hide();
    // $('#image'+msg['filename']).hide();
  });
});

// AJAX for mark notification as read
$('[name=notification]').find('[name=markAsRead]').on('click', function(e){
  // e.preventDefault();
  var id = this.id.slice(10);
  $.ajax({
    method: 'POST',
    url: url,
    data: {id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#notificationStatus'+id).show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#notificationStatus'+id).show().html(errors); //this is my div with messages
    }
  })
  .done(function (msg){
    // console.log(JSON.stringify(msg));
    var message = '<div class="row" style="padding-left:20px;padding-right:20px;"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#notificationStatus'+id).show().html(message); //this is my div with messages
    $('#notification'+id).hide();
  });
});
