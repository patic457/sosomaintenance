<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function createWebhook($conn, $table)
{
    $data = json_decode(file_get_contents('php://input'), true);
    $json_string = json_encode($data);

    if (isset($json_string) || $json_string == '') {
        $sql = "INSERT INTO $table (id, list) VALUES(NULL, '$json_string');";
        mysqli_query($conn, $sql);
    }
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
            $message_service_tmp = $message_incident_tmp[0]->{'service'};
            $message_priority_tmp = $message_incident_tmp[0]->{'priority'};
            $message_acknowledgements_tmp = $message_incident_tmp[0]->{'acknowledgements'};

            $obj = new stdClass();
            $obj->incident_event = $message_tmp[0]->{'event'};
            $obj->id = intval($message_incident_tmp->{'incident_number'});
            $obj->status = $message_incident_tmp->status;
            $obj->problemCategoryName = $message_service_tmp->name;
            $obj->updatedAt = new DateTime();
            $obj->criticalityName = $message_priority_tmp->name;
            $obj->problemName = $message_incident_tmp->{'title'};
            $obj->description = $message_incident_tmp->{'description'};
            $obj->reportedDate  = new DateTime();
            $obj->dueDate = $message_acknowledgements_tmp->{'at'};
            $obj->createdAt = $message_incident_tmp->{'created_at'};

            $obj->notification_status = intval($fetch['notification_status']);
            $obj->messagesLogs = $jsondecode_tmp;
            array_push($data, $obj);
        }
    }
    return $data;
}

function insertInTicket($conn, $table, array $dataPagerduty)
{
    foreach ($dataPagerduty as $obj) {
        $sql = "INSERT INTO $table (id,status,problemCategoryName,criticalityName,problemName,description,dueDate,createdAt ) VALUES ($obj->id,$obj->status,$obj->problemCategoryName,$obj->problemName,$obj->description,$obj->dueDate,$obj->createdAt );";
        mysqli_query($conn, $sql);
    }
}



$servername = "iu51mf0q32fkhfpl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "de7p9prkwmh3kquo";
$password = "j2batag6pvrfimgh";
$dbname = "g3uky2wss1pv3jyv";
$table = "g3uky2wss1pv3jyv.webhooks";
$tableTicket = "g3uky2wss1pv3jyv._Ticket";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<hr>");
}

createWebhook($conn, $table);

$dataPagerduty = adaptorPagerduty($conn, $table);

insertInTicket($conn, $tableTicket, $dataPagerduty);

$conn->close();
