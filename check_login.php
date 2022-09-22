<?php session_start();
include"db.php";
$username_session = $_POST['a'];
$password_session = base64_encode(md5($_POST['b']));

if($username_session=="" && $password_session=="" ){ echo"<script>alert('กรุณากรอกให้ครบถ้วน')</script>"; }
	else{ 	$sqllg = "SELECT * FROM user WHERE username = '$username_session' AND password = '$password_session'";
	 	  		$sqllg_query = mysql_query($sqllg);
				$sqllg_num=mysqli_num_rows($sqllg_query);
				$fetch  = mysqli_fetch_array($sqllg_query);
				$id_prename_session = $fetch['id_prename'];
				$name_session = $fetch['name'];
				$lastname_session = $fetch['lastname'];
				$user_status_session = $fetch['user_status'];
				 if($sqllg_num=="0"){echo"<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');</script>";}
					 else{ $_SESSION("username_session");
					  $_SESSION("user_status_session"); 
					  $_SESSION("id_prename_session");
					  $_SESSION("name_session");
					  $_SESSION("lastname_session"); 	
					  /*$_SESSION['username_session'] = $_SESSION['username'];
					   $_SESSION['user_status_session'] = $_SESSION['user_status_temp'];
					   $_SESSION['id_prename_session'] = $_SESSION['id_prename_temp'];
					    $_SESSION['name_session'] = $_SESSION['name'];
						 $_SESSION['lastname_session'] = $_SESSION['lastname'];	*/
					 echo"<script>Location('index.php');</script>"; }}
					 
					 ?>