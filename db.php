<?php 
session_start(); 
?>

<script src="jquery.js" language="javascript" type="text/javascript"></script>
<script  language="javascript" type="text/javascript">
function Location(u){window.location=u;}
function Back(){ history.back(); }
function desTroy() { window.location="destroy.php";}
function set(u,time){setTimeout(window.location=u,time);} 
function hideR(a,b){ $(a).hide();$(b).val("");}
function showR(a){ $(a).show();}

/*///////////////function popup/////////////////////*/	
/*var win=null;
function NewWindow(mypage,myname,w,h,pos,scrollbars,infocus){
if(pos=="random"){myleft=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;mytop=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){myleft=(screen.width)?(screen.width-w)/2:100;mytop=(screen.height)?(screen.height-h)/2:100;}
else if((pos!='center' && pos!="random") || pos==null){myleft=0;mytop=20}
settings="width=" + w + ",height=" + h + ",top=" + mytop + ",left=" + myleft + ",scrollbars="+scrollbars+",location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no";win=window.open(mypage,myname,settings);
win.focus();}*/
/*///////////////end/////////////////////*/	

</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

// $host = "localhost";
// $u = "root";
// $p = "root";
// $dbname = "vet_maintenance";

$host = "iu51mf0q32fkhfpl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$u = "de7p9prkwmh3kquo";
$p = "j2batag6pvrfimgh";
$dbname = "g3uky2wss1pv3jyv";


mysqli_connect($host,$u,$p,$dbname) or die("Error1");
// mysqli_select_db($dbname) or die("Error2");
// mysqli_query("SET NAMES UTF8");



?>


