<?php
    $role=$_SESSION['role'];
    include 'db_cannect.php';
    
    $sql="SELECT news_detail.nheading,news_detail.nimg,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name
    FROM news_detail
    INNER JOIN category ON news_detail.ncategory = category.cid
    INNER JOIN location ON news_detail.nlocation = location.lid WHERE nid='$nid' and is_delete='0'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $head=$row['nheading'];
    $img=$row['nimg'];
    $des=$row['ndescription'];
    $date=$row['date'];
    $l=$row['Location_name'];
    $c=$row['category_name'];
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
?>
<div class="container-fluid">
    <div class="row">
       
        <div class="col-sm-10 col-sm-offset-1 well">
        <h2 class="col-sm-offset-5">News</h2>
        
            <div class="row">
                <div class="col-sm-10  col-sm-offset-1">
                    <h1><?php echo $head; ?></h1>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-10  col-sm-offset-1">
                    <img src="<?php echo $img; ?>"class="img-responsive"  width="700px">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-10  col-sm-offset-1">
                    <p><?php echo $des; ?></p>
                
                    <span><i class="fa fa-map-marker" class="text-success" aria-hidden="true"></i> <?php echo $l; ?></span>
                    <span><i class="fa fa-cc" aria-hidden="true"></i> <?php echo $c; ?></span>
                    <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $date; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>