window.onload = function(){

  var ID = document.getElementById('userInfo');

  
  var con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'eh1105',
    database: 'instagram'
  });

  alert("success");

  con.connect(function(err){
    alert("success");
    if(err) throw err;
    con.query("SELECT email FROM loginstate", function (err, result, fields){
      if(err) throw err;
        alert(result[0].email);
    });
  });
}
