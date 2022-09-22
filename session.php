<?php 
include("db.php");
if(isset($_SESSION['username_session'])==true){}else{echo"<script>Location('login.php');</script>";}
