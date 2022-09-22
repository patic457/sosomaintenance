<?php session_start();
include"db.php";
$username = $_POST['a'];
$mail = $_POST['b'];

if($username=="" && $mail=="" ){ echo"<script>alert('กรุณากรอกให้ครบถ้วน')</script>"; }
	else{ 	$sqllg = "SELECT * FROM user WHERE username = '$username' AND mail = '$mail'";
	 	  		$sqllg_query = mysql_query($sqllg);
				$sqllg_num=mysql_num_rows($sqllg_query);
				//$fetch  = mysql_fetch_array($sqllg_query);
				//$user_status_temp = $fetch['user_status'];
				 if($sqllg_num=="0"){echo"<script>alert('ชื่อผู้ใช้หรืออีเมล์ไม่ถูกต้อง');</script>";}
					 else{ echo"<form id='fm'   method='post'><strong>กรุณากรอกรหัสผ่านใหม่</strong><p><input id='pass1' name='pass1' type='password'  maxlength='10'/><p>"; 
					 echo"<strong>กรุณากรอกรหัสผ่านใหม่อีกครั้ง</strong><p><input id='pass2' name='pass2' type='password'  maxlength='10'/>";
					 echo"<p><input type='button' class='button' id='btf' value='ยืนยัน'><input type='hidden'  id='u' name='u' value=\"$username\"></form>";
					 }}
					 
					 ?>
                     <div id="ree"></div>
<script language="javascript">
$(function(){
	$("#btf").click(function(){
		$.post("check_forget2.php",$("#fm").serialize(),
			function(data){$("#ree").html(data);});
	});
});
</script>