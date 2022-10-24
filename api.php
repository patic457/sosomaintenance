<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("Asia/Bangkok");

function createWebhook($conn, $table)
{
    $res = 0;
    $data = json_decode(file_get_contents('php://input'), true);
    $json_string = json_encode($data);
    if (isset($json_string) || $json_string == '' || $json_string == null) {
        $sql = "INSERT INTO $table (id, list) VALUES(NULL, '$json_string');";
        mysqli_query($conn, $sql);
        $res = mysqli_insert_id($conn);
        return $res;
    }
}

function convertDateTime($datetime)
{
    $d  = date("Y-m-d H:i:s", strtotime($datetime));
    return $d;
}

function checkStatusTicket($conn, String $table, Object $obj)
{
    $sql = "SELECT * FROM " . $table . " WHERE id = $obj->id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    return intval($num);
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
            $message_teams_tmp = $message_incident_tmp->{'teams'};
            $message_log_entries_tmp = $message_tmp[0]->{'log_entries'}[0];
            $message_log_entries_agent_tmp = $message_log_entries_tmp->{'agent'};
            $message_log_entries_channel_tmp = $message_log_entries_tmp->{'channel'};


            $obj = new stdClass();
            $obj->incident_event = $message_tmp[0]->{'event'};
            $obj->id = intval($message_incident_tmp->{'incident_number'});
            $obj->status = $message_incident_tmp->status;
            $obj->problemCategoryName = $message_service_tmp->name;
            $obj->updatedAt = $dateTime;
            $obj->criticalityName = $message_priority_tmp->name;
            $obj->problemName = $message_incident_tmp->{'title'};

            $obj->srcChannel = $message_service_tmp->{'summary'};
            $obj->channelId  = $message_service_tmp->{'summary'};
            $obj->reportedDate  = $dateTime;
            $convert_created_at = convertDateTime($message_incident_tmp->{'created_at'});
            $obj->createdAt = $convert_created_at;

            $obj->teamId = null;
            if (count($message_teams_tmp) > 0) {
                $obj->teamId = $message_teams_tmp[0]->{'summary'};
            }
            $obj->dueDate = null;
            if (count($message_acknowledgements_tmp) > 0) {
                $convert_at = convertDateTime($message_acknowledgements_tmp[0]->{'at'});
                $obj->dueDate = $convert_at;
            }
            $obj->description = null;
            if (isset($message_log_entries_channel_tmp->{'details'})) {
                $obj->description = $message_log_entries_channel_tmp->{'details'};
            }

            $obj->createdBy = $message_log_entries_agent_tmp->{'summary'};
            $obj->updatedBy = $obj->createdBy;
            $obj->notification_status = intval($fetch['notification_status']);
            $obj->messagesLogs = $jsondecode_tmp;
            // array_push($data, $obj);
        }
    }

    return $obj;
}

function insertTicket($conn, String $table, Object $obj)
{
    $hookBy = $obj->createdBy;
    $val = "('$obj->id','$obj->status','$obj->srcChannel','$obj->problemCategoryName','$obj->criticalityName','$obj->problemName','$obj->description','$obj->teamId','$obj->channelId','$obj->dueDate','$hookBy','$hookBy','$obj->createdAt','$obj->updatedAt');";
    $sql = "INSERT INTO " . $table . " (id,status,srcChannel,problemCategoryName,criticalityName,problemName,description,teamId,channelId,dueDate,createdBy,updatedBy,createdAt,updatedAt) VALUES " . $val;
    mysqli_query($conn, $sql);
    $lastId = mysqli_insert_id($conn);
    return  json_encode('{"res": ' . $lastId . '}');
}

function updateTicket($conn, String $table, Object $obj)
{
    $incident_event = $obj->incident_event;

    $sql_if = '';
    $sql_tbl =  "UPDATE $table SET ";
    $sql_where = "WHERE id='$obj->id'";
    $sql_updatedBy = ",updatedBy='$obj->updatedBy' ";
    $sql_updateAt = ",updatedAt='$obj->updatedAt' ";
    $sql_duedate = ",dueDate='$obj->dueDate' ";
    $sql_status = "status='$obj->status' ";
    if ($incident_event == "incident.acknowledge") {
        $sql_if = $sql_duedate;
    } else if ($incident_event == "incident.assign") {
    } else if ($incident_event == "incident.annotate") {
    } else if ($incident_event == "incident.resolve") {
    }

    $sql = $sql_tbl . $sql_status . $sql_updateAt . $sql_updatedBy . $sql_if . $sql_where;
    // echo $sql;
    mysqli_query($conn, $sql);
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

$res_json = '{}';
$last_id = createWebhook($conn, $table);
if ($last_id != 0) {
    $dataPagerduty = adaptorPagerduty($conn, $table, $last_id);
    $checkStatusTicket = checkStatusTicket($conn, $tableTicket,  $dataPagerduty);
    if ($checkStatusTicket > 0) {
        //UPDATE
        $res_json = updateTicket($conn, $tableTicket, $dataPagerduty);
    } else {
        //CREATE
        $incident_event = $dataPagerduty->incident_event;
        if ($incident_event == "incident.trigger") {
            $res_json = insertTicket($conn, $tableTicket, $dataPagerduty);
        }
    }
}

header("Content-Type: application/json");
// echo $res_json;


$conn->close();
