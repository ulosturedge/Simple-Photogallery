<?php include("includes/header.php"); ?>
<!--if no session redirect to login.php-->
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

       
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

$photos = Photo::find_all();

$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);

?>

        <div id="page-wrapper">
            
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                        </h1>
                        <p class="bg-success"><?php echo $message; ?></p>
                         <div class="row">
        <div class="col-lg-1">
                          <a href="upload.php" class="btn btn-primary">Add Photo</a>  
                        </div>
        <div class="col-lg-11 text-right">
        <ul class="pagination">

            <?php 

            if($paginate->page_total() > 1) {

                if($paginate->has_next()) {

echo "<li class='next'><a aria-label='next' href='photos.php?page={$paginate->next_page()}'><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";


                } else {
                    
echo "<li class='next page-item disabled' disabled='true'><a href=''><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";
                }




                for ($i=1; $i <= $paginate->page_total(); $i++) { 


                    if($i == $paginate->current_page) {


echo "<li class='active'><a href='photos.php?page={$i}'>{$i}</a></li>";



                    } else {

echo "<li><a href='photos.php?page={$i}'>{$i}</a></li>";


                    }
                  
                }



                if($paginate->has_previous()) {

echo "<li class='previous'><a href='photos.php?page={$paginate->previous_page()}'><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";


                } else {
                      
echo "<li class='previous page-item disabled'><a href=''><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
                      
                }

            }

            ?>


        </ul>
         




</div>

     </div>   
                        
                        
                        
                        <div class="col-md-12">
                            
                            <table class="table">
                               <thead>
                                  <tr>
                                   <th>Photo</th>
                                   <th>ID</th>
                                   <th>Filename</th>
                                   <th>Title</th>
                                   <th>Size</th>
                                   <th>Comments</th>   
                                  </tr> 
                               </thead> 
                           
                            <tbody>
                            
                         <!--?php   $photos = Photo::find_all();
                        
                        foreach($photos as $photo) {
                            echo "<tr>";
                            echo '<td><img src=".$photo->picture_path()." alt=""></td>';
                            echo "<td>".$photo->photo_id."</td>";
                                echo "<td>".$photo->filename."</td>";
                                echo "<td>".$photo->title."</td>";
                            echo "<td>".$photo->size."</td>";
                            echo "<tr>";
                        }
                            ?-->
                   <?php //$photos = Photo::find_all();?>    
                        
                     <?php foreach($photos as $photo) : ?>
                            
                            <tr>
                                <td><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">
                                
                                <div class="picture_link">
                                    <a class="delete_link" href="delete_photo.php/?id=<?php echo $photo->id; ?>">Delete</a>
                                    <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                    <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                    
                                </div>
                                 </td>   
                                    
                                <td><?php echo $photo->id; ?></td>
                                <td><?php echo $photo->filename; ?></td>
                                <td><?php echo $photo->title; ?></td>
                                <td><?php echo $photo->size; ?></td>
                                <td><a href="comment_photo.php?id=<?php echo $photo->id; ?>"><?php echo count(Comment::find_the_comments($photo->id)); ?></a></td>
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