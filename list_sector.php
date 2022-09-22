<?php include"session.php"; 

//Page

$pagesize = 15;
// แบ่งหน้าแสดงผล

if(isset($_GET['link_a'])==true){$sql_page=mysql_query("SELECT count(id_sector) as id_sector FROM sector WHERE id_belong='$_GET[link_a]'");}
else if(isset($_GET['link_b'])==true){$sql_page=mysql_query("SELECT count(id_sector) as id_sector FROM sector WHERE id_building='$_GET[link_b]'");}
else{ $sql_page=mysql_query("SELECT count(id_sector) as id_sector FROM sector");}


//$sql_page = mysql_query("SELECT count(id_sector) as id_sector FROM sector");
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

if(isset($_GET['link_a'])==true){$sql_ = "SELECT * FROM sector WHERE id_belong='$_GET[link_a]' ORDER BY id_belong,id_building ASC limit $start,$pagesize";}
else if(isset($_GET['link_b'])==true){ $sql_ = "SELECT * FROM sector WHERE id_building='$_GET[link_b]' ORDER BY id_belong,id_building ASC limit $start,$pagesize";}
else{ $sql_ = "SELECT * FROM sector ORDER BY id_belong,id_building ASC limit $start,$pagesize"; }

$result_sector = mysql_query($sql_);
$num_sector = mysqli_num_rows($result_sector);
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
              
<div id="add-div" style="display:none;"><?php include"add_sector.php";?></div>
<p><div id="del-div"></div>
<p><div id="edit-div"></div>

<p align="center" class="title">รายชื่อหน่วยงาน</p>
<br><form id="f1" method="post">
<table class="css">
<tr >
  <th scope="col">ชื่อหน่วยงาน</th>
  <th scope="col">สังกัด</th>
	<th scope="col">อาคาร</th>
<th scope="col">จำนวนของห้อง</th>
   <th scope="col">ลบ</th>
    <th scope="col">แก้ไข</th>
  </tr>
<?


$i=0;

while($i<$num_sector){	
$fetch  = mysqli_fetch_array($result_sector);
$id_sector_temp = $fetch['id_sector'];
$sector_temp = $fetch['sector'];
$id_belong_temp = $fetch['id_belong'];
$id_building_temp = $fetch['id_building'];
?>

<script language="javascript">

$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
     var check_status_1='sector';var check_status_2='del';var id_sector_ = "<?php echo $id_sector_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_sector_:id_sector_},
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
		var check_status_1='sector';var check_status_2='edit';var id_sector_="<?php echo $id_sector_temp; ?>";
		$.post("edit_sector.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_sector_: id_sector_},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});

$(function(){
	$("#click<?php echo $i; ?>").click(function(){
				Location("index.php?m=10&&link_s=<?php echo $id_sector_temp; ?>");				
			});
});
</script>
<?

$result_ = mysql_query("SELECT belong FROM belong WHERE id_belong='$id_belong_temp'");
$fetch_  = mysqli_fetch_array($result_);
$belong_temp = $fetch_['belong'];

$result_build = mysql_query("SELECT building FROM building WHERE id_building='$id_building_temp'");
$fetch_build  = mysqli_fetch_array($result_build);
$building_temp = $fetch_build['building'];
?>

<tr style="cursor:pointer;" ><td align="center" id="click<?php echo $i; ?>"><?php print $sector_temp; ?></td>
<td align="center" id="click<?php echo $i; ?>"><?php echo $belong_temp; ?></td>
<td align="center" id="click<?php echo $i; ?>"><?php echo $building_temp; ?></td>
<td>
<?
$sql_row = mysql_query("SELECT * FROM room WHERE id_sector='$id_sector_temp'");
$row_s = mysqli_num_rows($sql_row);
echo $row_s;
?>
</td>
<td align="center"><img src="images/del.png" width="20" height="20" id="btd<?php echo $i; ?>" title="ลบข้อมูล"></td>
<td align="center"><img src="images/edit.png" width="20" height="20" id="bte<?php echo $i; ?>"title="แก้ไขข้อมูล"></td>
</td></tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {
	if ($i_page == $_GET['pageid']) {echo "| $i_page ";} 
	else { 
		if(isset($_GET['link_a'])==true){echo" | <a href=\"index?m=9&&link=$_GET[link_a]&&pageid=$i_page\">$i_page</a> ";  }
		else if(isset($_GET['link_b'])==true){echo" | <a href=\"index?m=9&&link=$_GET[link_b]&&pageid=$i_page\">$i_page</a> ";  }
		else{echo" | <a href=\"index?m=9&&pageid=$i_page\">$i_page</a> ";}
	}
}
//End
?>
</table></form>
<div id="msg"></div>


  