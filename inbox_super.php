<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<?php

include "db.php";
include "session.php";
include "func.php";

function Select($mysqli, $sta)
{
    $result = $mysqli->query("SELECT * FROM list_service WHERE job_status='$sta' ORDER BY id_list DESC");
    $num = mysqli_num_rows($result);
    if ($num != 0) {
    } else {
    }
    $i = 0;
    echo "<div class='title'>รอการอนุมัติ</div><p>";

    while ($i < $num) {
?>
        <script language="javascript">
            $(function() {
                $("#bt<?php echo $i; ?>").change(function() {
                    $(this).hide();
                });
            });

            $(function() {
                $("#bt<?php echo $i; ?>").change(function() {
                    var bt_ = $("#bt<?php echo $i; ?>").attr("value");
                    var id_ = $("#id<?php echo $i; ?>").attr("value");
                    $.post("check_inbox_super.php", {
                        bt: bt_,
                        id: id_
                    }, function(data) {
                        $("#msg<?php echo $i; ?>").html(data);
                    });
                });
            });

            $(function() {
                $("#btb<?php echo $i; ?>").click(function() {
                    var btb = $("#id<?php echo $i; ?>").attr("value");
                    $.post("browse.php", {
                            btb: btb
                        }),
                        function(data) {
                            $("#case").html(window.open("browse.php?id=btb<?php echo $i; ?>"));
                        }
                });
            });
        </script>
        <?php
        $fetch  = mysqli_fetch_array($result);
        $id_list_temp = $fetch['id_list'];
        $date_temp = $fetch['date'];
        $time_temp = $fetch['time'];
        $t = substr($time_temp, 0, 5);
        $username_temp =  $fetch['username'];
        $id_problem_temp =  $fetch['id_problem'];
        $id_building_temp = $fetch['id_building'];
        $floor_temp = $fetch['floor'];
        $id_room_temp = $fetch['id_room'];
        $details_temp = $fetch['details'];
        $job_status_temp = $fetch['job_status'];

        $result_u = $mysqli->query("SELECT * FROM user WHERE username='$username_temp'");
        $fetch_u  = mysqli_fetch_array($result_u);

        $id_prename_temp =  $fetch_u['id_prename'];
        $name_temp =  $fetch_u['name'];
        $lastname_temp =  $fetch_u['lastname'];
        $id_sector_temp =  $fetch_u['id_sector'];

        $sql_prename = "SELECT * FROM prename WHERE id_prename='" . $id_prename_temp . "'";
        $result_pre = $mysqli->query($sql_prename);
        $fetch_pre  = mysqli_fetch_array($result_pre);
        $prename_temp =  $fetch_pre['prename'];

        $result_s = $mysqli->query("SELECT * FROM sector WHERE id_sector='$id_sector_temp'");
        $fetch_s  = mysqli_fetch_array($result_s);
        $sector_temp =  $fetch_s['sector'];


        $type_problem = "SELECT * FROM type_problem WHERE id_problem='" . $id_problem_temp . "'";
        $result_p = $mysqli->query($type_problem);
        $fetch_p  = mysqli_fetch_array($result_p);
        $problem_temp =  $fetch_p['problem'];

        /*$result_st = $mysqli->query("SELECT * FROM status WHERE id_status='$id_status_temp'");
$fetch_st  = mysqli_fetch_array($result_st);
$status_temp =  $fetch_st['status'];*/


        print "<tr><td>";
        ConThai($date_temp);
        echo "</td><td>$t</td><td>$prename_temp$name_temp  $lastname_temp</td><td>$problem_temp</td>";
        ?><td>
            <a href="index.php?m=4.1&&id_list=<?php echo $id_list_temp; ?>" title="แสดงรายละเอียด"><img src="images/view.png" alt="แสดงรายละเอียด" width="16" height="16" border="0" /></a>
        </td>
        <td> <?php


                $i++;
            }
        }


        function selectWebhook($mysqli)
        {
            $result = $mysqli->query("SELECT * FROM webhooks ORDER BY id DESC");
            $num = mysqli_num_rows($result);
            if ($num != 0) {
            } else {
            }
            $i = 0;
            echo "<div class='title'>PagerDuty</div><p>";

            while ($i < $num) {
                ?>
            <script language="javascript">
                $(function() {
                    $("#bt<?php echo $i; ?>").change(function() {
                        $(this).hide();
                    });
                });

                $(function() {
                    $("#bt<?php echo $i; ?>").change(function() {
                        var bt_ = $("#bt<?php echo $i; ?>").attr("value");
                        var id_ = $("#id<?php echo $i; ?>").attr("value");
                        $.post("check_inbox_super.php", {
                            bt: bt_,
                            id: id_
                        }, function(data) {
                            $("#msg<?php echo $i; ?>").html(data);
                        });
                    });
                });

                $(function() {
                    $("#btb<?php echo $i; ?>").click(function() {
                        var btb = $("#id<?php echo $i; ?>").attr("value");
                        $.post("browse.php", {
                                btb: btb
                            }),
                            function(data) {
                                $("#case").html(window.open("browse.php?id=btb<?php echo $i; ?>"));
                            }
                    });
                });
            </script>
            <?php
                $oVal = (object)[];

                $fetch = mysqli_fetch_array($result);
                // $event_tmp = $fetch['messages'][0]["event"];
                $event_tmp = "incident.trigger";



                $messages = $fetch["list"][$i]["messages"];

                var_dump($messages);

                if ($event_tmp == "incident.trigger") {
                } else {


                    $date_temp = $fetch['date'];
                    $time_temp = $fetch['time'];
                    $t = substr($time_temp, 0, 5);
                    $username_temp =  $fetch['username'];
                    $id_problem_temp =  $fetch['id_problem'];
                    $id_building_temp = $fetch['id_building'];
                    $floor_temp = $fetch['floor'];
                    $id_room_temp = $fetch['id_room'];
                    $details_temp = $fetch['details'];
                    $job_status_temp = $fetch['job_status'];

                    $result_u = $mysqli->query("SELECT * FROM user WHERE username='$username_temp'");
                    $fetch_u  = mysqli_fetch_array($result_u);

                    $id_prename_temp =  $fetch_u['id_prename'];
                    $name_temp =  $fetch_u['name'];
                    $lastname_temp =  $fetch_u['lastname'];
                    $id_sector_temp =  $fetch_u['id_sector'];

                    $sql_prename = "SELECT * FROM prename WHERE id_prename='" . $id_prename_temp . "'";
                    $result_pre = $mysqli->query($sql_prename);
                    $fetch_pre  = mysqli_fetch_array($result_pre);
                    $prename_temp =  $fetch_pre['prename'];

                    $result_s = $mysqli->query("SELECT * FROM sector WHERE id_sector='$id_sector_temp'");
                    $fetch_s  = mysqli_fetch_array($result_s);
                    $sector_temp =  $fetch_s['sector'];


                    $type_problem = "SELECT * FROM type_problem WHERE id_problem='" . $id_problem_temp . "'";
                    $result_p = $mysqli->query($type_problem);
                    $fetch_p  = mysqli_fetch_array($result_p);
                    $problem_temp =  $fetch_p['problem'];

                    print "<tr><td>";
                    ConThai($date_temp);
                    echo "</td><td>$t</td><td>$prename_temp$name_temp  $lastname_temp</td><td>$problem_temp</td>";
            ?>
        <td>
            <a href="index.php?m=4.1&&id_list=<?php $id_tmp = 0;
                                                echo $id_tmp; ?>" title="แสดงรายละเอียด"><img src="images/view.png" alt="แสดงรายละเอียด" width="16" height="16" border="0" /></a>
        </td>
        <td>
<?php


                    $i++;
                }
            }
        }

?>

<center>
    <form id="ff" method="post" action="browse.php">
        <table align="center" class="css">
            <tr>
                <th scope="col">วันที่แจ้ง</th>
                <th scope="col">เวลาที่แจ้ง</th>
                <th scope="col">ผู้แจ้ง</th>
                <th scope="col">ประเภทที่แจ้ง</th>
                <th scope="col">รายละเอียด</th>
            </tr>
            <tr>
                <?php //Select($mysqli, "รอการอนุมัติ"); ?>
            </tr>
            <tr>
                <?php selectWebhook($mysqli); ?>
            </tr>
        </table>
    </form>
</center>
<strong></strong>