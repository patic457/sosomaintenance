<?php include"session.php"; 

//Page

$pagesize = 10;
// แบ่งหน้าแสดงผล
$sql_page = mysql_query("SELECT count(id_belong) as id_belong FROM belong");
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

$result = mysql_query("SELECT * FROM belong order by id_belong ASC limit $start,$pagesize");
$num = mysql_num_rows($result);

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
              
<div id="add-div" style="display:none;"><?php include"add_belong.php";?></div>
<p><div id="del-div"></div>
<p><div id="edit-div"></div>
<div class="title">รายชื่อสังกัด</div><p>
<form id="f1" method="post">

<table align="center" class="css">
  <tr><th scope="col">สังกัด</th>
<th scope="col">จำนวนของหน่วยงาน</th>
  <th scope="col">ลบ</th>
    <th scope="col">แก้ไข</th>
  </tr>
<?



$i=0;
while($i<$num){	
$fetch  = mysql_fetch_array($result);
$id_belong_temp = $fetch['id_belong'];
$belong_temp = $fetch['belong'];
?>

<script language="javascript">

$(function(){
	$("#bte<?php echo $i; ?>").click(function(){
		var check_status_1='belong';var check_status_2='edit';var id_belong_="<?php echo $id_belong_temp; ?>";
		$.post("edit_belong.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_belong_: id_belong_},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});

$(function(){
	$("#click<?php echo $i; ?>").click(function(){
				Location("index.php?m=9&&link_a=<?php echo $id_belong_temp; ?>");				
			});
});

$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
       var check_status_1='belong';var check_status_2='del';var id_belong_ = "<?php echo $id_belong_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_belong_:id_belong_},
			function(data){
				$("#del-div").html(data);
				
			});
    }else{
	 return false;
	}
		});
		
});

</script>


<tr style="cursor:pointer;">
<td id="click<?php echo $i; ?>" ><?php print $belong_temp; ?></td>
<td id="click<?php echo $i; ?>">
<?
$sql_row = mysql_query("SELECT * FROM sector WHERE id_belong='$id_belong_temp'");
$row_s = mysql_num_rows($sql_row);
echo $row_s;
?>
</td>
<td ><img src="images/del.png" width="20" height="20" title="ลบข้อมูล" id="btd<?php echo $i; ?>" border="0"></td>
<td ><img src="images/edit.png" width="20" height="20" title="แก้ไขข้อมูล" id="bte<?php echo $i; ?>" border="0"></td>

</td></tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {if ($i_page == $_GET['pageid']) {echo "| $i_page ";} else { 
echo" | <a href=\"index?m=8&&pageid=$i_page\">$i_page</a> ";  }
}
//End
?>
</table>

<div id="msg"></div>
  
			