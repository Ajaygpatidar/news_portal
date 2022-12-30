<?php
     include 'adminheader.php';
    $sql="SELECT * FROM location";
    $res=mysqli_query($con,$sql);
   
?>
<div class="container">
	<div class="row">
        <form action="config.php" method="post">
            <div class="col-sm-2">
                <button type="submit"  class="btn btn-success"  data-toggle="modal" data-target="#myModal">Add New location</button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title text-warning" id="myModalLabel">Location</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label>Add New Location:</label>
                            <input type="text" class="form-control" name="location" required="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addlocation">submit</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>               
        </form>
        <div class="col-md-12 well" style="margin-top:20px">
          
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">  
                    <thead>
                        <th>S.no</th>
                       
                        <th>Location</th>
                        
                        <th>Edit</th>
                       
                    </thead>
                    <tbody>
                        
                        
                            <?php                  
                            foreach($res as $row)
                            {  
                                $lid=$row['lid'];
                                $lname=$row['Location_name'];
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                   
                                    <td><?php echo $lname ?></td>
                                    <td><a href="config.php?ldelete=<?php echo $lid;?>" class="btn btn-danger btn-xs" >Delete</a>
                                        <a href="#<?php echo $lid;?>" type="submit"  class="btn btn-success  btn-xs"  data-toggle="modal">Edit</a>
                                        <div class="modal fade" id="<?php echo $lid;?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title text-warning" id="myModalLabel">Edit location</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="config.php?editlocation=<?php echo $lid;?>" method="post">
                                                        
                                                            <div class="form-group">
                                                                <label>Change location:</label>
                                                                <input type="text" class="form-control" name="location" value="<?php echo $lname; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary" name="editlocation">submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                        <?php
                        }?>
                  
                    </tbody>
                        
                </table>
            </div>
        </div>
      <!-- /.modal-dialog --> 
    </div>
</div>