<? include"db.php"; include"session.php"; include"func.php";?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />



<body>
<div class='title'>


	
	<p align="center" class='title'><b>รายการปฏิบัติงานตามใบแจ้งซ่อมไฟฟ้า ประปา โทรศัพท์ และอื่นๆ<br>ของหน่วยอาคารสถานที่และยานพาหนะ บางเขน</b><br>
	<? if($month=='01'){echo"ประจำเดือน มกราคม 2554";}else if($month=='02'){echo"ประจำเดือน กุมภาพันธ์ 2554";}else if($month=='03'){echo"ประจำเดือน มีนาคม 2554";}
	else if($month=='04'){echo"ประจำเดือน เมษายน 2554";}else if($month=='05'){echo"ประจำเดือน พฤษภาคม 2554";}else if($month=='06'){echo"ประจำเดือน มิถุนายน 2554";}
	else if($month=='07'){echo"ประจำเดือน กรกฎาคม 2554";}else if($month=='08'){echo"ประจำเดือน สิงหาคม 2554";}else if($month=='09'){echo"ประจำเดือน กันยายน 2554";}
	else if($month=='10'){echo"ประจำเดือน ตุลาคม 2554";}else if($month=='11'){echo"ประจำเดือน พฤศจิกายน 2554";}else if($month=='12'){echo"ประจำเดือน ธันวาคม 2554";} ?>

</div><p>

<table class="css" ><tr><th scope="col">วันที่แจ้ง</th><th scope="col">เวลาที่แจ้ง</th><th scope="col">หน่วยงาน</th><th scope="col">ประเภทที่แจ้ง</th><th scope="col">สถานะ</th><th scope="col">รายละ้อียด</th></tr>

<?

//Page
$pagesize = 100;
// แบ่งหน้าแสดงผล
if($_SESSION['user_status_session']=="0"){
$sql_page = mysql_query("SELECT count(date) as date FROM list_service WHERE username='$_SESSION[username_session]'"); }
else if($_SESSION['user_status_session']=="1" || $_SESSION['user_status_session']=="2"){$sql_page = mysql_query("SELECT count(date) as date FROM list_service");}

//$sql_page = "SELECT count(date) as date FROM list_service";

$crow = mysql_fetch_row($sql_page);
$totalrecord = $crow[0];
$totalpage = ceil($totalrecord / $pagesize);

if (isset($_GET['pageid'])){$start = $pagesize * ($_GET['pageid'] - 1);}else{$pageid = 1; $start = 0; }
//End Page

	$month = $_GET['month'];
	$year = $_GET['year'];
	$tech_ = $_GET['tech'];
	$id_building_= $_GET['id_building'];
	$job_status_ = $_GET['job_status'];
	$sql="SELECT * FROM list_service WHERE YEAR(date)=$year";

if($month!="0"){$sql.=" AND MONTH(date)='$month'";}
if($tech_!="0"){$sql.=" AND (id_technician_a='$tech_' OR id_technician_b='$tech_')";}
if($id_building_!="0"){$sql.=" AND id_building='$id_building_'";}
if($job_status_!="0"){$sql.=" AND job_status='$job_status_'";}

$sql.=" ORDER BY id_list DESC";
$result_r = mysql_query($sql);
$num_r = mysql_num_rows($result_r);

$r=0;
//echo"$num_r";
while($r<$num_r){	
$fetch = mysql_fetch_array($result_r);
?>
<script language="javascript">
$(function(){
$("#bt<? echo $i; ?>").change(function(){$(this).hide();});
});

$(function(){$("#bt<? echo $i; ?>").change(function(){var bt_=$("#bt<? echo $i; ?>").attr("value");var id_=$("#id<? echo $i; ?>").attr("value");
$.post("check_inbox_admin.php",{bt: bt_,id: id_},function(data){$("#msg<? echo $i; ?>").html(data);});
});
});
</script>

<?
//$fetch  = mysql_fetch_array($result);
$id_list_temps = $fetch['id_list'];
$date_temps = $fetch['date'];
$time_temps = $fetch['time'];
$t = substr($time_temps,0,5);
$username_temps =  $fetch['username'];
$id_problem_temps =  $fetch['id_problem'];
$id_building_temps = $fetch['id_building'];
$floor_temps = $fetch['floor'];
$id_room_temps = $fetch['id_room'];
$details_temps = $fetch['details'];
$job_status_temps = $fetch['job_status'];

$result_u = mysql_query("SELECT * FROM user WHERE username='$username_temps'");
$fetch_u  = mysql_fetch_array($result_u);
$id_prename_temps =  $fetch_u['id_prename'];
$name_temps =  $fetch_u['name'];
$lastname_temps =  $fetch_u['lastname'];
$id_sector_temps =  $fetch_u['id_sector'];

$result_pre = mysql_query("SELECT * FROM prename WHERE id_prename='$id_prename_temps'");
$fetch_pre  = mysql_fetch_array($result_pre);
$prename_temps =  $fetch_pre['prename'];

$result_s = mysql_query("SELECT * FROM sector WHERE id_sector='$id_sector_temps'");
$fetch_s  = mysql_fetch_array($result_s);
$sector_temps =  $fetch_s['sector'];

$result_p = mysql_query("SELECT * FROM type_problem WHERE id_problem='$id_problem_temps'");
$fetch_p  = mysql_fetch_array($result_p);
$problem_temps =  $fetch_p['problem'];

print"<tr><td>";Conthai($date_temps);echo"</td><td>$t</td><td>$sector_temps</td><td>$problem_temps</td><td>";

if($job_status_temps=="รอการอนุมัติ"){echo"<font color='black'>รอการอนุมัติ</font>";}
else if($job_status_temps=="อนุมัติแล้วกำลังรอการดำเนินการ"){echo"<font color='blue'>อนุมัติแล้วกำลังรอการดำเนินการ</font>";}
else if($job_status_temps=="อยู่ในระหว่างการดำเนินการ"){echo"<font color='#FFA500'>อยู่ในระหว่างการดำเนินการ</font>";}
else if($job_status_temps=="ดำเนินการเรียบร้อย"){echo"<font color='green'>ดำเนินการเรียบร้อย</font>";}
else if($job_status_temps=="ไม่สามารถดำเนินการได้"){echo"<font color='#FF7F50'>ไม่สามารถดำเนินการได้</font>";}
else if($job_status_temps=="ไม่อนุมัติ"){echo"<font color='red'>ไม่อนุมัติ</font>";}

	
echo"</td><td><a href=\"index.php?m=4.1&&id_list=$fetch[id_list]\" title='แสดงรายละเอียด'><img src='images/view.png' alt='แสดงรายละเอียด' width='16' height='16' border='0' />";
echo"</a></td></tr>";
$r++;
}
?>
</table>
<p align="center"><a href="<? echo"report_page.php?job_status=$_GET[job_status]&&id_building=$_GET[id_building]&&tech=$_GET[tech]&&month=$_GET[month]&&year=$_GET[year]"; ?>" >
<img border="0" src="images/printer.png" width="20" height="20" title="ออกรายงาน" ></a></p>
<? 
//Next Page
/*for($i_page=1; $i_page<=$totalpage; $i_page++) { 
if($i_page==$_GET['pageid']){echo "| $i_page ";}
else{ echo" | <a href=\"check_record.php&&month=$_GET[month]&&year=$_GET[year]&&tech=$_GET[tech]&&month=$_GET[month]&&id_building=$_GET[id_building]&&job_status=$_GET[job_status]&&";   echo"pageid=$i_page\">$i_page</a> ";  } 
}*/
//End
 ?>
</body>
