<?php
    include 'adminheader.php';
  
   include 'db_cannect.php';
?>
<div class="container">
	<div class="row">
        <form action="config.php" method="post">
            <div class="col-sm-2">
                <button type="submit"  class="btn btn-success"  data-toggle="modal" data-target="#myModal">Add New Category</button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title text-warning" id="myModalLabel">Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label>Add New Category:</label>
                            <input type="text" class="form-control" name="category" required="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addcategory">submit</button>
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
                            <th>category</th>
                            
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php                 
                             $sql="SELECT * FROM category";
                             $res=mysqli_query($con,$sql); 
                                foreach($res as $row)
                                {   
                                    $cid=$row['cid'];
                                    $cname=$row['category_name'];
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkthis" /></td>
                                       
                                        <td><?php echo $cname ?></td>
                                        <td><a href="config.php?cdelete=<?php echo $cid;?>" class="btn btn-danger btn-xs" >Delete</a>
                                        <a href="#<?php echo $cid;?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                                            <div class="modal fade" id="<?php echo $cid;?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title text-warning" id="myModalLabel">Edit</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="config.php?editcategory=<?php echo $cid;?>" method="post">

                                                                <div class="form-group">
                                                                    <label>Change Category:</label>
                                                                    <input type="text" class="form-control" name="category" value="<?php echo $cname; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" name="editcategory">submit</button>
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