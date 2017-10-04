<?php include("includes/header.php"); ?>
<!--if no session redirect to login.php-->
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {

    redirect("photos.php");

} else {
    
    $photo= Photo::find_by_id($_GET['id']);
    

 if(isset($_POST['update'])) {
     
 if($photo) {
    
    $photo->title           = $_POST['title'];
    $photo->caption         = $_POST['caption'];
    $photo->alternate_text  = $_POST['alternate_text'];
    $photo->description     = $_POST['description'];
     
     //db_object method
     $session->message("The photo has been updated");
     $photo->save();
     redirect("../admin/photos.php");
    
     
 }
     
 }
     
if(isset($_POST['delete'])) {

if($photo) {
    
    $session->message("The photo {$photo->filename} has been deleted");
     $photo->delete_photo();
     redirect("../admin/photos.php");
}
}
     


}

?>
       
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            
            <?php include("includes/top_nav.php"); ?>
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include("includes/side_nav.php"); ?>
            
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                            <small>Subheading</small>
                        </h1>
                        <form action="" method="post"> <!--action left blank to preserve GETID-->
                        <div class="col-md-8">
                            
                            <div class="form-group">
                                <label for="caption">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                            
                            </div> 
                             
                             <div class="form-group">
                            
                           <a class="thumbnail" href="#"><img src="<?php echo $photo->picture_path(); ?>" alt=""></a>
                               
                           </div>
                              
                            <div class="form-group">
                                <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
                            
                            </div> 
                               
                            <div class="form-group">
                                <label for="caption">Alternate Text</label>
                            <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
                            
                            </div> 
                               
                            <div class="form-group">
                                <label for="caption">Description</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="10" value="<?php echo $photo->description; ?>"></textarea>
                            </div>
                            </div> <!-- End of col-md-8 -->   
                             
                            <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->type; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                   <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-lg delete_link">
                                    <!--<a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>-->   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                    </div>  <!-- End of col-md-4 -->     
                </form>        
                            
                            
                            
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>

           
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>