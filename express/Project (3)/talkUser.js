window.onload = function(){

  var users = document.getElementById('users');

  var con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'eh1105',
    database: 'instagram'
  });

  con.connect(function(err){
    if(err) throw err;
    con.query("SELECT email FROM user", function (err, result, fields){
      if(err) throw err;
      for(var i=0; i<result.length(); i++){
        users.append("<li>"+result[i]['email']+"</li>");
      }
    });
  });
}
