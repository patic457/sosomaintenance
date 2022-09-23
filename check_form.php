<?php  include"db.php";include"session.php"; 

$p = $_POST['p'];
$b = $_POST['b'];
$f = $_POST['f'];
$r = $_POST['r'];
$d = $_POST['d'];
$u = $_SESSION['username_session'];

if($_SESSION['user_status_session']=='0'){
$result_db = $mysqli->query("SELECT * FROM room WHERE id_room='$r'");
$fetch_db  = mysqli_fetch_array($result_db);
$f=$fetch_db['floor'];
$b=$fetch_db['id_building'];
}

$date_temp = date("Y-m-d");
$id_list = date("Y").date("m").date("d")+"543".date("H").date("i").date("s").rand(000000,999999);
//print " ".$time;
$time = date("H").":".date("i").":".date("s");

$sqll = "insert into list_service values('$id_list','$date_temp','$time','$u','$p','$b','$f','$r','$d','รอการอนุมัติ','','','','','','','','','','')";
$sqlquery = $mysqli->query($sqll) or die("Error 3");
print"<script>alert('บันทึกข้อมูลสำเร็จแล้ว');Location('index.php?m=');</script>";

?>