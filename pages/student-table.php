<?php
    include("../templates/header.php");
    include("../includes/connection.inc.php");
?>

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Blank</h1>


                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Gender(s)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            <?php
                                        //include our connection
                                   
                                        $database = new Connection();
                                        $db = $database->open();
                                        try{    
                                            $sql = 'SELECT * FROM tbl_student';
                                            foreach ($db->query($sql) as $row) {                              
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["s_id"]?></td>
                                                    <td><?php echo $row["s_name"]?></td>
                                                    <td><?php echo $row["s_gender"]?></td>
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
                                    <div class="well">
                                        <h4>DataTables Usage Information</h4>
                                        <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                        <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

<?php
    include("../templates/footer.php");
?>