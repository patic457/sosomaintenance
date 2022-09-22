<?php if (!session_id()) session_start();;include('db.php'); ?>
<head>
<style>
.login {
border-collapse:collapse;
background-color:#c3d9ff;
color: #3366CC;
}
</style>
<script language="javascript">
$(function(){
	$("#bt").click(function(){
		$.post("check_forget.php",$("#loginfm").serialize(),
			function(data){$("#re").html(data);});
	});
});
</script>
<title>Login Page</title></head>
<body><center>
<table class="login"><tr><th colspan="2">ถ้าท่านลืมรหัสผ่าน กรุณากรอกข้อมูล</th></tr>
	<form id="loginfm"   method="post">	
			<tr><th>ชื่อผู้ใช้</th>
		  <td><input id="a" name="a" type="text"  maxlength="10"/></td></tr>

			<tr><th><label for="password"style="font-weight:bold">อีเมล์</label></th>
			<td><input id="b" name="b" type="text"/></td></tr>
			<tr><td colspan="2"><input type="button"  id="bt" value="ยืนยัน"/><input type="button"  onClick="Location('login.php');" id="bt" value="กลับหน้าหลัก"/></td></tr>


  <tr><td colspan="2"><div id="re" align="center"></div>  </td></tr>
</form></table>



</center></body>