<?php include("includes/header.php"); ?>


<?php


$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 12;

$photos = Photo::find_all();

$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);

?>


    <div class="row">

        <!-- Thumbnail Photos -->
        <div class="col-md-12">
           <div class="thumbnails row">

    <?php foreach($photos as $photo): ?>
           
               
               <div class="col-xs-6 col-md-3">
                   
                <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                 
                <img class="home_page_photo img-responsive" src="<?php echo $photo->view_photo_comments_dir.DS.$photo->picture_path(); ?>" alt="">
                <!--<img class="home_page_photo img-responsive " src="admin/<?php// echo $photo->picture_path(); ?>" alt="">-->
                 
                </a>    
                   
               </div>
               
                         
    <?php endforeach; ?>     

           </div>
           
    <div class="row text-center">


        <ul class="pagination">

            <?php 


            if($paginate->page_total() > 1) {

                if($paginate->has_next()) {

echo "<li class='next'><a aria-label='next' href='index.php?page={$paginate->next_page()}'><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";


                } else {
                    
echo "<li class='next page-item disabled' disabled='true'><a href=''><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";
                }




                for ($i=1; $i <= $paginate->page_total(); $i++) { 


                    if($i == $paginate->current_page) {


echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";



                    } else {

echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";


                    }
                  
                }



                if($paginate->has_previous()) {

echo "<li class='previous'><a href='index.php?page={$paginate->previous_page()}'><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";


                } else {
                      
echo "<li class='previous page-item disabled'><a href=''><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
                      
                }

            }


             ?>


        </ul>
         
    </div>
           
           
        </div><!--End col-md-12-->




            <!-- Blog Sidebar Widgets Column -->
            <!--<div class="col-md-4">-->

            
                 <?php //include("includes/sidebar.php"); ?>

    </div><!--End div class row-->


        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
