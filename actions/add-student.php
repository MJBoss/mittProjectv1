<?php
include("../../includes/connection.inc.php");

    if(isset($_POST["submit"])){
        $code = $_POST["code"];
        $desc = $_POST["desc"];
        $lab = $_POST["lab"];
        $lec = $_POST["lec"];

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
            $sql = "INSERT INTO `tbl_subject`(`sbj_code`, `sbj_desc`, `lab_units`, `lec_units`) VALUES ('$code','$desc','$lab','$lec')";
            $conn->exec($sql);
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
        header("location: ../subject-table.php?error=success");
    }else{
        header("location: ../subject-table.php?error=error");
    }
?>