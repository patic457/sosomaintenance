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

function createWebhook($conn)
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
        $sql = "INSERT INTO g3uky2wss1pv3jyv.webhooks (id, list) VALUES(NULL, '$json_string');";
        // echo $sql;
        $query = mysqli_query($conn, $sql);
        $expression = $json_string;
        // echo var_export($expression, true);
    }
}

createWebhook($conn);

$conn->close();
