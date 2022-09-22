<?php  include"session.php"; 
$result = mysql_query("SELECT * FROM sector order by id_belong ASC");
$num = mysql_num_rows($result);
$i=0;
?>
<script language="javascript">
$(function(){$("#b").change(function(){var b_=$("#b").attr("value");var check_fl = 'add_fl';
$.post("check_floor.php",{b: b_,check_fl: check_fl},function(data){$("#floor").html(data);});
});
});

$(function(){$("#bt").click(function(){var room=$("#a").attr("value");var id_building=$("#b").attr("value");var floor_building=$("#c").attr("value");
var id_sector=$("#d").attr("value");var check_status_1='room';var check_status_2='add';
if(room=="" || id_building=="0" || floor_building=="0" || id_sector=="0"){alert("กรุณากรอกข้อมูลให้ครบถ้วน");}else{
$.post("check_admin.php",{room_: room,id_building_: id_building,floor_: floor_building,id_sector_: id_sector,check_status_1: check_status_1,check_status_2: check_status_2},
function(data){$("#msg").html(data);});
}
});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body><table class="mana"><tr><td>
<font color="#0033FF" ><strong>เพิ่มข้อมูลใหม่</strong></font><p>
<form id="f1" method="post" >
ชื่อห้อง :<input type="text" id="a" > 
</td></tr><tr><td>
อาคาร : <select name="b" id="b">
<option value="0">--กรุณาเลือก--</option>
<?php 
$resultb = mysql_query("SELECT * FROM building");
$numb = mysql_num_rows($resultb);
$j=0;
while($j<$numb){	
$fetchb  = mysql_fetch_array($resultb);
$id_building_temp = $fetchb['id_building'];
$building_temp = $fetchb['building'];
?><option value="<?php echo $id_building_temp; ?>"><?php echo $building_temp; ?></option><?
$j++; }
?></select>
</tr></td><td>
<label id="floor" ></label>
</td>
<tr>
<td>
หน่วยงาน : 
 <select name="d" id="d">
<option value="0">--กรุณาเลือก--</option>
<?php 
while($i<$num){	
$fetch  = mysql_fetch_array($result);
$id_sector_temp = $fetch['id_sector'];
$sector_temp = $fetch['sector'];
?><option value="<?php echo $id_sector_temp; ?>"><?php echo $sector_temp; ?></option><?
$i++;
}?></select>
</td>
<td>
<input type="button" id="bt" value="เพิ่มข้อมูล">
</form>
</td></tr></table>

</body>