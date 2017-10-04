<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php


if(empty($_GET['id'])) {
    
    $session->message("The user deleted but no id");
    redirect("../users.php");
    


} else {
    
    
    
}

$user = User::find_by_id($_GET['id']);

if($user) {
    
$session->message("The user {$user->username} has been deleted");
 


$user->delete();
redirect("../users.php");

    
    
} else {
    
$session->message("The user could not be deleted");    
redirect("../users.php");
    
}
    
    
?>