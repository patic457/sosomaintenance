<? 
include"db.php";
if(isset($_SESSION['username_session'])==true){}else{echo"<script>Location('login.php');</script>";}




//if(empty($_SESSION['username'])==true){print"<script>Location('index.php');";}else if($_SESSION['user_status']!=2){echo"alert('คุณไม่มีสิทธิ์ในหน้าของหัวหน้าหน่วยอาคารสถานที่และยานพาหนะ');"

?>

