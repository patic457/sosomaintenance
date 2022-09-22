<? include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(function(){var prename=$("#a").attr("value");var check_status_1='prename';var check_status_2='add';
$.post("check_admin.php",{prename_: prename,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<script src="jquery.js" language="javascript" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body><table class="mana">
<tr><td>เพิ่มข้อมูลใหม่</td><tr><td>
<form id="f1" method="post" >
คำนำหน้า :
   <input type="text" name="a" id="a" >&nbsp;
  <input type="button" id="bt" value="ส่งข้อมูล"/>
</form></td></tr></table>

</body>