<?php
session_start();
$dbh = new PDO('mysql:host=localhost:3306;dbname=instagram', 'root', 'eh1105', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$sql="SELECT *FROM user WHERE email='".$_POST['email']."'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// $row = $stmt->fetch(PDO::FETCH_ASSOC); 데이터베이스 배우면 반복문으로 데이터베이스안에 아이디가 존재하는지 여부랑
// var_dump($row);
// exit;
// for(i=0;i<;)

if(!$row){  //가입된 이메일이 아닌경우
  $_SESSION['email_error']=true;
  $_SESSION['is_login']=false;
  $_SESSION['email_error_message']="이메일이 존재하지 않습니다.";
  $_SESSION['email']=$_POST['email'];//유효성검사할것
  header('Location:Login.php');
}
else if (password_verify($_POST['pw'], $row['password'])) {  //로그인 성공!!
  $_SESSION['is_login']=true;
  $_SESSION['email']=$_POST['email'];     // 유효성검사할것
  $sql="INSERT INTO loginstate (email) VALUES (:email)";
  $stmt=$dbh->prepare($sql);

  $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL) ; //필터링
  $stmt->bindParam(':email',$email);
  $stmt->execute();

  header('Location:http://172.16.11.3:3000');

  // header('Location:localhost:3000');
  // header('Location:https://www.naver.com');
} else {  //비밀번호가 일치하지 않을경우
  $_SESSION['password_error']=true;
  $_SESSION['email_error']=false;
  $_SESSION['is_login']=false;
  $_SESSION['email']=$_POST['email'];
  $_SESSION['password_error_message']="비밀번호가 틀립니다";
  // echo $_SESSION['password_error_message'];
  // exit;
  header('Location:Login.php');
  // <script language="Javascript">
  //               function sorry() {
  //                    location.href = "login.html";
  //                    alert("죄송합니다!!!");
  //               }
  // </script>
}
?>
