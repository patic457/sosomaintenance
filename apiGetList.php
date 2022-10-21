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
$sql = "SELECT * FROM " . $table . "ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$data = [];
$num = mysqli_num_rows($result);
for ($q = 0; $num > $q; $q++) {
    $fetch = mysqli_fetch_array($result);
    $jsondecode_tmp =  json_decode($fetch[1]);
    if ($jsondecode_tmp != null) {
        $obj = new stdClass();

        if ($num == 1) {
            $data = $jsondecode_tmp;
        } else {
            $message_tmp = $jsondecode_tmp->{'messages'};
            $message_incident_tmp = $message_tmp[0]->{'incident'};


            $obj->incident_event = $message_tmp[0]->{'event'};
            $obj->incident_status = $message_incident_tmp->status;
            $obj->incident_number = intval($message_incident_tmp->{'incident_number'});
            $obj->incident_title = $message_incident_tmp->{'title'};
            $obj->incident_description = $message_incident_tmp->{'description'};
            $obj->incident_created_at = $message_incident_tmp->{'created_at'};

            $obj->notification_status = intval($fetch['notification_status']);
            $obj->messagesLogs = $jsondecode_tmp;
        }


        array_push($data, $obj);
    }
}

// $res = array(array_filter($data, fn ($value) => !is_null($value)));

if ($num == 1) {
    $res = $data[0];
} else {
    $res = $data;
}

header("Content-Type: application/json");
echo json_encode($res);


$conn->close();
