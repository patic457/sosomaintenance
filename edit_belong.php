<?php include"session.php";include"db.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#btt").click(function(){var id_belong_=<?php echo $_POST['id_belong_']; ?>;var belong_=$("#belong_edit").attr("value");var check_status_1='belong';var check_status_2='edit';
$.post("check_admin.php",{id_belong_: id_belong_,belong_: belong_,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<?php 
$result = mysql_query("SELECT * FROM belong WHERE id_belong='$_POST[id_belong_]'");
$num = mysql_num_rows($result);
$fetch  = mysql_fetch_array($result);	
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<table class="mana">
<tr><th>แก้ไขข้อมูล</th></tr>
<tr><td>
<form id="f1" method="post" >
ชื่อสังกัด :<input type="text" name="belong_edit" id="belong_edit" value="<?php echo $fetch['belong']; ?>" ></td><td>
  <input type="button" id="btt" value="ส่งข้อมูล"/>
</form>
</td></tr></table>


</body>