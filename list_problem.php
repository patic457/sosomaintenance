<?php include"session.php"; 

//Page

$pagesize = 10;
// แบ่งหน้าแสดงผล
$sql_page = $mysqli->query("SELECT count(id_problem) as id_problem FROM type_problem");
$crow = mysqli_fetch_row($sql_page);
$totalrecord = $crow[0];
$totalpage = ceil($totalrecord / $pagesize);
if (isset($_GET['pageid'])) {
$start = $pagesize * ($_GET['pageid'] - 1);
}
else {
$pageid = 1;
$start = 0;
}
//$result = $mysqli->query("SELECT * FROM building ORDER BY id_building DESC limit $start,$pagesize"); ต้องใช้ทุกครั้ง
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
              
<div id="add-div" style="display:none;"><?php include"add_problem.php";?></div>
<p><div id="del-div"></div>
<p><div id="edit-div"></div>

<p>
<p align="center" class='title'>รายชื่อประเภทที่แจ้ง</p>
<form id="f1" method="post">
<table align="center" class="css">
<tr>
  <th scope="col">ชื่อประเภทของปัญหา</th>
  <th scope="col">ลบ</th>
  <th scope="col">แก้ไข</th>
  </tr>
<?
$result = $mysqli->query("SELECT * FROM type_problem ORDER BY id_problem ASC limit $start,$pagesize");
$num = mysqli_num_rows($result);
$i=0;

while($i<$num){	

$fetch  = mysqli_fetch_array($result);
$id_problem_temp = $fetch['id_problem'];
$problem_temp = $fetch['problem'];
?>

<script language="javascript">

$(function(){
	$("#btd<?php echo $i; ?>").click(function(){
		if(confirm('คุณต้องการลบข้อมูลนี้ ?')==true)
    {
      var check_status_1='problem';var check_status_2='del';var id_problem_ = "<?php echo $id_problem_temp; ?>";
		$.post("check_admin.php",
			{check_status_1: check_status_1,check_status_2: check_status_2,id_problem_:id_problem_},
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
		var id_problem_="<?php echo $id_problem_temp; ?>";
		$.post("edit_problem.php",
			{id_problem_: id_problem_},
			function(data){
				$("#edit-div").html(data);
				
			});
		});
		
});

$(function(){
	$("#click<?php echo $i; ?>").click(function(){
				Location("index.php?m=12&&link=<?php echo $id_problem_temp; ?>");				
			});
});
</script>

<tr><td align="center" id="click<?php echo $i; ?>"><?php print $problem_temp; ?></td>
<td align="center"><img src="images/del.png" width="20" height="20" id="btd<?php echo $i; ?>"></td>
<td align="center"><img src="images/edit.png" width="20" height="20" id="bte<?php echo $i; ?>"></td>
<input type="hidden" id="id<?php echo $i; ?>" value="<?php echo $id_problem_temp; ?>" />

</td></tr> 

<?
$i++;
}
//Next Page
for ($i_page=1; $i_page<=$totalpage; $i_page++) {if ($i_page == $_GET['pageid']) {echo "| $i_page ";} else { 
echo" | <a href=\"index?m=11&&pageid=$i_page\">$i_page</a> ";  }
}
//End
?>
</table>

<div id="msg"></div>
  
			