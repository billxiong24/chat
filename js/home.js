$(document).ready(function(){
    refresh = setInterval(function(){
       refreshMessages();
    }, 100);

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


  $('.change-chat').submit(function(event){
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
  $('.remove-chat').submit(function(event){
      event.preventDefault();
       $.ajax({
          type: "POST",
          url: "remove.php",
          dataType: "json",
          data: {removeID: $(this).attr('id')}, 
          success: function(data) {
              //$('.users-list').html(data.list);
              window.location.replace("home.php");
          },
          error: function() {
            console.log("error");
          }
        });
  });
  function refreshMessages(){
      $.ajax({
          type: "POST",
          url: 'refresh.php',
          dataType: "json",
          data: {test: "hello"},
          success: function(data){
              $('.chat-discussion').html(data.messages);
              //refreshing chat list works, but reloading all chat lists, which is not good
              //$('.users-list').html(data.chats);
              //data.chats contains chat list
              //console.log(data.t);
              //console.log(data.messages);
          },
          error: function(){
              console.log("error");
          }
      });
  }
  
});
