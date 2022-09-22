<?php include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(
	function(){
		var sector_=$("#sector_").attr("value");var id_belong_=$("#id_belong_").attr("value");var check_status_1='sector';var check_status_2='add';
		var id_building_=$("#id_building_").attr("value");
		if(sector_=='' || id_belong_=='0' || id_building_=='0'){alert('กรุณากรอกข้อมูลให้ครบถ้วน');}else{
			$.post("check_admin.php",{sector_: sector_,id_belong_: id_belong_,id_building_: id_building_,check_status_1: check_status_1,check_status_2: check_status_2},
			function(data){$("#msg").html(data);});
		}
	});
});
</script>
<?
$result = $mysqli->query("SELECT * FROM belong");
$num = mysqli_num_rows($result);
$i=0;

$result_b = $mysqli->query("SELECT * FROM building");
$num_b = mysqli_num_rows($result_b);
$j=0;
?>
<script language="javascript">
/*$(function(){$("#b").change(function(){var b_=$("#b").attr("value");
$.post("check_floor.php",{b: b_},function(data){$("#floor").html(data);});
});
});*/
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body><table class="mana"><tr><td>
<tr><th>เพิ่มข้อมูลใหม่</th></tr><tr><td>
<form id="f1" method="post">
ชื่อหน่วยงาน :<input type="text" id="sector_" ><p>
อาคาร: <select id="id_building_">
<option value="0">--กรุณาเลือก--</option>
<?php 
while($i<$num_b){	
$fetch_b  = mysqli_fetch_array($result_b);
$id_building_temp = $fetch_b['id_building'];
$building_temp = $fetch_b['building'];
?><option value="<?php echo $id_building_temp; ?>"><?php echo $building_temp; ?></option><?
$i++;
}?></select>

สังกัด : <select id="id_belong_">
<option value="0">--กรุณาเลือก--</option>
<?php 
while($j<$num){	
$fetch  = mysqli_fetch_array($result);
$id_belong_temp = $fetch['id_belong'];
$belong_temp = $fetch['belong'];
?><option value="<?php echo $id_belong_temp; ?>"><?php echo $belong_temp; ?></option><?
$j++;
}?></select>
  <label>
  
  <input type="button" name="bt" id="bt" value="ส่งข้อมูล">
  </label>
<div id="floor"></div></p><p>
</form></td></tr></table>
<p>

</body>