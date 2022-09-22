<?php
$strWordFileName = "Page".gmdate('Y-m-d+H:i:s').".doc";
header("Content-Type: application/vnd.ms-word; name=\"$strWordFileName\"");
header("Content-Disposition: inline; filename=\"$strWordFileName\"");
header("Pragma: no-cache");
include"db.php"; include"session.php"; include"func.php";  ?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">
<HEAD>
<style>
body {
font-family: TH SarabunPSK, Angsana New ;
text-align:center;
width:1024px;
}
.head{
font-size:28px;
font-weight:bold;
}
.report{
border-collapse: collapse;
padding:2px;
font-size:16px;
}
.report th {
font-weight:bold;
color:#000000;
border-bottom:#666666 solid 1px;
border-left:#666666 solid 1px;
border-right:#666666 solid 1px;
border-top:#666666 solid 1px;
padding:2px;
}
.report td {
color:#333333;
border-bottom:#666666 solid 1px;
border-left:#666666 solid 1px;
border-right:#666666 solid 1px;
border-top:#666666 solid 1px;
padding:2px;
}

.style1 {color: #FFFFFF;
font-size:18px;
font-weight:bold;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY >

<!--<div style="margin-left:0.1mm; margin-top:0.1mm; text-align:left; font-size:10px;">หน่วยอาคารสถานที่และยานพาหนะ บางเขน</div>-->
<div class="head">บันทึกแจ้งซ่อมไฟฟ้า ประปา โทรศัพท์ และอื่นๆ<br>หน่วยอาคารสถานที่และยานพาหนะ บางเขน</div>
<div class="style1">|</div>
<div align="center" ><table class="report"  >
<center>
<?
$result_list = $mysqli->query("SELECT * FROM list_service WHERE id_list='$_GET[id_list]'");
$fetch_list  = mysqli_fetch_array($result_list);

$ddate = date("Y/m/d");

$result_username = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[username]'");
$fetch_username  = mysqli_fetch_array($result_username);

$result_prename = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_username[id_prename]'");
$fetch_prename  = mysqli_fetch_array($result_prename);

$result_sector = $mysqli->query("SELECT * FROM sector WHERE id_sector='$fetch_username[id_sector]'");
$fetch_sector  = mysqli_fetch_array($result_sector);

$result_belong = $mysqli->query("SELECT * FROM belong WHERE id_belong='$fetch_sector[id_belong]'");
$fetch_belong  = mysqli_fetch_array($result_belong);

$result_problem_list = $mysqli->query("SELECT * FROM type_problem WHERE id_problem='$fetch_list[id_problem]'");
$fetch_problem_list  = mysqli_fetch_array($result_problem_list);

$result_building_list = $mysqli->query("SELECT * FROM building WHERE id_building='$fetch_list[id_building]'");
$fetch_building_list  = mysqli_fetch_array($result_building_list);

$result_room_list = $mysqli->query("SELECT * FROM room WHERE id_room='$fetch_list[id_room]'");
$fetch_room_list  = mysqli_fetch_array($result_room_list);

$result_tech_a_list = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[id_technician_a]'");
$fetch_tech_a_list  = mysqli_fetch_array($result_tech_a_list);

$result_tech_a_pre_list = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_tech_a_list[id_prename]'");
$fetch_tech_a_pre_list  = mysqli_fetch_array($result_tech_a_pre_list);

$result_tech_b_list = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[id_technician_b]'");
$fetch_tech_b_list  = mysqli_fetch_array($result_tech_b_list);

$result_tech_b_pre_list = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_tech_b_list[id_prename]'");
$fetch_tech_b_pre_list  = mysqli_fetch_array($result_tech_b_pre_list);
?>

<div style="text-align:left;" class="report">เลขที่ใบแจ้งซ่อม : <?php echo $fetch_list['id_list']; ?>
</div>
<div style="text-align:right;" class="report">วันที่แจ้ง : <?php echo Conthai($fetch_list['date']); ?></div>
<div style="text-align:right;" class="report"><?php echo"เวลา : $fetch_list[time] น.";?></div>
<form method="post">
<table class="form" style="width:600;">
<tr>
<th style="text-align:center;" class="form"   scope="col" colspan="4">|------------------------------ ข้อมูลผู้แจ้ง -------------------------------|</th></tr>
<tr><th  scope="row"  >ผู้แจ้ง : </th><td colspan="3"><?php echo "$fetch_username[prename]$fetch_username[name] $fetch_username[lastname]" ?></td></tr>
<tr><th scope="row">สังกัด : </th><td><?php echo $fetch_belong['belong']; ?></td><th scope="row">หน่วยงาน : </th><td><?php echo $fetch_sector['sector']; ?></td></tr>
<tr><th scope="row">โทรสายตรง : </th><td><?php echo $fetch_username['tel']; ?></td><th scope="row">อีเมล์ : </th><td><?php echo $fetch_username['mail']; ?></td></tr>
<tr><th align="center" style="text-align:center; " class="form"   scope="col" colspan="4">
|------------------------------ ข้อมูลแจ้งซ่อม -------------------------------|</th></tr>
<tr><th scope="row">ประเภทที่แจ้ง : </th><td><?php echo $fetch_problem_list['problem']; ?></td><th scope="row">อาคาร : </th><td><?php echo $fetch_building_list['building']; ?></td></tr>
<tr><th scope="row">ชั้น : </th><td ><?php echo $fetch_list['floor']; ?></td><th scope="row">ห้อง : </th><td><?php echo $fetch_room_list['room']; ?></td></tr>
<tr><th scope="row">ลักษณะอาการเบื้องต้น : </th><td colspan="3" ><?php echo $fetch_list['details']; ?></td>
</tr>
<?php //===================================================================เจ้าหน้าที่============================================================ ?>
<tr><th align="center"  style='text-align:center; color:#333333;'  scope="col" colspan="4">
|------------------------------ สำหรับเจ้าหน้าที่ -------------------------------|</th>
</tr>
 <!--เฉพาะเจ้าหน้าที -->

<?php  if($fetch_list['job_status']=='รอการอนุมัติ'){echo"<tr><td colspan='4' style='color:black;'>$fetch_list[job_status]</td></tr>";	} 

	if($fetch_list['job_status']=='อนุมัติแล้วกำลังรอการดำเนินการ'){ echo"<tr><td colspan='4' style='color:#FF6600;'>$fetch_list[job_status]</td></tr>";	} 
 		if($fetch_list['job_status']=='อยู่ในระหว่างการดำเนินการ'){ echo"<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>"; 
	echo"$fetch_tech_a_pre_list[prename]$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
			if(isset($fetch_tech_a_list['prename'])!=true){echo" $fetch_tech_b_list[prename]$fetch_tech_b_list[name] $fetch_tech_b_list[lastname]";}
	echo"</font></td></tr>";     
				if($_SESSION['user_status_session']=='0'){	
		echo"<tr><td colspan='4' style='color:#FFA500;'>$fetch_list[job_status]</td></tr>";	
		}
			else{        
			echo"<tr><th style='color:#333333;'>สำหรับช่างเทคนิค<br>สถานะการดำเนินการ : </th><td colspan='3'></td></tr>";
						 
			}
 } 

		if($fetch_list['job_status']=='ไม่สามารถดำเนินการได้'){
			echo"<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>"; 
			echo"$fetch_tech_a_pre_list[prename]$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
			echo "<tr><td colspan='4' style='color:#FF7F50;'>$fetch_list[job_status]<p><u>เนื่องจาก</u> $fetch_list[comment]</td></tr>";
		}
		if($fetch_list['job_status']=='ดำเนินการเรียบร้อย'){
			echo"<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>"; 
	echo"$fetch_tech_a_pre_list[prename]$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
			if(isset($fetch_tech_b_pre_list['prename'])==true){echo" และ $fetch_tech_b_pre_list[prename]$fetch_tech_b_list[name] $fetch_tech_b_list[lastname]";}
	echo"</font></td></tr>";     
echo"<tr><th style='color:#333333;'>มอบหมายงานเมื่อวันที่ : </th><p><td><font color='black'>"; 
				echo"<font color='black'>";Conthai($fetch_list[date_2]);echo"</td><th style='color:#333333;'>เวลา : </th><td><font color='black'>$fetch_list[time_2] น.</td>";
				echo"</font></td></tr>";
			echo "<tr><td  align='center' colspan='4' style='color:green;'>$fetch_list[job_status] เมื่อวันที่ ";Conthai($fetch_list['date_complete']);
			echo"<br>เวลา $fetch_list[time_complete] น.</td></tr>";
			
		}
		if($fetch_list['job_status']=='ไม่อนุมัติ'){ 
   echo "<tr><td colspan='4' style='color:red;'>$fetch_list[job_status]<p><u>เนื่องจาก</u> $fetch_list[comment]";
	echo"<p></td></tr>";
 }


?>
</table>
</form>
<div id="msg_"></div>
</center></BODY>

</HTML>