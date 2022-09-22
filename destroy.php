<?php if (!session_id()) session_start();; 
include"db.php";
 
session_destroy();
session_unset ();

echo"<script>Location('login.php');</script>"; 
//echo"<script>alert('Thank you');</script>"; 

?>