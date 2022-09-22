<?php include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#btt").click(function(){var id_sector=<?php echo $_POST['id_sector_']; ?>;var sector_name=$("#sector_name").attr("value");
var id_belong_sel=$("#id_belong_sel").attr("value");var id_building_select=$("#id_building_sel").attr("value");var check_status_1='sector';var check_status_2='edit';
if(sector_=='' || id_belong_=='0' ){alert('กรุณากรอกข้อมูลให้ครบถ้วน');}else{
$.post("check_admin.php",{id_sector_: id_sector,sector_: sector_name,id_belong_: id_belong_sel,id_building_: id_building_select,check_status_1: check_status_1,check_status_2: check_status_2},
function(data){$("#msg").html(data);}); }
});
});
</script>
<?
$result_sector = mysql_query("SELECT * FROM sector WHERE id_sector='$_POST[id_sector_]'");
$fetch_sector  = mysql_fetch_array($result_sector);


?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body><table class="mana"><tr><td>
<tr><th>แก้ไขข้อมูล</th></tr>
<tr><td>
<form id="fe" method="post" >
ชื่อหน่วยงาน :<input type="text" id="sector_name" value="<?php echo $fetch_sector['sector'];?>" ><p>

อาคาร: <select id="id_building_sel">
<?php 
$result_bu = mysql_query("SELECT * FROM building");
$num_bu = mysql_num_rows($result_bu);
$bu=0; 
while($bu<$num_bu){	
$fetch_bu  = mysql_fetch_array($result_bu);
$id_building_temp_bu = $fetch_bu['id_building'];
$building_temp_bu = $fetch_bu['building'];
?><option <?php if($id_building_temp_bu==$fetch_sector['id_building']){echo "selected";} ?> value="<?php echo $id_building_temp_bu; ?>"><?php echo $building_temp_bu; ?></option><?
$bu++;
}?></select>

สังกัด : <select id="id_belong_sel">
<?
$result_be = mysql_query("SELECT * FROM belong");
$num_be = mysql_num_rows($result_be);
$se=0; 
while($se<$num_be){	
$fetch_be  = mysql_fetch_array($result_be);
$id_belong_temp_be = $fetch_be['id_belong'];
$belong_temp_be = $fetch_be['belong'];
?><option <?php if($id_belong_temp_be==$fetch_sector['id_belong']){echo "selected";} ?>  value="<?php echo $id_belong_temp_be; ?>"><?php echo $belong_temp_be; ?></option><?
$se++;
}?></select>

  <label>
  <input type="button" name="btt" id="btt" value="ส่งข้อมูล">
  </label>
</form></td></tr></table>
</body>