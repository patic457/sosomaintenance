<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<?php  include"db.php"; include"session.php"; include"func.php";?>
<center>
<form id="ff" method="post"><table align="center"  class="css"><tr><th scope="col">วันที่แจ้ง</th><th scope="col">เวลาที่แจ้ง</th><th scope="col">หน่วยงาน</th>
<th scope="col">ประเภทที่แจ้ง</th><th scope="col">สถานะ</th><th scope="col">รายละเอียด</th></tr>
<?php 
$result = $mysqli->query("SELECT * FROM list_service WHERE job_status='อนุมัติแล้วกำลังรอการดำเนินการ' ORDER BY YEAR(date) , MONTH(date) , DAY(date) DESC");
$num = mysqli_num_rows($result);
if($num!=0){}else{}
$i=0;
echo"<div class='title'>รอการมอบหมายงาน</div><p>";
while($i<$num){	

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
$fetch  = mysqli_fetch_array($result);
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

$result_u = $mysqli->query("SELECT * FROM user WHERE username='$username_temp'");
$fetch_u  = mysqli_fetch_array($result_u);
$id_prename_temp =  $fetch_u['id_prename'];
$name_temp =  $fetch_u['name'];
$lastname_temp =  $fetch_u['lastname'];
$id_sector_temp =  $fetch_u['id_sector'];

$result_pre = $mysqli->query("SELECT * FROM prename WHERE id_prename='$id_prename_temp'");
$fetch_pre  = mysqli_fetch_array($result_pre);
$prename_temp =  $fetch_pre['prename'];

$result_s = $mysqli->query("SELECT * FROM sector WHERE id_sector='$id_sector_temp'");
$fetch_s  = mysqli_fetch_array($result_s);
$sector_temp =  $fetch_s['sector'];

$result_p = $mysqli->query("SELECT * FROM type_problem WHERE id_problem='$id_problem_temp'");
$fetch_p  = mysqli_fetch_array($result_p);
$problem_temp =  $fetch_p['problem'];

print"<tr><td>";conthai($date_temp);echo"</td><td>$t</td><td>$sector_temp</td><td>$problem_temp</td><td style=\"color:#FF6600;\">";
echo $job_status_temp;
	
	echo"<td><a href=\"index.php?m=4.1&&id_list=$id_list_temp\" title='แสดงรายละเอียด'><img src='images/view.png' alt='แสดงรายละเอียด' width='16' height='16' border='0' /></a></td></tr>";
$i++;
}
 ?>
</table></form></center>
