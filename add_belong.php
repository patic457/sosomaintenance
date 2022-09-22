<? include"session.php";include"db.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(function(){var belong_=$("#belong_").attr("value");var check_status_1='belong';var check_status_2='add';
$.post("check_admin.php",{belong_: belong_,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<table class="mana">
<tr><th>เพิ่มข้อมูลใหม่</th></tr>
<tr>
<td>
<form id="f1" method="post" >
ชื่อสังกัด :<input type="text" name="belong_" id="belong_" ></td><td>
  <input type="button" id="bt" value="ส่งข้อมูล"/>
</form>
</td></tr></table>


</body>