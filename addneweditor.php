<?php
    include 'db_cannect.php';
     include 'adminheader.php';
    $sql="SELECT * FROM category";
    $res=mysqli_query($con,$sql);
?>
  <div class="container-fluid">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox  col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                
            <div class="panel panel-warning col-sm-12" >
                <div class="form-header">
                    <h1 class="col-sm-12 col-sm-offset-3">Add Editor</h1> 
                    <hr >
                </div>
                <div style="padding-top:30px" clss="panel-body" >
                    <div class="col-sm-12">
                    <form action="config.php" method="post" class="form-horizontal">
                                
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" required="required">
                        </div>
                        <div class="form-group">
                            <label>Mobile:</label>
                            <input type="text" class="form-control" name="mobile" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" required="required">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" required="required">
                        </div>
                        <div class="form-group">
                            <label for="class">Category:</label>
                                <select name="category"class="form-control" >
                                    
                                <?php
                                foreach($res as $row)
                                {
                                    $cid=$row['cid'];
                                    $cn=$row['category_name'];
                                    
                                    echo ' <option value='.$cid.'>'.$cn.'</option>';
                                } ?>
                                
                                </select>
                        </div> 
                        <div class="form-group">
                            <label for="class">Location:</label>
                                <select name="location" class="form-control" >
                                    
                                <?php
                                 $sql="SELECT * FROM location";
                                 $res=mysqli_query($con,$sql);
                                foreach($res as $row)
                                {
                                    $lid=$row['lid'];
                                    $ln=$row['Location_name'];
                                    
                                    echo ' <option value='.$lid.'>'.$ln.'</option>';
                                } ?>
                                
                                </select>
                        </div>  
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block btn-lg" name="addneweditor">Add</button>
                        </div>
                    </form>     
                    </div>              
                </div> 
            </div> 
        </div>
        
    </div>
    