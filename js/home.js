$(document).ready(function(){
    $('.submit-message').submit(function(event){
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: 'line.php',
          dataType: "json",
          data: {text: $('.message-input').val()},
          success: function(data) {
            $('.message-input').val("");
            $('.chat-discussion').append('<div class="chat-message left"><img class="message-avatar" src="img/a1.jpg" alt="" ><div class="message"><a class="message-author" href="#">' + data.user + '</a><span class="message-date"> Mon Jan 26 2015 - 18:39:23 </span><span class="message-content">' + data.message + '</span></div></div>');
          },
          error: function() {
          }
        });

    });


  $('.chat-user').submit(function(event){
      event.preventDefault();
       $.ajax({
          type: "POST",
          url: 'change.php',
          dataType: "json",
          data: {chatID: $(this).attr('id')},
          success: function(data) {
              $('.ibox-title').html(data.title);
              $('.chat-discussion').html(data.messages);
          },
          error: function() {
            console.log("error");
          }
        });
  });

});