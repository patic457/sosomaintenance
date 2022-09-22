 <?php include"session.php";include"func.php"; ?>
<html>
<head><script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("#bta").click(function(){
		$("#add-div").toggle("fast");
		});
		
});



function showResult(str)
{
if (str.length==0)
  {
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }

if(window.ActiveXObject)
  {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
else if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="0.1em ";
    }
  }


//xmlhttp.open("GET","server.php?q="+decodeURIComponent(str),true);
xmlhttp.open("GET","server.php?q="+str,true);
xmlhttp.send();
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.style1 {
	color: #006699;
	font-size: 14px;
}
-->
</style>
</head>
<body>

<form><center>
  <span class="style1">กรุณากรอกชื่อของผู้ที่ต้องค้นหา : </span>
  <input type="text" size="30" onKeyUp="showResult(this.value)" />
</form></center>
<div align="right"><label id="bta"><img  src="images/add.png" border="0" width="20" height="20" >เพิ่มข้อมูล</label></div>
<div id="add-div" style="display:none;"><?php include"add_user.php"; ?></div>
<div id="livesearch"></div>
<div id="msg"></div>
<?php if($_GET['m']=='15'&&$_GET['check']=='edit'){include"edit_user.php";} ?>
</body>
</html> 