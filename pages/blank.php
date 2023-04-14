<?php
    session_start();
    if(!isset($_SESSION["enid"])){
        header("location: ../pages/enroll-table.php?error=failed");
    }

    $enid = $_SESSION["enid"];


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
    $stid = $student["s_id"];
    
   
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Add Subject</a>
                    </div>
                    <div class="panel-body">
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
                                ON tbl_subjects.crs_id = tbl_course.crs_id
                                WHERE tbl_enroll.s_id = $stid";
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
                    </div>
                </div>


<!-- Add Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form action="../actions/add-enroll-sub.php" method="post">
                    
                
                    <?php
                    echo "<div class='form-group'>";
                    echo "<label>School Year</label>";
                    echo "<select name='sy' value='' class='form-control'>School Year</option>"; 
                    echo "<option value=$student[sy_id]>$student[sy_desc]</option>"; 
                    echo "</select>";
                    echo"</div>";
                    ?>

                    <?php
                    echo "<div class='form-group'>";
                    echo "<label>Semester</label>";
                    echo "<select name='sem' value='' class='form-control'>Department</option>"; 
                    echo "<option value=$student[sem_id]>$student[sem_desc]</option>"; 
                    echo "</select>";
                    echo"</div>";
                    ?>

                    <?php
                    echo "<div class='form-group'>";
                    echo "<label>Course</label>";
                    echo "<select name='course' value='' class='form-control'>School Year</option>";
                    echo "<option value=$student[dept_id]>$student[dept_desc]</option>"; 
                    echo "</select>";
                    echo"</div>";
                    ?>
                    
                    <?php
                    echo "<div class='form-group'>";
                    echo "<label>Course</label>";
                    echo "<select name='year' value='' class='form-control'>School Year</option>";
                    echo "<option value=$student[yr_id]>$student[yr_desc]</option>"; 
                    echo "</select>";
                    echo"</div>";
                    ?>


                    <?php
                    $sql="SELECT * FROM `tbl_course` WHERE NOT EXISTS
                    (SELECT * FROM tbl_subjects WHERE tbl_subjects.crs_id = tbl_course.crs_id 
                      AND tbl_subjects.en_id = $enid
                    ) AND yr_id = $student[yr_id] AND dept_id = $student[dept_id]"; 
                    echo "<div class='form-group'>";
                    echo "<label>Subjects</label>";
                    echo "<select name='subjects' value='' class='form-control'>Selec Subjects</option>"; 
                    foreach ($conn->query($sql) as $row){
                    echo "<option value=$row[crs_id]>$row[crs_code] - $row[crs_desc]</option>"; 
                    }
                    echo "</select>";
                    echo"</div>";
                    ?>

                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" value="<?php echo $enid ?>" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
    include("../templates/footer.php");
?>