<?php

    if(!isset($_POST["submit"])){
        header("location: ../pages/enroll-table.php?error=failed");
    }

    $enid = $_POST["submit"];


    include("../templates/header.php");
    include("../includes/connect.inc.php");
    

    $statement=$conn->prepare("SELECT * FROM tbl_enroll 
    INNER JOIN tbl_sy 
    ON tbl_enroll.sy_id = tbl_sy.sy_id 
    INNER JOIN tbl_sem 
    ON tbl_enroll.sem_id = tbl_sem.sem_id 
    INNER JOIN tbl_students
    ON tbl_enroll.s_id = tbl_students.s_id
    INNER JOIN tbl_department 
    ON tbl_students.dept_id = tbl_department.dept_id
    INNER JOIN tbl_year
    ON tbl_year.yr_id = tbl_enroll.yr_id
    WHERE tbl_enroll.en_id = :enids");
    $statement->bindParam(':enids', $enid);
    $statement->execute();
    $student = $statement->fetch(PDO::FETCH_ASSOC);
    
   
?>

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Blank</h1>
                                <div>
                                    <p class="mb-0">Student ID: <?php echo $student["s_id"] ?></p>
                                    <p class="mb-0">Student Name: <?php echo $student["s_name"] ?></p>
                                    <p class="mb-0">Course: <?php echo $student["dept_desc"] ?></p>
                                    <p class="mb-0">Year Level: <?php echo $student["yr_desc"] ?></p>
                                    <p class="mb-0">School Year: <?php echo $student["sy_desc"] ?></p>
                                    <p class="mb-0">Semester: <?php echo $student["sem_desc"] ?></p>
                                    <br>
                                    <hr>
                                </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Description</th>
                                    <th>Units</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                        //include our connection
                        // $database = new Connection();
                        // $db = $conn->open();
                        try{    
                            $sql = "SELECT * FROM tbl_subjects
                            INNER JOIN tbl_enroll
                            ON tbl_subjects.en_id = tbl_enroll.en_id
                            INNER JOIN tbl_course
                            ON tbl_subjects.crs_id = tbl_course.crs_id";
                            foreach ($conn->query($sql) as $row) {                              
                            ?>
                                <tr>
                                    <td><?php echo $row["crs_code"]?></td>
                                    <td><?php echo $row["crs_desc"]?></td>
                                    <td><?php echo $row["crs_unit"]?></td>
                                    
                                    <td>
                                        <form action="blank.php" method="post">
                                            <button type="submit" name ="submit" value="<?php echo $row['s_id'];?>" class="btn btn-danger btn-xs" data-toggle="modal">Remove</a>
                                        </form>
                                        
                                    </td>
                                   
                                </tr>
                                <?php
                            }
                        }
                        catch(PDOException $e){
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        //close connection
                        // $database->close();

                        ?>



                            </tbody>
                        </table>
                    </div>

<?php
    include("../templates/footer.php");
?>