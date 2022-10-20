<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "iu51mf0q32fkhfpl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "de7p9prkwmh3kquo";
$password = "j2batag6pvrfimgh";
$dbname = "g3uky2wss1pv3jyv";
$table = "g3uky2wss1pv3jyv.webhooks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<hr>");
}

function adaptorPagerduty($conn, $table)
{
    $sql = "SELECT * FROM " . $table;
    $result = mysqli_query($conn, $sql);
    $data = [];
    $num = mysqli_num_rows($result);
    for ($q = 0; $num > $q; $q++) {
        $fetch = mysqli_fetch_array($result);
        $jsondecode_tmp =  json_decode($fetch[1]);
        if ($jsondecode_tmp != null) {
            $message_tmp = $jsondecode_tmp->{'messages'};
            $message_incident_tmp = $message_tmp[0]->{'incident'};

            $obj = new stdClass();
            $obj->incident_event = $message_tmp[0]->{'event'};
            $obj->incident_status = $message_incident_tmp->status;
            $obj->incident_number = intval($message_incident_tmp->{'incident_number'});
            $obj->incident_title = $message_incident_tmp->{'title'};
            $obj->incident_description = $message_incident_tmp->{'description'};
            $obj->incident_created_at = $message_incident_tmp->{'created_at'};

            $obj->notification_status = intval($fetch['notification_status']);
            $obj->messagesLogs = $jsondecode_tmp;
            array_push($data, $obj);
        }
    }
}

function createWebhook($conn, $table)
{

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

    $data = json_decode(file_get_contents('php://input'), true);
    $json_string = json_encode($data);

    if (isset($json_string) || $json_string == '') {
        $sql = "INSERT INTO $table (id, list) VALUES(NULL, '$json_string');";
        $query = mysqli_query($conn, $sql);
        $expression = $json_string;
        // echo var_export($expression, true);
    }
}

createWebhook($conn, $table);

adaptorPagerduty($conn, $table);

$conn->close();
