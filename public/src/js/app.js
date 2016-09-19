$('.wysiwyg').find('#wysiwygBtn1').on('click', function(){
  var richTextField = window.frames['richTextField'].document.body.innerHTML;
  $.ajax({
    method: 'POST',
    url: url,
    data: {richTextFieldContent: richTextField, _token: token},
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

// $('[name^=pmBtn]').on('click', function(e){
//   e.preventDefault();
//   var id = this.id.slice(3);
//   var subject = $('#subject').val();
//   var pm = $('#message').val();
//   $.ajax({
//     method: 'POST',
//     url: 'http://localhost:8000/Message/Send',
//     data: {Subject: subject, Message: pm, _token: token},
//     dataType: 'json',
//     success: function(msg)
//     {
//         var message = '<div class="row"><div class="alert alert-success"><li>';
//         message += msg['message'];
//         message += '</li></div></div>';
//         $('#statusui').show().html(message); //this is my div with messages
//     },
//     error: function(data)
//     {
//         var errors = '<div class="row"><div class="alert alert-danger">';
//         for(datos in data.responseJSON){
//             errors += '<li>'+data.responseJSON[datos] + '</li>';
//         }
//         errors += '</div></div>';
//         $('#statusui').show().html(errors); //this is my div with messages
//         console.log(errors);
//     }
//   })
//   .done(function (msg){
//     console.log(JSON.stringify(msg));
//     //$('#statusui').show().html(msg['message']); //this is my div with messages
//   });
// });

$('[name^=form]').find('#pmBtn').on('click', function(e){
  e.preventDefault();
  var id = this.name.slice(5);
  var subject = $('#subject').val();
  var pm = $('#message').val();
  $.ajax({
    method: 'POST',
    url: 'http://localhost:8000/Message/Send',
    data: {Subject: subject, Message: pm, id: id, _token: token},
    dataType: 'json',
    success: function(msg)
    {
        var message = '<div class="row"><div class="alert alert-success"><li>';
        message += msg['message'];
        message += '</li></div></div>';
        $('#statusui').show().html(message); //this is my div with messages
    },
    error: function(data,msg)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#statusui').show().html(errors); //this is my div with messages
        console.log(errors);

    }
  })
  .done(function (msg){
    console.log(JSON.stringify(msg));
    //$('#statusui').show().html(msg['message']); //this is my div with messages
  });
});

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
