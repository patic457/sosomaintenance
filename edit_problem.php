<?php include"session.php"; include"db.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#btt").click(function(){var id_problem=<?php echo $_POST['id_problem_']; ?>;var problem_name=$("#problem_name").attr("value");var check_status_1='problem';var check_status_2='edit';
$.post("check_admin.php",{id_problem_: id_problem,problem_: problem_name,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<?
$result_problem = mysql_query("SELECT * FROM type_problem WHERE id_problem='$_POST[id_problem_]'");
$num = mysqli_num_rows($result_problem);
$fetch  = mysqli_fetch_array($result_problem);	
?>
<body><table class="mana">
<tr><th>แก้ไขข้อมูล</th>
</tr>
<tr>
<td>
<form id="f1" method="post" >
ชื่อประเภทของปัญหา :<input type="text" id="problem_name" value="<?php echo $fetch['problem'];?>" >&nbsp;<input type="button" id="btt" value="ส่งข้อมูล"   >
</form>
</td>
</tr>
</table>


</body>