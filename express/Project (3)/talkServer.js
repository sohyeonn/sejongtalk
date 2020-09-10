var app = require('express')();
var http = require('http');
var url = require('url');
var mysql = require('mysql');

//요청에 대한 응답
app.get("/", function(req, res){
  console.log("get:Main.html");
  res.sendFile("Main.html", {root:__dirname});

  con.connect(function(err){
    if(err) throw err;
    con.query("SELECT email FROM loginstate", function (err, result, fields){
      if(err) throw err;
      fs.appendFile('myID.txt', result[0].email, function(err){
        if(err) throw err;
        //con.query("DELETE FROM loginstate WHERE email='"+result[0].email+"'", function(err){
        //  if(err) throw err;
        //  console.log('delete');
        //});
      });
    });
  });

});

app.use(function(req, res){
  var fileName = url.parse(req.url).pathname.replace("/","");
  res.sendFile(fileName, {root:__dirname});
  console.log("use:", fileName);
});

var con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'eh1105',
  database: 'instagram'
});
//ID확인

//서버생성
var server = http.createServer(app).listen(3000, function(){
  console.log("Start Express Server..3000");
});

var socket = require('socket.io').listen(server);
console.log("Ready Socket Server..");

socket.sockets.on('connection', function(client){
  var Id = "홍길동";

  client.on('serverReceiver', function(value){
    socket.sockets.emit('clientReceiver', {clientId:Id, message:value});
  });
});
