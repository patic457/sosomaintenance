<?php include"db.php";  include"session.php"; include"func.php"; ?>
<script language="javascript">
$(function(){$("#b").change(function(){var b_=$("#b").attr("value");var check_fl='service_fl';
$.post("check_floor.php",{b: b_,check_fl: check_fl},function(data){$("#floor_sel").html(data);});
});
});
<?php if($_SESSION['user_status_session']!='0'){ ?>
$(function(){$("#bt").click(function(){
								var p=$("#p").attr("value");var b=$("#b").attr("value");var floor_=$("#floorr").attr("value");
								var room=$("#room").attr("value");var d=$("#d").attr("value");var l=$("#l").attr("value");
										if(p=='' || b=='0' || floor_=='0' || room=='0' || d==''){alert('กรุณากรอกข้อมูลให้ครบถ้วน');}else{
											$.post("check_form.php",{p: p,b: b,f: floor_,r: room,d: d},function(data){$("#msg_").html(data);});
										}
								});
});
<?php } ?>
</script>
<center>
<?

$ddate = date("Y/m/d");

$result_username = mysql_query("SELECT * FROM user WHERE username='$_SESSION[username_session]'");
$fetch_username  = mysql_fetch_array($result_username);

$result_prename = mysql_query("SELECT * FROM prename WHERE id_prename='$fetch_username[id_prename]'");
$fetch_prename  = mysql_fetch_array($result_prename);

$result_sector = mysql_query("SELECT * FROM sector WHERE id_sector='$fetch_username[id_sector]'");
$fetch_sector  = mysql_fetch_array($result_sector);

$result_belong = mysql_query("SELECT * FROM belong WHERE id_belong='$fetch_sector[id_belong]'");
$fetch_belong  = mysql_fetch_array($result_belong);

function problem_sel(){
$result_problem_sel = mysql_query("SELECT * FROM type_problem");
$num_problem_sel = mysql_num_rows($result_problem_sel);
$prob = 0;
echo"<select id='p' name='p'>";
echo"<option value=\"0\">--แจ้งซ่อม--</option>";
while($prob<$num_problem_sel){
$fetch_problem_sel  = mysql_fetch_array($result_problem_sel);
echo"<option value=\"$fetch_problem_sel[id_problem]\">$fetch_problem_sel[problem]</option>";
$prob++;
}
echo"</select>";
}; //problem_sel

function building_sel(){
$result_building_sel = mysql_query("SELECT * FROM building");
$num_building_sel = mysql_num_rows($result_building_sel);
$build = 0;
echo"<select id='b' name='b'>";
echo"<option value=\"0\">--อาคาร--</option>";
while($build<$num_building_sel){
$fetch_building_sel  = mysql_fetch_array($result_building_sel);
echo"<option value=\"$fetch_building_sel[id_building]\">$fetch_building_sel[building]</option>";
$build++;
}
echo"</select>";
}; //building_sel

?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<div class="title">แบบฟอร์มงานแจ้งซ่อม</div><p><br>
<div style="text-align:right;" class="title"><?php echo "<b>วันที่แจ้ง :</b> ";ConThai($ddate); ?></div>
<form method="post">
<table class="form">
<tr><th style="text-align:center;" class="form"   scope="col" colspan="4">|------------------------------ ข้อมูลผู้แจ้ง -------------------------------|</th></tr>
<tr><th  scope="row"  >ผู้แจ้ง : </th><td colspan="3"><?php echo "$fetch_prename[prename]$fetch_username[name] $fetch_username[lastname]" ?></td></tr>
<tr><th scope="row">สังกัด : </th><td><?php echo $fetch_belong['belong'];?></td><th scope="row">หน่วยงาน : </th><td><?php echo $fetch_sector['sector'];?></td></tr>
<tr><th scope="row">โทรสายตรง : </th><td><?php echo $fetch_username['tel'];?></td><th scope="row">อีเมล์ : </th><td><?php echo $fetch_username['mail'];?></td></tr>
<tr><th align="center"  style="text-align:center;" class="form"   scope="col" colspan="4">|------------------------------ ข้อมูลแจ้งซ่อม -------------------------------|</th></tr>
<tr><th scope="row">ประเภทที่แจ้ง : </th><td><?php problem_sel(); ?></td>
<?php if($_SESSION['user_status_session']!='0'){ ?>
<th scope="row">อาคาร : </th><td><?php building_sel();?></td></tr>
<tr><th scope="row">ชั้น : </th><td ><label id="floor_sel"><font color="#FF0000">กรุณาเลือกอาคารก่อน</font></label></td>
<th scope="row">ห้อง : </th><td><label id="room_sel"><font color="#FF0000">กรุณาเลือกชั้นก่อน</font></label></td></tr>
<?php }else{ 
$result_db = mysql_query("SELECT * FROM room WHERE id_building='$fetch_sector[id_building]'");
$fetch_db_1 = mysql_fetch_array($result_db);
?>
<script>
$(function(){$("#bt").click(function(){
								var p=$("#p").attr("value");
								var room=$("#room").attr("value");var d=$("#d").attr("value");var l=$("#l").attr("value");
										if(p=='' || room=='0' || d==''){alert('กรุณากรอกข้อมูลให้ครบถ้วน');}else{
											$.post("check_form.php",{p: p,r: room,d: d},function(data){$("#msg_").html(data);});
										}
								});
});
</script>
<th scope="row">ห้อง : </th><td>
<?php 
$result_room_user_sel = mysql_query("SELECT * FROM room WHERE id_sector='$fetch_sector[id_sector]'");
$num_room_user_sel = mysql_num_rows($result_room_user_sel);
$roo = 0;
echo"<select id='room' name='room'>";
echo"<option value=\"0\">--เลือกห้อง--</option>";
while($roo<$num_room_user_sel){
$fetch_room_user_sel  = mysql_fetch_array($result_room_user_sel);
echo"<option value=\"$fetch_room_user_sel[id_room]\">$fetch_room_user_sel[room]</option>";
$roo++;
}
echo"</select>";
 ?>
</td></tr>
<?php } ?>
<tr><th scope="row">ลักษณะอาการเบื้องต้น : </th><td colspan="2"><textarea rows="3" id="d"></textarea></td>
<td align="center"><input type="button" value="ยืนยันการแจ้งซ่อม" title="ส่งเรื่องแจ้งซ่อม" id="bt"></td></tr>
</table>
</form>
<div id="msg_"></div>
</center>