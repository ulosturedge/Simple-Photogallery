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

$users = User::find_all();

$items_total_count = User::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM users ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$users = User::find_by_query($sql);

?>

        <div id="page-wrapper">
            
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                            Users
                        </h1>
                        <p class="bg-success"><?php echo $message; ?></p>
                        <div class="row">
                        <div class="col-lg-1">
                          <a href="add_user.php" class="btn btn-primary">Add User</a>  
                        </div>
                        <div class="col-lg-11 text-right">
        <ul class="pagination">

            <?php 

            if($paginate->page_total() > 1) {

                if($paginate->has_next()) {

echo "<li class='next'><a aria-label='next' href='users.php?page={$paginate->next_page()}'><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";


                } else {
                    
echo "<li class='next page-item disabled' disabled='true'><a href=''><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";
                }




                for ($i=1; $i <= $paginate->page_total(); $i++) { 


                    if($i == $paginate->current_page) {


echo "<li class='active'><a href='users.php?page={$i}'>{$i}</a></li>";



                    } else {

echo "<li><a href='users.php?page={$i}'>{$i}</a></li>";


                    }
                  
                }



                if($paginate->has_previous()) {

echo "<li class='previous'><a href='users.php?page={$paginate->previous_page()}'><span aria-hidden='true'>&raquo;</span>
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
                                   <th>ID</th>
                                   <th>Photo</th>
                                   <th>Username</th>
                                   <th>First Name</th>
                                   <th>Last Name</th>   
                                  </tr> 
                               </thead> 
                           
                            <tbody>
                            
                         <!--?php   $users = user::find_all();
                        
                        foreach($users as $user) {
                            echo "<tr>";
                            echo '<td><img src=".$user->picture_path()." alt=""></td>';
                            echo "<td>".$user->user_id."</td>";
                                echo "<td>".$user->filename."</td>";
                                echo "<td>".$user->title."</td>";
                            echo "<td>".$user->size."</td>";
                            echo "<tr>";
                        }
                            ?-->
                   <?php //$users = User::find_all(); ?>   
                    
                     <?php foreach($users as $user) : ?>
                            
                            <tr>
                               <td><?php echo $user->id; ?></td>
                               <td><img class="admin-user-thumbnail user_image" src="<?php echo $user->image_path_and_placeholder(); ?>" alt="">
                                </td> 
                                    
                                
                                <td><?php echo $user->username; ?>
                                    <div class="action_link">
                                    <a class="delete_link" href="delete_user.php/?id=<?php echo $user->id; ?>">Delete</a>
                                    <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                    
                                    </div>
                                    
                                
                                </td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo $user->last_name; ?></td>
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