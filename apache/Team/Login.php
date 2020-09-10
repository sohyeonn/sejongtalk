<?php
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; width: 50%; margin-left: 25%; margin-top: 6%;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

button {
    background-color: #ba1228;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    color: #ba1228;
    background-color: white;
    border: 1px solid #ba1228;
}

.profile {


}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.mark {
    width: 40%;

}
.cancelbtn {
    padding: 14px 20px;
    background-color: hsl(0, 0%, 47%);
}


.cancelbtn, .signupbtn {
  float: left;
  width: 50%;

}
.container {
    padding: 16px;
}


.sign{
  color: #ba1228;
  background-color: white;
  border: 1px solid #ba1228;
}

.sign:hover {
    color: white;
    background-color: #ba1228;
}

.bg {
    background-image: url("project/sejong.jpeg");
    height: 100%;
    background-image: center;
    background-repeat: no-repeat;


}
h1 {
  color: #ba1228;
  position: center;
}
h1, .container, .bg {
  position: center;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0, 0.8);
    padding-top: 50px;
}


.modal-content {
    background-color: #fefefe;
    margin: 0 auto 15% auto;
    border: 1px solid #888;
    width: 40%;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

.close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
#Avatar {
  height: 100px;
  weight: 100px;
}

@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
</head>
<body>


<form action="login_process.php" method="post">
  <div class="imgcontainer">
    <img src="mark.png" alt="login" class="mark">
    <br><br><br>
    <img src="user.png" alt="login" class="profile" width= "100px">
  </div>


  <div class="container">
    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="email" id="userID" required>

    <label for="pw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pw" required>

    <button type="submit" onClick="saveID()">Login</button>
    <script>
      function saveID(){
        var userID = document.getElementById("userID").value;
        // sessionStorage.setItem("ID", userID);
        //document.cookie = userID;
        //alert(document.cookie);
        var origin = "http://localhost:3000";
        window.parent.postMessage(userID, origin);
      }
    </script>
    <?php
    if(isset($_SESSION['email_error'])||isset($_SESSION['password_error'])){
      if($_SESSION['email_error']){
        echo '<div style="color:red">'.$_SESSION['email_error_message'].'</div>';
        session_unset('email_error_message');
        session_unset('password_error_message');
      }
      else{
        echo '<div style="color:red">'.$_SESSION['password_error_message'].'</div>';
        session_unset('error_message');
        session_unset('email_error_message');
      }
    }?>
    <label>
      <!--<input type="checkbox" checked="checked" name="remember"> Remember me-->
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="sign" onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
  </div>
</form>

<!-- 회원가입 -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="signup_process.php" method="post">
    <div class="container">
      <h1>Sign Up</h1>

      <hr>
      <label for=""><b>ID</b></label>
      <input type="text" placeholder="Enter ID" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      <?php
      if(isset($_SESSION['error'])){
        echo '<div style="color:red">'.$_SESSION['error_message'].'</div>';
        session_destroy();
      }  ?>
      <div id="avatar"><img src="user.png" alt="" style="width: 100px; height: 100px" ></div>
      <p>Profile Picture</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script>

var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>
