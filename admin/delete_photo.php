<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php


if(empty($_GET['id'])) {
    
    redirect("../admin/photos.php");

} else {
    
    
    
}

$photo = Photo::find_by_id($_GET['id']);

if($photo) {
    
$session->message("The photo {$photo->filename} has been deleted");
$photo->delete_photo();
redirect("../photos.php");
    
    
} else {
    
$session->message("The photo was not deleted");    
redirect("../admin/photos.php");
    
}
    
    
?>