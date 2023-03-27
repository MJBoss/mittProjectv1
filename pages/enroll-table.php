<?php
    include("../templates/header.php");
    include("../includes/connection.inc.php");
    
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Enroll</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Enroll</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Button trigger modal -->
                <?php
                    if(empty($_GET)){
                ?>
                    
                <?php
                    }else{
                        if($_GET["error"] == "success"){
                ?>

                    <div class="alert alert-success">
                        SUCCESSFULLY ADDED
                    </div>
                <?php
                        }else{

                            ?>
                    <div class="alert alert-danger">
                        SUCCESSFULLY FAILED
                    </div>

                            <?php
                        }
                    }
                    
                ?>
                
                
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Semester</th>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                        //include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try{    
                            $sql = 'SELECT * FROM tbl_enroll 
                            INNER JOIN tbl_sy 
                            ON tbl_enroll.sy_id = tbl_sy.sy_id 
                            INNER JOIN tbl_sem 
                            ON tbl_enroll.sem_id = tbl_sem.sem_id 
                            INNER JOIN tbl_students
                            ON tbl_enroll.s_id = tbl_students.s_id
                            INNER JOIN tbl_department 
                            ON tbl_students.dept_id = tbl_department.dept_id
                            INNER JOIN tbl_year
                            ON tbl_year.yr_id = tbl_enroll.yr_id';
                            foreach ($db->query($sql) as $row) {                              
                            ?>
                                <tr>
                                    <td><?php echo $row["sy_desc"]?></td>
                                    <td><?php echo $row["sem_desc"]?></td>
                                    <td><?php echo $row["s_name"]?></td>
                                    <td><?php echo $row["dept_code"]?></td>
                                    <td><?php echo $row["yr_desc"]?></td>
                                    <td>
                                        <form action="blank.php" method="post">
                                            <button type="submit" name ="submit" value="<?php echo $row['en_id'];?>" class="btn btn-primary btn-xs" data-toggle="modal">Add Subjects</a>
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
                        $database->close();

                        ?>



                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- Add Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form action="../actions/enroll-student.php" method="post">
                    
                
                    <?php
                    include "../includes/connect.inc.php"; 
                    
                    $sql="SELECT * FROM tbl_sy"; 

                    echo "<div class='form-group'>";
                    echo "<label>School Year</label>";
                    echo "<select name='sy' value='' class='form-control'>School Year</option>"; 
                    
                    foreach ($conn->query($sql) as $row){//Array or records stored in $row
                    echo "<option value=$row[sy_id]>$row[sy_desc]</option>"; 
                    }
                    echo "</select>";
                    echo"</div>";

                    ?>

                    <?php
                    include "../includes/connect.inc.php"; 
                    
                    $sql="SELECT * FROM tbl_sem"; 

                    echo "<div class='form-group'>";
                    echo "<label>Semester</label>";
                    echo "<select name='sem' value='' class='form-control'>Department</option>"; 
                    
                    foreach ($conn->query($sql) as $row){//Array or records stored in $row
                    echo "<option value=$row[sem_id]>$row[sem_desc]</option>"; 
                    }
                    echo "</select>";
                    echo"</div>";

                    ?>


                    <?php
                    include "../includes/connect.inc.php"; 
                    
                    $sql="SELECT * FROM tbl_students"; 

                    echo "<div class='form-group'>";
                    echo "<label>School Year</label>";
                    echo "<select name='student' value='' class='form-control'>School Year</option>"; 
                    
                    foreach ($conn->query($sql) as $row){//Array or records stored in $row
                    echo "<option value=$row[s_id]>$row[s_name]</option>"; 
                    }
                    echo "</select>";
                    echo"</div>";

                    ?>


                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Modal -->
<div class="modal fade" id="edit_<?php echo $row['s_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label class="control-label" style="position:relative; top:7px;">Student ID:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['s_id']; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label class="control-label" style="position:relative; top:7px;">Name:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['s_name']; ?>">
                        </div>
                    </div>
                </div>
                <!-- End of Modal Body -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
</div>
<!-- /.modal -->


<?php
    include("../templates/footer.php");
?>