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
        return mysqli_insert_id($conn);
    }
}

function convertDateTime($datetime)
{
    $d  = date("Y-m-d H:i:s", strtotime($datetime));
    return $d;
}

function adaptorPagerduty($conn, $table, $last_id)
{
    $dateTime = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM " . $table . " WHERE id = $last_id";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $num = mysqli_num_rows($result);
    for ($q = 0; $num > $q; $q++) {
        $fetch = mysqli_fetch_array($result);
        $jsondecode_tmp =  json_decode($fetch[1]);
        if ($jsondecode_tmp != null) {
            $message_tmp = $jsondecode_tmp->{'messages'};
            $message_incident_tmp = $message_tmp[0]->{'incident'};
            $message_service_tmp = $message_incident_tmp->{'service'};
            $message_priority_tmp = $message_incident_tmp->{'priority'};
            $message_acknowledgements_tmp = $message_incident_tmp->{'acknowledgements'};

            $obj = new stdClass();
            $obj->incident_event = $message_tmp[0]->{'event'};
            $obj->id = intval($message_incident_tmp->{'incident_number'});
            $obj->status = $message_incident_tmp->status;
            $obj->problemCategoryName = $message_service_tmp->name;
            $obj->updatedAt = $dateTime;
            $obj->criticalityName = $message_priority_tmp->name;
            $obj->problemName = $message_incident_tmp->{'title'};
            $obj->description = $message_incident_tmp->{'description'};
            $obj->reportedDate  = $dateTime;
            $convert_created_at = convertDateTime($message_incident_tmp->{'created_at'});
            $obj->createdAt = $convert_created_at;
            $obj->dueDate = null;
            if (count($message_acknowledgements_tmp) > 0) {
                $convert_at = convertDateTime($message_acknowledgements_tmp[0]->{'at'});
                $obj->dueDate = $convert_at;
            }

            $obj->notification_status = intval($fetch['notification_status']);
            $obj->messagesLogs = $jsondecode_tmp;
            // array_push($data, $obj);
        }
    }

    return $obj;
}

function insertInTicket($conn, String $table, Object $obj)
{
    $hookBy = "PagerDuty";
    $val = "('$obj->id','$obj->status','$obj->problemCategoryName','$obj->criticalityName','$obj->problemName','$obj->description','$obj->dueDate','$hookBy','$hookBy','$obj->createdAt','$obj->updatedAt');";
    $sql = "INSERT INTO " . $table . " (id,status,problemCategoryName,criticalityName,problemName,description,dueDate,createdBy,updatedBy,createdAt,updatedAt) VALUES " . $val;
    mysqli_query($conn, $sql);
    $lastId = mysqli_insert_id($conn);
    return  json_encode('{"res": ' . $lastId . '}');
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

$last_id = createWebhook($conn, $table);

$dataPagerduty = adaptorPagerduty($conn, $table, $last_id);

$res = insertInTicket($conn, $tableTicket, $dataPagerduty);

header("Content-Type: application/json");
echo $res;

$conn->close();
