<?php include"session.php"; 

//Page

$pagesize = 15;
// แบ่งหน้าแสดงผล

if(empty($_GET['link_s'])!=true){$sql_page=mysql_query("SELECT count(id_room) as id_room FROM room WHERE id_sector='$_GET[link_s]'");}
else if(empty($_GET['link_b'])!=true){$sql_page=mysql_query("SELECT count(id_room) as id_room FROM room WHERE id_building='$_GET[link_b]'");}
else{ $sql_page=mysql_query("SELECT count(id_room) as id_room FROM room");}

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
//$result = mysql_query("SELECT * FROM building ORDER BY id_building ASC limit $start,$pagesize"); ต้องใช้ทุกครั้ง
//End Page
?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />  
<script language="javascript">
$(function(){
	$("#bta").click(function(){
		$("#add-div").toggle("slow");
		});
		
});
</script>           
<style>
.css td{
cursor:default;
}
</style>
<div id="bta" align="right"><img src="images/add.png" width="20" height="20" id="">เพิ่มข้อมูล</div>
              
<div id="add-div" style="display:none;"><?php include"add_room.php";?></div>
<p><div id="del-div"></div>
<p><div id="edit-div"></div>
<div class="title">รายชื่อห้อง</div><p>
<form id="f1" method="post">
<table align="center" class="css">
<tr>
<th scope="col">ชื่อห้อง</th>
    <th scope="col">อาคาร</th>
    <th scope="col">ชั้น</th>
      <th scope="col">ชื่อหน่วยงาน</th>
    <th scope="col">ลบ</th>
    <th scope="col">แก้ไข</th>
   </tr>
<?


if(isset($_GET['link_s'])==true){ $sql_ = "SELECT * FROM room WHERE id_sector='$_GET[link_s]' ORDER BY id_building,floor,id_sector ASC limit $start,$pagesize";}
else if(isset($_GET['link_b'])==true){ $sql_ = "SELECT * FROM room WHERE id_building='$_GET[link_b]' ORDER BY id_building,floor,id_sector ASC limit $start,$pagesize";}
else{$sql_ = "SELECT * FROM room ORDER BY id_building,floor,id_sector ASC limit $start,$pagesize";}

$result_room = mysql_query($sql_);
$num_room = mysqli_num_rows($result_room);

$i=0;

while($i<$num_room){	
$fetch  = mysqli_fetch_array($result_room);
$id_room_temp = $fetch['id_room'];
$room_temp = $fetch['room'];
$id_sector_temp = $fetch['id_sector'];
$id_building_temp = $fetch['id_building'];
$floor_temp = $fetch['floor'];
?>

<script language="javascript">

$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
      var check_status_1='room';var check_status_2='del';var id_room= "<?php echo $id_room_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_room_:id_room},
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
		var check_status_1='room';var check_status_2='edit';var id_room_="<?php echo $id_room_temp; ?>";
		$.post("edit_room.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_room_: id_room_},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});
</script>

<?



$result = mysql_query("SELECT * FROM sector WHERE id_sector='$id_sector_temp'");

$fetch  = mysqli_fetch_array($result);
$sector_temp = $fetch['sector'];

$resultb = mysql_query("SELECT * FROM building WHERE id_building='$id_building_temp'");

$fetchb  = mysqli_fetch_array($resultb);
$id_building_temp = $fetchb['id_building'];

$result_ = mysql_query("SELECT building FROM building WHERE id_building='$id_building_temp'");
$fetch_  = mysqli_fetch_array($result_);
$building_temp = $fetch_['building'];
?>

<tr><td align="center"><?php print $room_temp; ?></td>
<td align="center" <?php echo $id_building_temp; ?>><?php print $building_temp; ?></td>
<td align="center"><?php print $floor_temp; ?></td>
<td align="center"><?php print $sector_temp; ?></td>
<td align="center"><img src="images/del.png" width="20" height="20" id="btd<?php echo $i; ?>"></td>
<td align="center"><img src="images/edit.png" width="20" height="20" id="bte<?php echo $i; ?>"></td>
</td></tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {
	if ($i_page == $_GET['pageid']) {echo "| $i_page ";} 
	else {
		if(isset($_GET['link_b'])==true){echo" | <a href=\"index?m=10&&link_b=$_GET[link_b]&&pageid=$i_page\">$i_page</a> ";} 
			else if(isset($_GET['link_s'])==true){echo" | <a href=\"index?m=10&&link_s=$_GET[link_s]&&pageid=$i_page\">$i_page</a> ";} 
				else{echo" | <a href=\"index?m=10&&pageid=$i_page\">$i_page</a> ";}
	}
}
//End
?>
</table></form>
<div id="msg"></div>


  