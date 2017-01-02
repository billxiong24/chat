$(document).ready(function(){
    showNotifs();     
    var height = 100000;
    $('.chat-discussion').animate({ scrollTop: $('#end-chat').position().top }, 'fast');
    refresh = setInterval(function(){
        refreshMessages();
        refreshNotifications();
        refreshChatList();
    }, 100);
    $('.submit-message').submit(function(event){
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: 'line.php',
          dataType: "json",
          data: {text: $('.message-input').val()},
          success: function(data) {
              if(data.deleted){
                  window.location.replace("home.php");
              }
              $('.message-input').val("");
              //$('.chat-discussion').append();
              $('.chat-discussion').scrollTop(height);
              incrementNotifications();
              resetNotifications();
          },
          error: function() {
              console.log("Wat");
          }
        });

    });


  $('#wrapper').on('submit', '.change-chat', function(event){
      event.preventDefault();
       $.ajax({
          type: "POST",
          url: 'change.php',
          dataType: "json",
          data: {chatID: $(this).attr('id')},
          success: function(data) {
              $('.ibox-title .message-title').html(data.title);
              $('.chat-discussion').html(data.messages);
              $('.chat-discussion').scrollTop(height);
              resetNotifications();              
          },
          error: function() {
            console.log("error");
          }
        });
  });
  $('#wrapper').on('submit', '.remove-chat', function(event){
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
  $('.add-user').submit(function(event){
      event.preventDefault();
       $.ajax({
          type: "POST",
          url: "adduser.php",
          dataType: "json",
          data: {useradd: $('.add-user-info').val()},
          success: function(data) {
              if(data.duplicate)
                  $('.ibox-title .message-title').html(data.new_title);
              $('.add-user-info').val("");
          },
          error: function() {
            console.log("error");
          }
        });
  });
  $('.message-input').focus(function(){

  });
    
  function refreshChatList(){
       $.ajax({
          type: "POST",
          url: "refreshChatList.php",
          dataType: "json",
          data: {test: "hello"},
          success: function(data) {
              if(data.change){
                $('.users-list').html(data.newList);
              }
          },
          error: function() {
            console.log("refreshchat error");
          }
        });
      
  } 
  function resetNotifications(){
       $.ajax({
          type: "POST",
          url: "resetNotif.php",
          dataType: "json",
          data: {test: "hello"},
          success: function(data) {

          },
          error: function() {
            console.log("error");
          }
        });
  }
  function refreshMessages(){
      $.ajax({
          type: "POST",
          url: 'refresh.php',
          dataType: "json",
          data: {test: "hello"},
          success: function(data){
              if(!data.logged_in){
                  window.location.replace("index.php");
              }
              else if(data.change){
                  var chat = $('.chat-discussion');
                  chat.append(data.messages);
                  chat.scrollTop(height);
              }
          },
          error: function(){
              console.log("error");
          }
      });
  }
  function incrementNotifications(){
      $.ajax({
          type: "POST",
          url: 'incrementNotif.php',
          dataType: "json",
          data: {test: "hello"},
          success: function(data){

          },
          error: function(){
              console.log("incr error");
          }
      });
  }

  function refreshNotifications(){
      $.ajax({
          type: "POST",
          url: 'refreshNotifications.php',
          dataType: "json",
          data: {test: "hello"},
          success: function(data){
              if(data.changed){
                  $.each(data.notifications, function(index, val){
                      var element = $('#' + index).find('.notif');
                      if(val != 0){
                          element.show();
                          element.text(val);
                      }
                      else{
                          element.hide();
                      }
                  });
                 /*$('.users-list').find('.notif').each(function(index){
                     console.log($(this).text());
                 });*/
              }
          },
          error: function(){
              console.log("error");
          }
      });

  }
  function showNotifs(){
    $('.notif').each(function(index, object){
        if($(object).text() != 0){
            $(object).css('display', 'inline-block');
        }
    });
  }
  
});
