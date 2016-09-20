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
    var message = '<div class="row"><div class="alert alert-success"><li>';
    message += msg['message'];
    message += '</li></div></div>';
    $('#selectPicStatus').show().html(message); //this is my div with messages
    $('#profilePicture').attr("src", ('/userz/'+msg['username']+'/'+msg['filename']));
  });
});
