<?php require_once("includes/header.php"); ?>


<?php


if(isset($_POST['submit'])) {
    
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);    
$username = trim($_POST['username']);
$password = trim($_POST['password']);


 if(!empty($firstname and $lastname and $username and $password)) {


$user = new User;
                        
$user->first_name = $firstname;
$user->last_name = $password;
$user->username = $username;
$user->password = $password;
    
$user->create();
    
$the_message = "You have successfully signed up.";

    
} else {

$the_message = "Something went wrong. Try again!";
    
 
}
} else {
    
$firstname = "";
$lastname = "";    
$username = "";
$password = "";
$the_message ="";
    
}



    
?>

<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $the_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">First Name</label>
	<input type="text" class="form-control" name="firstname" value="<?php echo htmlentities($firstname); ?>" >

</div>

<div class="form-group">
	<label for="password">Last Name</label>
	<input type="text" class="form-control" name="lastname" value="<?php echo htmlentities($lastname); ?>">
	
</div>

<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>
<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>
    
    
    
    
    
}