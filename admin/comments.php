<?php include("includes/header.php"); ?>
<!--if no session redirect to login.php-->
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php// $comments = Comment::find_all();?> 

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->


    <?php include("includes/top_nav.php"); ?>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <?php include("includes/side_nav.php"); ?>

    <!-- /.navbar-collapse -->
</nav>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$comments = Comment::find_all();

$items_total_count = Comment::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM comments ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$comments = Comment::find_by_query($sql);

?>        

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    All Comments

                </h1>
                <p class="bg-success"><?php echo $message; ?></p>
                <div class="col-lg-11 text-right">
                    <ul class="pagination">



                        <?php 

                        if($paginate->page_total() > 1) {

                            if($paginate->has_next()) {

                                echo "<li class='next'><a aria-label='next' href='comments.php?page={$paginate->next_page()}'><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";


                            } else {

                                echo "<li class='next page-item disabled' disabled='true'><a href=''><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";
                            }




                            for ($i=1; $i <= $paginate->page_total(); $i++) { 


                                if($i == $paginate->current_page) {


                                    echo "<li class='active'><a href='comments.php?page={$i}'>{$i}</a></li>";



                                } else {

                                    echo "<li><a href='comments.php?page={$i}'>{$i}</a></li>";


                                }

                            }



                            if($paginate->has_previous()) {

                                echo "<li class='previous'><a href='comments.php?page={$paginate->previous_page()}'><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";


                            } else {

                                echo "<li class='previous page-item disabled'><a href=''><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";

                            }

                        }

                        ?>


                    </ul>





                </div>

                <div class="col-md-12">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Body</th>   
                            </tr> 
                        </thead> 

                        <tbody>


                            <?php foreach($comments as $comment) : ?>

                            <tr>
                                <td><?php echo $comment->id; ?></td>

                                <td><?php echo $comment->author; ?>
                                    <div class="action_link">
                                        <a href="delete_comment.php/?id=<?php echo $comment->id; ?>">Delete</a>


                                    </div>
                                </td>   



                                <td><?php echo $comment->body; ?></td>

                            </tr>

                            <?php endforeach; ?>





                        </tbody>
                    </table>   






                </div>





            </div>
        </div>
        <!-- /.row -->

    </div>


    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>