<?php
    include 'reporterheader.php';
    
?>

<div class="container-fluid">    
        <div id="loginbox"  class="mainbox  col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                
            <div class="panel panel-warning col-sm-12" >
                <div class="form-header bg-dark">
                    <h1 class="col-sm-12 col-sm-offset-3">Add News</h1> 
                    
                </div>
                <div style="padding-top:30px" clss="panel-body" >
                    <div class="col-sm-12">
                    <form action="config.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                        <div class="form-group">
                            <label>Heading:</label>
                            <input type="text" class="form-control" name="heading" required="required">
                        </div>
                        <div class="form-group">
                            <label>image:</label>
                            <input type="file" class="form-control" name="img" required="required">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <Textarea type="text" class="form-control" name="description"  rows="5" required="required"> </textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="bnews" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Breaking News
                            </label>
                        </div>
                                                
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block btn-lg" name="news">Upload</button>
                        </div>
                    </form>     
                    </div>              
                </div> 
            </div> 
        </div>
        
    </div>