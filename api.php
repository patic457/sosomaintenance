<?php


$servername = "iu51mf0q32fkhfpl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "de7p9prkwmh3kquo";
$password = "j2batag6pvrfimgh";
$dbname = "g3uky2wss1pv3jyv";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<hr>");
} 

$postdata = http_build_query(
    array(
        'var1' => 'some content',
        'var2' => 'doh'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json',
        'content' => $postdata
    )
);

$data = json_decode(file_get_contents('php://input'), true);
$json_string = json_encode($data);

$expression = $json_string;

echo '<script>console.log("'.htmlspecialchars(stripslashes(str_replace(array("\r", "\n"), '', var_export($expression, true)))).'")</script>';

echo $json_string;


$conn->close();
