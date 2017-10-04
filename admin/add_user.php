<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

$user = new User;

if(isset($_POST['submit'])) {

    if($user) {

        $user->username     = $_POST['username'];
        $user->first_name   = $_POST['firstname'];
        $user->last_name    = $_POST['lastname'];
        $user->password     = $_POST['password'];





        $user->set_file($_FILES['user_image']);
        $user->upload_photo();
        $session->message("The user {$user->username} has been added");
        $user->save();
        redirect("users.php");

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
                    <form action="" method="post" enctype="multipart/form-data"> <!--action left blank to preserve GETID-->
                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="caption1">Upload Profile Pic</label>
                                <input type="file" name="user_image" >

                            </div>

                            <div class="form-group">
                                <label for="caption1">First Name</label>
                                <input type="text" name="firstname" class="form-control" >

                            </div> 

                            <div class="form-group">
                                <label for="caption1">Last Name</label>
                                <input type="text" name="lastname" class="form-control" >                         
                            </div> 

                            <div class="form-group">
                                <label for="caption1">Username</label>
                                <input type="text" name="username" class="form-control" >
                            </div> 
                            <div class="form-group">
                                <label for="caption1">Password</label>
                                <input type="password" name="password" class="form-control" >                         
                            </div>  
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg ">
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