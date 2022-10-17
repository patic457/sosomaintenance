<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "iu51mf0q32fkhfpl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "de7p9prkwmh3kquo";
$password = "j2batag6pvrfimgh";
$dbname = "g3uky2wss1pv3jyv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<hr>");
}

$postdata = http_build_query(
    array(
        'var1' => 'some content',
        'var2' => 'doh'
    )
);

$opts = array(
    'http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json',
        'content' => $postdata
    )
);

$table = "g3uky2wss1pv3jyv.webhooks";
$sql = "SELECT * FROM " . $table;
$result = mysqli_query($conn, $sql);
$data = [];
$num = mysqli_num_rows($result);
for ($q = 0; $num > $q; $q++) {
    $fetch = mysqli_fetch_array($result);
    $message_tmp =  json_decode($fetch[1]);
    if ($message_tmp != null) {
        $message_incident_tmp = $message_tmp['incident'];
    
        $obj = new stdClass();
        $obj->id = intval($fetch['id']);
        $obj->eventIncident = $message_incident_tmp->{'status'};
        $obj->notificationStatus = intval($fetch['notificationStatus']);
        $obj->message = $message_tmp->{'messages'};
        array_push($data, $obj);
    }
}

// $res = array(array_filter($data, fn ($value) => !is_null($value)));
$res = $data;

header("Content-Type: application/json");
echo json_encode($res);


$conn->close();
