<?php include"session.php";
//Page

$pagesize = 10;
// แบ่งหน้าแสดงผล
$sql_page = mysql_query("SELECT count(id_prename) as id_prename FROM prename");
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
<link rel="stylesheet" type="text/css" href="style_admin.css" />   
<script language="javascript">
$(function(){
	$("#bta").click(function(){
		$("#add-div").toggle("slow");
		});
		
});
</script>

<div id="bta" align="right"><img src="images/add.png" width="20" height="20" id="">เพิ่มข้อมูล</div>
              
<div id="add-div" style="display:none;"><?php include"add_prename.php";?></div>
<p><div id="del-div"></div>
<p><div id="edit-div"></div>         
<div id='title'>รายชื่อคำนำหน้า</div>
<br><form id="f1" method="post">
<table class="css">
<tr >
   <th scope="col">คำนำหน้า</th>
  <th scope="col">ลบ</th>
  <th scope="col">แก้ไข</th>
  </tr>
<?

$result = mysql_query("SELECT * FROM prename order by id_prename ASC limit $start,$pagesize");
$num = mysqli_num_rows($result);
$i=0;

while($i<$num){	

$fetch  = mysqli_fetch_array($result);
$id_prename_temp = $fetch['id_prename'];
$prename_temp = $fetch['prename'];
?>

<script language="javascript">

$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
      var check_status_1='prename';var check_status_2='del';var id_prename="<?php echo $id_prename_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_prename_:id_prename},
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
		var id_prename="<?php echo $id_prename_temp; ?>";
		$.post("edit_prename.php",
			{id_prename_: id_prename},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});
</script>

<tr><td align="center"><?php print $prename_temp; ?></td>
<td align="center"><img src="images/del.png" width="20" height="20" id="btd<?php echo $i; ?>"></td>
<td align="center"><img src="images/edit.png" width="20" height="20" id="bte<?php echo $i; ?>"></td>
</td></tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {if ($i_page == $_GET['pageid']) {echo "| $i_page ";} else { 
echo" | <a href=\"index?m=13&&pageid=$i_page\">$i_page</a> ";  }
}
//End
?>
</table>

<div id="msg"></div>
  
		