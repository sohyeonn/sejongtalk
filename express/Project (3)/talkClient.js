window.onload = function(){

  var socket = io.connect('http://172.16.11.3:3000');

  var div = document.getElementById('chatZone');
  var txt = document.getElementById('txtTalk');
  txt.focus();

  txt.onkeydown = sendMessage.bind(this);
  function sendMessage(event){
    if(event.keyCode == 13){

      var message = event.target.value;
      if(message){
        socket.emit('serverReceiver', message);
        txt.value = "";
      }
    }
  };

  socket.on('clientReceiver', function(data){
    var message = data.clientId + ": " +data.message;
    div.innerText += message+ '\r\n';
    div.scrollTop = div.scrollHeight;
  });
};
