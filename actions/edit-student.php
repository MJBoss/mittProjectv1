<?php



include("../includes/connection.inc.php");
include("../includes/connect.inc.php");

if(isset($_POST["submit"])){
    $id = $_POST["sid"];
    $name = $_POST["sname"];
    $gender = $_POST["sgender"];
    $status = $_POST["sstatus"];

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
        $sql = "UPDATE tbl_students SET s_name='$name', s_gender='$gender', s_status='$status' WHERE s_id='$id'";

        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
    header("location: ../pages/student-table.php?error=success");
}else{
    header("location: ../pages/student-table.php?error=success");
}
?>