<?php
   
    $role=$_SESSION['role'];
    $nid=$_GET['Nedit'];
    $sql="SELECT * FROM news_detail WHERE nid='$nid' ";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $head=$row['nheading'];
    $img=$row['nimg'];
    $des=$row['ndescription'];
    if($role=='admin')
    {
        
        include 'adminheader.php';
    }
    elseif($role=='reporter')
    {
      
        include 'reporterheader.php';
    }
    elseif($role=='editor')
    {
        include 'editorheader.php';
    }
    
  ;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 well">
            <div class="row">
                <div class="col-sm-10">
                    
                <form action="config.php?newsupdate=<?php echo $nid ?>" method="post" enctype='multipart/form-data' class="form-horizontal">
                                
                    <div class="form-group">
                        <label>Heading:</label>
                        <input type="text" class="form-control" name="heading" value="<?php echo $head ?>" required="required">
                    </div>
                    <div class="form-group">
                      
                            <img src="<?php echo $img;?>" alt=""class="img-rounded"  height="100px" width="100px">
                            <input type="file" class="form-control" value="<?php echo $img ?>" style="margin-top:15px" name="img">
                           
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control"  value="<?php echo $des ?>" name="description" required="required">
                    </div>
                    <button type="submit" class="btn btn-primary" name="newsupdate">Update</button>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>