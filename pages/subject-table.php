<?php
    include("../templates/header.php");
    include("../includes/connection.inc.php");
    
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Subjects</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Add</a>
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
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Desc</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                        //include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try{    
                            $sql = 'SELECT * FROM tbl_course';
                            foreach ($db->query($sql) as $row) {                              
                            ?>
                                <tr>
                                    <td><?php echo $row["crs_id"]?></td>
                                    <td><?php echo $row["crs_code"]?></td>
                                    <td><?php echo $row["crs_desc"]?></td>
                                    <td>
                                        <a href="#edit_<?php echo $row['crs_id'];?>" class="btn btn-success btn-xs" data-toggle="modal">Edit</a>
                                        <a href="#delete_<?php echo $row['crs_id'];?>" class="btn btn-danger btn-xs" data-toggle="modal">Remove</a>
                                    </td>
                                    <?php include('../modals/subject-details.modal.php'); ?>
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
                <form action="../actions/add-subject.php" method="post">
                    
                   
                    <div class="form-group">
                        <label>Course Code</label>
                        <input class="form-control" name="ccode" placeholder="Course Code" required>
                    </div>
                    <div class="form-group">
                        <label>Course Description</label>
                        <input class="form-control" name="cdesc" placeholder="Course Description" required>
                    </div>

                    
                
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




<?php
    include("../templates/footer.php");
?>