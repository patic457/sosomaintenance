<?php
$strWordFileName = "Report".rand(000001,999999).".doc";
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
width:800px;
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

.w{
color:#FFFFFF;
font-size:18px;
font-weight:bold;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY >
<div style="margin-left:0.1mm; margin-top:0.1mm; text-align:left; font-size:10px;">หน่วยอาคารสถานที่และยานพาหนะ บางเขน</div>
<?
$id_building_ = $_GET['id_building'];
$tech_ = $_GET['tech'];
$month = $_GET['month'];
$year = $_GET['year'];
$job_status_ = $_GET['job_status'];

	if($month=="0" && $id_building_=="0" && $job_status_=="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year";
			}
		else if($month!="0" && $id_building_!="0" && $job_status_!="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND id_building='$id_building_' AND job_status='$job_status_' AND id_technician_a='$tech_'";
			}
		else if( $month=="0" && $id_building_!="0" && $job_status_!="0" && $tech_!="0" ){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND id_building='$id_building_' AND job_status='$job_status_' AND id_technician_a='$tech_'";}
		else if($month=="0" && $id_building_=="0" && $job_status_!="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND job_status='$job_status_' AND job_status='$job_status_' AND id_technician_a='$tech_'";
			}
		else if( $month=="0" && $id_building_=="0" && $job_status_=="0" && $tech_!="0" ){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND id_technician_a='$tech_'";
			}
		else if($month!="0" && $id_building_!="0" && $job_status_!="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND id_building='$id_building_' AND job_status='$job_status_'";
			}
		else if($month!="0" && $id_building_!="0" && $job_status_=="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND id_building='$id_building_'";
			}
		else if($month!="0" && $id_building_=="0" && $job_status_=="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND MONTH(date)='$month'";
			}
		else if($month!="0" && $id_building_=="0" && $job_status_=="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND id_technician_a='$tech_'";
			}
		else if($month=="0" && $id_building_!="0" && $job_status_!="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND id_building='$id_building_' AND job_status='$job_status_'";
			}
		else if($month!="0" && $id_building_=="0" && $job_status_!="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND MONTH(date)='$month' AND job_status='$job_status_'";
			}
		else if($month=="0" && $id_building_!="0" && $job_status_=="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND id_building='$id_building_' AND id_technician_a='$tech_'";
			}
		else if($month=="0" && $id_building_!="0" && $job_status_=="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND id_building='$id_building_'";
			}
		else if($month=="0" && $id_building_=="0" && $job_status_!="0" && $tech_=="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND job_status='$job_status_'";
			}
		else if($month!="0" && $id_building_=="0" && $job_status_!="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND job_status='$job_status_' AND id_technician_a='$tech_'";
			}
		else if($month!="0" && $id_building_!="0" && $job_status_=="0" && $tech_!="0"){
$sql="SELECT * FROM list_service WHERE YEAR(date)=$year AND MONTH(date)='$month' AND id_building='$id_building_' AND id_technician_a='$tech_'";
			}

?>
<div class="head">รายการปฏิบัติงานตามใบแจ้งซ่อมไฟฟ้า ประปา โทรศัพท์ และอื่นๆ<div style="font-size:24px; font:italic;">
<?php 

if($job_status_=='รอการอนุมัติ'){echo'สถานะรอการอนุมัติ' ;}
else if($job_status_=='ไม่อนุมัติ'){echo'สถานะไม่อนุมัติ' ;}
else if($job_status_=='อนุมัติแล้วกำลังรอการดำเนินการ'){echo 'สถานะอนุมัติแล้วกำลังรอการดำเนินการ';}
else if($job_status_=='อยู่ในระหว่างการดำเนินการ'){echo 'สถานะอยู่ในระหว่างการดำเนินการ';}
else if($job_status_=='ดำเนินการเรียบร้อย'){echo 'สถานะดำเนินการเรียบร้อย';}
else if($job_status_=='ไม่สามารถดำเนินการได้'){echo'สถานะไม่สามารถดำเนินการได้' ;}
echo"</div><div style=\"font-size:21px; font:normal;\">"; 
if($month=='01'){echo"ประจำเดือน มกราคม 2554";}else if($month=='02'){echo"ประจำเดือน กุมภาพันธ์ 2554";}else if($month=='03'){echo"ประจำเดือน มีนาคม 2554";}
else if($month=='04'){echo"ประจำเดือน เมษายน 2554";}else if($month=='05'){echo"ประจำเดือน พฤษภาคม 2554";}else if($month=='06'){echo"ประจำเดือน มิถุนายน 2554";}
else if($month=='07'){echo"ประจำเดือน กรกฎาคม 2554";}else if($month=='08'){echo"ประจำเดือน สิงหาคม 2554";}else if($month=='09'){echo"ประจำเดือน กันยายน 2554";}
else if($month=='10'){echo"ประจำเดือน ตุลาคม 2554";}else if($month=='11'){echo"ประจำเดือน พฤศจิกายน 2554";}else if($month=='12'){echo"ประจำเดือน ธันวาคม 2554";}

?>
</div>
</div>
<div class="w">|</div>
<div align="center" ><table class="report"  >
<tr>
<th scope="col">วันที่รับแจ้ง</th><th scope="col">รายการ</th><th scope="col">อาคาร</th>
<th scope="col">ผู้แจ้ง</th><th scope="col">วันที่แล้วเสร็จ</th><th scope="col">ผู้ดำเนินการ</th>
</tr>
</div>
<?
$sql.=" ORDER BY id_list DESC";
$result_r = $mysqli->query($sql);
$num_r = mysqli_num_rows($result_r);
$i=0;
while($i<$num_r){
$fetch_r  = mysqli_fetch_array($result_r);
$date_temp = $fetch_r['date'];
$details_temp = $fetch_r['details'];
$id_building_temp = $fetch_r['id_building'];
$username_temp = $fetch_r['username'];
$date_complete_temp = $fetch_r['date_complete'];
$id_technician_a_temp = $fetch_r['id_technician_a'];
$id_technician_b_temp = $fetch_r['id_technician_b'];
$job_status_temp = $fetch_r['job_status'];

$result_u = $mysqli->query("SELECT * FROM user WHERE username='$username_temp'");
$fetch_u  = mysqli_fetch_array($result_u);
$id_prename_temp =  $fetch_u['id_prename'];
$name_temp =  $fetch_u['name'];
$lastname_temp =  $fetch_u['lastname'];

$result_pre = $mysqli->query("SELECT * FROM prename WHERE id_prename='$id_prename_temp'");
$fetch_pre  = mysqli_fetch_array($result_pre);
$prename_temp =  $fetch_pre['prename'];

$result_s = $mysqli->query("SELECT * FROM building WHERE id_building='$id_building_temp'");
$fetch_s  = mysqli_fetch_array($result_s);
$building_temp =  $fetch_s['building'];


$result_t = $mysqli->query("SELECT * FROM user WHERE username='$id_technician_a_temp'");
$fetch_t  = mysqli_fetch_array($result_t);
$name_t_temp =  $fetch_t['name'];
$lastname_t_temp =  $fetch_t['lastname'];

$result_pre_a = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_t[id_prename]'");
$fetch_pre_a  = mysqli_fetch_array($result_pre_a);

//echo "$fetch_pre_a[prename]$name_t_temp $lastname_t_temp";


$result_t = $mysqli->query("SELECT * FROM user WHERE username='$id_technician_b_temp'");
$fetch_t  = mysqli_fetch_array($result_t);
$prename_tt_temp =  $fetch_t['prename'];
$name_tt_temp =  $fetch_t['name'];
$lastname_tt_temp =  $fetch_t['lastname'];



echo"<tr><td>&nbsp;";ConThai($date_temp);echo"&nbsp;</td><td>&nbsp;$details_temp&nbsp;</td><td>&nbsp;$building_temp&nbsp;</td>";
echo"<td>&nbsp;$prename_temp$name_temp  $lastname_temp&nbsp;</td><td>"; if($date_complete_temp=="0000-00-00"){echo"-";}else{ ConThai($date_complete_temp); }
echo"</td><td>&nbsp;";if(isset($name_t_temp)==true){echo"$fetch_pre_a[prename]$name_t_temp  $lastname_t_temp<br>$prename_tt_temp$name_tt_temp  $lastname_tt_temp&nbsp;</td></tr>";}else{echo"-";}

$i++;
}


echo"</table>";
?>
<!-- style="text-align:center; border-collapse: collapse;  padding:2px; font-size:10px;" 
font-weight:bold; border: solid 1px; color:#333333;
-->
</BODY>

</HTML>