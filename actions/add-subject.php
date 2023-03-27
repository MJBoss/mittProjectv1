<?php



include("../includes/connection.inc.php");
include("../includes/connect.inc.php");

if(isset($_POST["submit"])){
    $code = $_POST["ccode"];
    $desc = $_POST["cdesc"];
    

    // $sql = "SELECT * FROM tbl_sched WHERE room_id = '$room' AND day_id = '$day' AND  ('$st' BETWEEN start_time AND end_time
    //         OR '$en' BETWEEN start_time AND end_time OR '$st' >= end_time AND '$en' <= end_time)";
    // $stmt = $dbs->query($sql);
    // $result = $stmt->fetchAll();
    // if(empty($result)){
    // }else{
    // }

    try {
        $database = new Connection();
        $dbs = $database->open();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `tbl_course`(`crs_code`, `crs_desc`) VALUES ('$code', '$desc')";
        $conn->exec($sql);
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
    header("location: ../pages/subject-table.php?error=success");
}else{
    header("location: ../pages/subject-table.php?error=failed");
}
?>