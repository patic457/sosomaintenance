<?php //session_start();
include"db.php";
$username = $_POST['u'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
if(strlen($username)==0 ){ echo"<script>alert('ก')</script>"; exit();}
if($pass1=="" && $pass2=="" ){ echo"<script>alert('กรุณากรอกให้ครบถ้วน')</script>"; }
else if($pass1!=$pass2){ echo"<script>alert('กรุณากรอกรหัสผ่านให้ตรงกัน')</script>"; }
	else{ 	if(strlen($pass2)<=5){ echo"<script>alert('กรุณากรอกรหัสผ่านไม่น้อยกว่า 6 ตัวอักษร');</script>";exit();}
			$pass=base64_encode(md5($pass2));
			$sqllg ="UPDATE user SET password='$pass' WHERE username='$username'";
			$sqlquery = $mysqli->query($sqllg) or die("Error 3");
				  echo"<script>alert('ท่านได้ทำการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว');Location('login.php');</script>"; }?>
                     <div id="ree"></div>
<script language="javascript">
$(function(){
	$("#btf").click(function(){
		$.post("check_forget2.php",$("#fm").serialize(),
			function(data){$("#ree").html(data);});
	});
});
</script>