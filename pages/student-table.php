<?php
    include("../templates/header.php");
    include("../includes/connection.inc.php");
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blank</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Add</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Button trigger modal -->

                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Gender(s)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                        //include our connection
                    
                        $database = new Connection();
                        $db = $database->open();
                        try{    
                            $sql = 'SELECT * FROM tbl_students';
                            foreach ($db->query($sql) as $row) {                              
                            ?>
                                <tr>
                                    <td><?php echo $row["s_id"]?></td>
                                    <td><?php echo $row["s_name"]?></td>
                                    <td><?php echo $row["s_gender"]?></td>
                                    <td>
                                        <a href="#edit_<?php echo $row['s_id'];?>" class="btn btn-success btn-xs" data-toggle="modal">Edit</a>
                                        <a href="#delete_<?php echo $row['s_id'];?>" class="btn btn-danger btn-xs" data-toggle="modal">Remove</a>
                                    </td>
                                    <?php include('../modals/student-details.modal.php'); ?>
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
                <form role="form">
                    <div class="form-group">
                        <label>School ID</label>
                        <input class="form-control" placeholder="School ID">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="Student Name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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