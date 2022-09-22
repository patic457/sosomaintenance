<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<?php include"db.php"; include"session.php"; include"func.php";

function Select(){
//Page
$pagesize = 15;
// แบ่งหน้าแสดงผล
if($_SESSION['user_status_session']=='9'){
$sql_page = mysql_query("SELECT count(date) as date FROM list_service WHERE username='$_SESSION[username_session]'");
}

//$sql_page = "SELECT count(date) as date FROM list_service";

$crow = mysqli_fetch_row($sql_page);
$totalrecord = $crow[0];
$totalpage = ceil($totalrecord / $pagesize);

if (isset($_GET['pageid'])) {
$start = $pagesize * ($_GET['pageid'] - 1);
}
else {
$pageid = 1;
$start = 0;
}
//End Page

if($_SESSION['user_status_session']=='9'){
$result = mysql_query("SELECT * FROM list_service WHERE job_status='อยู่ในระหว่างการดำเนินการ' AND id_technician_a='$_SESSION[username_session]' ORDER BY id_list DESC limit $start,$pagesize");
}

while($fetch = mysqli_fetch_array($result)){	

?>
<script language="javascript">
$(function(){
$("#bt<?php echo $i; ?>").change(function(){$(this).hide();});
});

$(function(){$("#bt<?php echo $i; ?>").change(function(){var bt_=$("#bt<?php echo $i; ?>").attr("value");var id_=$("#id<?php echo $i; ?>").attr("value");
$.post("check_inbox_admin.php",{bt: bt_,id: id_},function(data){$("#msg<?php echo $i; ?>").html(data);});
});
});

</script>

<?
//$fetch  = mysqli_fetch_array($result);
$id_list_temp = $fetch['id_list'];
$date_temp = $fetch['date'];
$time_temp = $fetch['time'];
$t = substr($time_temp,0,5);
$username_temp =  $fetch['username'];
$id_problem_temp =  $fetch['id_problem'];
$id_building_temp = $fetch['id_building'];
$floor_temp = $fetch['floor'];
$id_room_temp = $fetch['id_room'];
$details_temp = $fetch['details'];
$job_status_temp = $fetch['job_status'];

echo"<input type=\"hidden\" id=\"id$i\" value=\"$id_list_temp\" >";

$result_u = mysql_query("SELECT * FROM user WHERE username='$username_temp'");
$fetch_u  = mysqli_fetch_array($result_u);
$id_prename_temp =  $fetch_u['id_prename'];
$name_temp =  $fetch_u['name'];
$lastname_temp =  $fetch_u['lastname'];
$id_sector_temp =  $fetch_u['id_sector'];

$result_pre = mysql_query("SELECT * FROM prename WHERE id_prename='$id_prename_temp'");
$fetch_pre  = mysqli_fetch_array($result_pre);
$prename_temp =  $fetch_pre['prename'];

$result_s = mysql_query("SELECT * FROM sector WHERE id_sector='$id_sector_temp'");
$fetch_s  = mysqli_fetch_array($result_s);
$sector_temp =  $fetch_s['sector'];

$result_p = mysql_query("SELECT * FROM type_problem WHERE id_problem='$id_problem_temp'");
$fetch_p  = mysqli_fetch_array($result_p);
$problem_temp =  $fetch_p['problem'];

print"<tr><td>";Conthai($date_temp);echo"</td><td>$t</td><td>$sector_temp</td><td>$problem_temp</td><td>";


if($job_status_temp=="รอการอนุมัติ"){echo"<font color='black'>$job_status_temp</font>";}
else if($job_status_temp=="อนุมัติแล้วกำลังรอการดำเนินการ"){echo"<font color='blue'>$job_status_temp</font>";}
else if($job_status_temp=="อยู่ในระหว่างการดำเนินการ"){echo"<font color='#FFA500'>$job_status_temp</font>";}
else if($job_status_temp=="ดำเนินการเรียบร้อย"){echo"<font color='green'>$job_status_temp</font>";}
else if($job_status_temp=="ไม่สามารถดำเนินการได้"){echo"<font color='#660033'>$job_status_temp</font>";}
else if($job_status_temp=="ไม่อนุมัติ"){echo"<font color='red'>$job_status_temp</font>";}

echo"</td><td><a href=\"index.php?m=4.1&&id_list=$id_list_temp\" title='แสดงรายละเอียด'>";
echo"<img src='images/view.png' alt='แสดงรายละเอียด' width='16' height='16' border='0' /></a></td></tr>";
$i++;
}

//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {if ($i_page == $_GET['pageid']) {echo "| $i_page ";} else { 
echo" | <a href=\"index?m=3&&pageid=$i_page\">$i_page</a> ";  }
}
//End

}// End Function


?>


<body>
<div class='title'>รายการที่ได้รับมอบหมาย</div><p>
<form id="ff" method="post"><table align="center" class="css" ><tr><th scope="col">วันที่แจ้ง</th><th scope="col">เวลาที่แจ้ง</th><th scope="col">หน่วยงาน</th><th scope="col">ประเภทที่แจ้ง</th><th scope="col">สถานะ</th><th scope="col">รายละ้อียด</th></tr>
<?php Select();  ?>



</form></table>
</body>


