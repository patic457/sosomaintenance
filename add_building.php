<? include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(function(){var building_=$("#building_").attr("value");var floor_=$("#floor_").attr("value");var check_status_1='building';var check_status_2='add';
$.post("check_admin.php",{building_: building_,floor_: floor_,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<body><table class="mana"><tr><td>
<tr><th>เพิ่มข้อมูลใหม่</th></tr>
<tr><td>
<form id="f1" method="post" >
ชื่ออาคาร : <input type="text" id="building_" name="building_" >
</td><td>
ชั้นทั้งหมด : <input name="floor_" id="floor_" type="text" maxlength="2" >
<input type="button" id="bt" value="บันทึกข้อมูล"/>
</form>
</td></tr></table>




</body>