<?php include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#btt").click(function(){var id_building_=<?php echo $_POST['id_building_']; ?>;var building=$("#building_edit").attr("value");var floorr=$("#floor_edit").attr("value");var check_status_1='building';var check_status_2='edit';
$.post("check_admin.php",{id_building_: id_building_,building_: building,floor_: floorr,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<?php 
$result = mysql_query("SELECT * FROM building WHERE id_building='$_POST[id_building_]'");
$num = mysql_num_rows($result);
$fetch  = mysql_fetch_array($result);	
?>
<body><table class="mana"><tr><td>
<tr><th>แก้ไขข้อมูล</th></tr>
<tr><td>
<form id="f1" method="post" >
ชื่ออาคาร : <input type="text" id="building_edit" name="building_edit"  value="<?php echo $fetch['building']; ?>">
</td><td>
ชั้นทั้งหมด : <input name="floor_edit" id="floor_edit" type="text" maxlength="2" value="<?php echo $fetch['floor']; ?>" >
<input type="button" id="btt" value="บันทึกข้อมูล"/>
</form>
</td></tr></table>




</body>