<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php


if(empty($_GET['id'])) {
    
    redirect("../comments.php");

} else {
    
    
    
}

$comment = Comment::find_by_id($_GET['id']);


if($comment) {
    
$session->message("The comment has been deleted");
$comment->delete();
redirect("../comments.php");

    
    
} else {
    
$session->message("The comment was not deleted");    
redirect("../comments.php");
 
}
    
    
?>