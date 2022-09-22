<?php include"db.php"; include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#btt").click(function(){var prename=$("#ae").attr("value");var id_prename=<?php echo $_POST['id_prename_']; ?>;var check_status_1='prename';
var check_status_2='edit';
$.post("check_admin.php",{id_prename_: id_prename,prename_: prename,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<?
$result_pre = mysql_query("SELECT * FROM prename WHERE id_prename='$_POST[id_prename_]'");
$fetch_pre  = mysql_fetch_array($result_pre);
$prename_temp = $fetch_pre['prename'];
 ?>
 <table class="mana">
<tr><th>แก้ไขข้อมูล</th></tr>
<tr><td>
<form id="f1" method="post">
คำนำหน้า :
   <input type="text" id="ae" value="<?php echo $prename_temp; ?>" >&nbsp;
  <input type="button"  id="btt" value="ส่งข้อมูล"/>
</form>

</td></tr></table>