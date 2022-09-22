<?php include"db.php"; include"session.php"; include"func.php";

$username = $_GET['username'];
if($_GET['check']=='del'){  

$sql = "DELETE FROM user WHERE username='$_GET[username]'";
$sqlquery = $mysqli->query($sql) or die("Error del");
print"<script>alert('ลบข้อมูลผู้ใช้สำเร็จแล้ว');Location('index.php?m=15');</script>";

}

else if($_POST['check']=='add'){

$sql_a = $mysqli->query("select * FROM user WHERE username='$_POST[username]'");
$num_a = mysqli_num_rows($sql_a);
$pass1 = $_POST['password'];
$pass2 = md5($pass1);
$pass3 = base64_encode($pass2);
//echo $pass3; 
if($num_a!=0){ echo"<script>alert('มีคนใช้ชื่อผู้ใช้นี้แล้ว กรุณากรอกใหม่อีกครั้ง');</script>"; }else{
$sql = "insert into user values('$_POST[username]','$pass3','$_POST[prename]','$_POST[name]','$_POST[lastname]','$_POST[id_sector]','$_POST[tel]','$_POST[mail]','$_POST[user]')";
$sqlquery = $mysqli->query($sql) or die("Error add");
echo"<script>alert('เพิ่มข้อมูลสำเร็ลแล้ว');Location('index.php?m=15');</script>";
}  

}

else if($_POST['check']=='edit'){

$sql = "UPDATE user SET id_prename='$_POST[prename]',name='$_POST[name]',lastname='$_POST[lastname]',id_sector='$_POST[id_sector]',tel='$_POST[tel]',mail='$_POST[mail]',user_status='$_POST[user]' 
								WHERE username='$_POST[username]'";
$sqlquery = $mysqli->query($sql) or die("Error edit1");
echo"<script>alert('แก้ไขข้อมูลสำเร็ลแล้ว');Location('index.php?m=15');</script>";
}

else if($_POST['check']=='edit_profile'){

$sql_a = $mysqli->query("select password FROM user WHERE username='$_SESSION[username_session]'");
$fetch_sel  = mysqli_fetch_array($sql_a);

$pass1 = $_POST['password'];
$pass2 = md5($pass1);
$pass3 = base64_encode($pass2);
//echo $pass3; 

if($pass1==""){$pass4=$fetch_sel['password'];}else{$pass4=$pass3;}
/*echo "pass=".$fetch_sel['password'];
echo "<br>passnew=$pass3<br>";
echo "pass4=$pass4";*/
$sql = "UPDATE user SET password='$pass4',			
id_prename='$_POST[prename]',name='$_POST[name]',lastname='$_POST[lastname]',id_sector='$_POST[id_sector]',tel='$_POST[tel]',mail='$_POST[mail]',user_status='$_POST[user]' WHERE username='$_SESSION[username_session]'";
		$sqlquery = $mysqli->query($sql) or die("Error edit2");
		
if($pass4!=$fetch_sel['password']){
session_destroy();
session_unset ();
}
		echo"<script>alert('แก้ไขข้อมูลของคุณสำเร็ลแล้ว');Location('index.php');</script>";
	}

?>