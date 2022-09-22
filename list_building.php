<?php include"session.php"; 

//Page

$pagesize = 10;
// แบ่งหน้าแสดงผล
$sql_page = mysql_query("SELECT count(id_building) as id_building FROM building");
$crow = mysql_fetch_row($sql_page);
$totalrecord = $crow[0];
$totalpage = ceil($totalrecord / $pagesize);
if (isset($_GET['pageid'])) {
$start = $pagesize * ($_GET['pageid'] - 1);
}
else {
$pageid = 1;
$start = 0;
}
//$result = mysql_query("SELECT * FROM building ORDER BY id_building DESC limit $start,$pagesize"); ต้องใช้ทุกครั้ง
//End Page

?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){
	$("#bta").click(function(){
		$("#add-div").toggle("fast");
		});
		
});
</script>
   
<div id="bta" align="right"><img src="images/add.png" width="20" height="20" id="">เพิ่มข้อมูล</div>
              
<div id="add-div" style="display:none;"><?php include"add_building.php";?></div>

<p><div id="del-div"></div>
<p><div id="edit-div"></div>
<div class='title'>รายชื่ออาคาร</div><p>
<form id="list1" method="post">
<table class="css"><tr>
<th scope="col">ชื่ออาคาร</th>
  <th scope="col">มีชั้นทั้งหมด</th>
	<th scope="col">จำนวนของหน่วยงาน</th>
  <th scope="col">ลบ</th>
    <th scope="col">แก้ไข</th>
  </tr>
<?

$result = mysql_query("SELECT * FROM building ORDER BY id_building DESC limit $start,$pagesize");
$num = mysqli_num_rows($result);
$i=0;

while($i<$num){	

$fetch  = mysqli_fetch_array($result);
$id_building_temp = $fetch['id_building'];
$building_temp = $fetch['building'];
$floor_temp = $fetch['floor'];
?>

<script language="javascript">
$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
       var check_status_1='building';var check_status_2='del';var id_building_ = "<?php echo $id_building_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_building_:id_building_},
			function(data){
				$("#del-div").html(data);
				
			});
    }else{
	 return false;
	}
		});
		
});

$(function(){
	$("#bte<?php echo $i; ?>").click(function(){
		var check_status_1='building';var check_status_2='edit';var id_building_="<?php echo $id_building_temp; ?>";
		$.post("edit_building.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_building_: id_building_},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});

$(function(){
	$("#click<?php echo $i; ?>").click(function(){
				Location("index.php?m=9&&link_b=<?php echo $id_building_temp; ?>");				
			});
});
</script>


<tr style="cursor:pointer;" >
<td id="click<?php echo $i; ?>">
<?php print $building_temp; ?>
</td>
<td id="click<?php echo $i; ?>">
<?php echo $floor_temp; ?>
</td>
<td id="click<?php echo $i; ?>">
<?
$sql_row = mysql_query("SELECT * FROM sector WHERE id_building='$id_building_temp'");
$row_s = mysqli_num_rows($sql_row);
echo $row_s;
?>
</td>
<td>
<img id="btd<?php echo $i; ?>" src="images/del.png" width="20" height="20"  border='0' title="ลบข้อมูล" >
</td>
<td>
<img id="bte<?php echo $i; ?>" src="images/edit.png" width="20" height="20"  border='0' title="แก้ไขข้อมูล" >
</td>
</td>
</tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {if ($i_page == $_GET['pageid']) {echo "| $i_page ";} else { 
echo" | <a href=\"index?m=7&&pageid=$i_page\">$i_page</a> ";  }
}
//End
?>
</table>
</form>
<div id="msg"></div>