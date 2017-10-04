<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>
<!--if no session redirect to login.php-->
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {

    redirect("users.php");
} else {
    
    $user= User::find_by_id($_GET['id']);

  
 if(isset($_POST['update'])) {
     
 if($user) {
    
    $user->username     = $_POST['username'];
    $user->first_name   = $_POST['firstname'];
    $user->last_name    = $_POST['lastname'];
    $user->password     = $_POST['password'];
    
    
    $user->set_file($_FILES['user_image']);
     
    $user->upload_photo();
     
    $user->save();
     
    redirect("users.php");
    $session->message("The user has been updated");
     
 }
     

}

if(isset($_POST['delete'])) {

if($photo) {
    
    $session->message("The user {$user->username} has been deleted");
     $user->delete();
     redirect("../admin/users.php");
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
        <div id="wrapper-overide">
        <div id="page-wrapper">
            
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            users
                            <small>Subheading</small>
                        </h1>
                        <div class="col-md-6 user_image_box">
                            
                            <a href="" data-toggle="modal" data-target="#photo-library"><img class="admin-photo-thumbnail image_responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>   
                            
                            
                        </div>
                        
                        
                        
                        <form action="" method="post" enctype="multipart/form-data"> <!--action left blank to preserve GETID-->
                        <div class="col-md-6">
                           
                           <div class="form-group">
                                <label for="caption">Upload Profile Pic</label>
                            <input type="file" name="user_image" >
                            
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $user->first_name; ?>" >
                            
                            </div> 
                             
                            <div class="form-group">
                                <label for="caption">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $user->last_name; ?>">                         
                            </div> 
                               
                            <div class="form-group">
                                <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div> 
                             <div class="form-group">
                                <label for="caption">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>
                            
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                       <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-md delete_link ">
                                       
                                    <!--dummy data a-tag below used to auto-select profile picture-->   
                                    <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class=""></a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-md ">
                                </div>   
                              </div>  
                            
                                                                             
                            <!--<input type="submit" name="delete" value="Delete" class="btn btn-danger btn-lg ">
                                                                          
                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">-->
                            </div> <!-- End of col-md-8 -->   
                        </form>        
                             
                              
                             
                                  
                            
                            
                            
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>

           
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        </div> <!--wrapper-overide-->
  <?php include("includes/footer.php"); ?>