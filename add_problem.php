<?php include"session.php"; ?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(function(){var problem_=$("#problem_").attr("value");var check_status_1='problem';var check_status_2='add';
$.post("check_admin.php",{problem_: problem_,check_status_1: check_status_1,check_status_2: check_status_2},function(data){$("#msg").html(data);});
});
});
</script>
<body><table class="mana">
<tr><th>เพิ่มข้อมูลใหม่</th>
</tr>
<tr>
<td>
<form id="f1" method="post" >
ชื่อประเภทของปัญหา :<input type="text" id="problem_" >&nbsp;<input type="button" id="bt" value="ส่งข้อมูล"/>
</form>
</td>
</tr>
</table>


</body>