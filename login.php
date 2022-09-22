<?php 
session_start();
include('db.php');
include("func.php"); 
if(empty($_SESSION['username'])==true){}else{echo"<script>Location('index.php');</script>";exit();} 
?>
<head>
<script language="javascript">
$(function(){
	$("#bt").click(function(){
		$.post("check_login.php",$("#loginfm").serialize(),
			function(data){$("#re").html(data);});
	});
	
	$('#b').keydown(function(event) {
	if (event.keyCode == '13') {
     $.post("check_login.php",$("#loginfm").serialize(),
			function(data){$("#re").html(data);});
   }		
	});

	$('#a').keydown(function(event) {
	if (event.keyCode == '13') {
     $.post("check_login.php",$("#loginfm").serialize(),
			function(data){$("#re").html(data);});
   }
   	});

});

</script>
<title>Login Page</title><link rel="stylesheet" type="text/css" href="style_login.css" /></head>
<body>
	<form id="loginfm"   method="post">
		<fieldset>
		
			<legend>Log in</legend>
			
			<label for="username" style="font-weight:bold">ชื่อผู้ใช้</label>
		  <input id="a" name="a" type="text"  maxlength="10" onClick="<?php echo"value=''"; ?>" value="" onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" />

			<label for="password"style="font-weight:bold">รหัสผ่าน</label>
			<input id="b" name="b" type="password"  maxlength="10" onClick="<?php echo"value=''"; ?>" value="" onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" />
            
		
			
    <br />
			<input type="button" style="margin: -20px 0 0 287px;" class="button" id="bt" value="เข้าสู่ระบบ"/>	
			
            <p  style="margin: 5px 0 0 px; font-weight:bold"><label onClick="Location('forget.php');" >ลืมรหัสผ่าน ?</label></a>
</fieldset></form>

  </body>
  <div id="re"></div>