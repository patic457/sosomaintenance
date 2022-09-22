<?php include"db.php"; include"session.php";

$step=$_POST['step'];
$id=$_POST['id'];
switch($step){
	case '1': //อนุมัติ ไม่อนุมัติ
		$s=$_POST['s'];
		$comment=$_POST['comment'];
		$date_temp = gmdate('Y-m-d');
		$time_temp = date("H").":".date("i").":".date("s");
		
		if($s=='อนุมัติ'){
		$s='อนุมัติแล้วกำลังรอการดำเนินการ';
		$sqll = "update list_service set job_status='$s' , date_1='$date_temp' , time_1='$time_temp' , username_1='$_SESSION[username_session]' , comment='$comment' where id_list='$id'";
		}
		else
		{
		$sqll = "update list_service set job_status='$s', date_complete='$date_temp', time_complete='$time_temp', username_1='$_SESSION[username_session]', comment='$comment' where id_list='$id'";
		}
		$sqlquery = mysql_query($sqll) or die("Error 1");
		print"<script>alert('บันทึกข้อมูลสำเร็จแล้ว');Location('index.php?m=5');</script>";
	break;

	case '2': //อยู่ในระหว่าง
		$tech_a=$_POST['tech_a'];
		$tech_b=$_POST['tech_b'];
		$date_temp = gmdate('Y-m-d');
		$time_temp = date("H").":".date("i").":".date("s");

		$sqll = "update list_service set job_status='อยู่ในระหว่างการดำเนินการ' , id_technician_a='$tech_a' , id_technician_b='$tech_b' , date_2='$date_temp' , time_2='$time_temp' where id_list='$id'";
		$sqlquery = mysql_query($sqll) or die("Error 2");
		print"<script>alert('บันทึกข้อมูลสำเร็จแล้ว');Location('index.php?m=6');</script>";
	break;

	case '3': //ดำเนินการแล้ว
		$s=$_POST['s'];
		$comment=$_POST['comment'];
		$date_temp = gmdate('Y-m-d');
		$time_temp = date("H").":".date("i").":".date("s");
		
		$sqll = "update list_service set job_status='$s' , comment='$comment' , date_complete='$date_temp' , time_complete='$time_temp' where id_list='$id'";
		$sqlquery = mysql_query($sqll) or die("Error 3");
		print"<script>alert('คุณได้ดำเนินการเรียบร้อยแล้ว ระบบได้จัดเก็บประวัติแจ้งซ่อมลงในฐานข้อมูลเรียบร้อยแล้ว');Location('index.php');</script>";
	break;
		 
			}