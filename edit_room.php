<?php  include"session.php"; 

?>
<script language="javascript">
$(function(){$("#be").change(function(){var be_=$("#be").attr("value");var check_fl = 'edit_fl';
$.post("check_floor.php",{b: be_,check_fl: check_fl},function(data){$("#floor_e").html(data);});
});
});

$(function(){$("#btt").click(function(){var room=$("#ae").attr("value");var id_building=$("#be").attr("value");var floor_building=$("#ce").attr("value");
var id_sector=$("#de").attr("value");var check_status_1='room';var check_status_2='edit';var id_room=<?php echo"$_POST[id_room_]"; ?>;
if(room=="" || id_building=="0" || floor_building=="" || id_sector=="0"){alert("กรุณากรอกข้อมูลให้ครบถ้วน");}else if(room==""){alert("กรุณาเลือกชั้น");}else{
$.post("check_admin.php",{id_room_: id_room,room_: room,id_building_: id_building,floor_: floor_building,id_sector_: id_sector,check_status_1: check_status_1,check_status_2: check_status_2},
function(data){$("#msg").html(data);});
}
});
});
</script>
<?php 
$result = mysql_query("SELECT * FROM room WHERE id_room='$_POST[id_room_]'");
$num = mysqli_num_rows($result);
$fetch  = mysqli_fetch_array($result);
$room_sel_temp = $fetch['room'];
$id_building_sel_temp = $fetch['id_building'];	
$id_sector_sel_temp = $fetch['id_sector'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body><table class="mana">
<tr><td>
<div class="title">แก้ไขข้อมูล</div>
<form id="f1" method="post" >
ชื่อห้อง :<input type="text" id="ae" value="<?php echo $room_sel_temp; ?>" > 
</td></tr>
<tr><td>
อาคาร : <select name="be" id="be">
<?php 
$resultb = mysql_query("SELECT * FROM building");
$numb = mysqli_num_rows($resultb);
$j=0;
while($j<$numb){	
$fetchb  = mysqli_fetch_array($resultb);
$id_building_temp = $fetchb['id_building'];
$building_temp = $fetchb['building'];
?><option value="<?php echo $id_building_temp; ?>" <?php if($id_building_temp==$id_building_sel_temp){echo "selected";} ?> ><?php echo $building_temp; ?></option><?
$j++; }
?></select>
<label id="floor_e" ></label>
</td>
<tr>
<td>
หน่วยงาน : 
 <select name="de" id="de">
<?php 
$results = mysql_query("SELECT * FROM sector order by id_sector ASC");
$num = mysqli_num_rows($results);
$i=0;

while($i<$num){	
$fetchs  = mysqli_fetch_array($results);
$id_sector_temp = $fetchs['id_sector'];
$sector_temp = $fetchs['sector'];
?><option value="<?php echo $id_sector_temp; ?>" <?php if($id_sector_temp==$id_sector_sel_temp){echo "selected";} ?>  ><?php echo $sector_temp; ?></option><?
$i++;
}?></select>
</td>
<td>
<input type="button" id="btt" value="แก้ไขข้อมูล">
</form>
</td></tr></table>

</body>