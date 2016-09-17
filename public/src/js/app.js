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
        console.log(msg['message']);
    },
    error: function(data)
    {
        var errors = '<div class="row"><div class="alert alert-danger">';
        for(datos in data.responseJSON){
            errors += '<li>'+data.responseJSON[datos] + '</li>';
        }
        errors += '</div></div>';
        $('#wysiwygStatus').show().html(errors); //this is my div with messages
        console.log(errors);
    }
  })
  .done(function (msg){
    console.log(JSON.stringify(msg));
    $('#wysiwygData').html(msg['richTextFieldSentBack']);
  });
});
