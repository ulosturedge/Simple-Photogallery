<?php require_once('init.php'); ?>

<?php

$photos = Photo::find_all();


?>


<div class="modal fade" id="photo-library">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gallery System Library</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-9">
                    <div class="thumbnails row">

                        <!-- PHP LOOP HERE CODE HERE-->
                        <?php foreach($photos as $photo): ?>

                        <div class="col-xs-2">
                            <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                                <img class="modal_thumbnails img-responsive" src="<?php echo $photo->picture_path(); ?>" data-id="<?php echo $photo->id; ?>"  data-filename="<?php echo $photo->filename; ?>"  data-type="<?php echo $photo->type; ?>"  data-size="<?php echo $photo->size; ?>">
                            </a>
                            <div class="photo-id hidden"></div>
                        </div>

                        <?php endforeach; ?>    

                        <!-- PHP END LOOP CODE HERE-->

                    </div>
                </div><!--col-md-9 -->

                <div class="col-md-3">



                    <div  class="photo-info-box hidden">
                        <div class="info-box-header">
                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                        </div>
                        <div class="inside">
                            <div class="box-inner">
                                <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                </p>
                                <p class="text ">
                                    Photo Id: <span class="data-photo_id"><?php echo $photo->id; ?></span>
                                </p>
                                <p class="text">
                                    Filename: <span class="data-filename"><?php echo $photo->filename; ?></span>
                                </p>
                                <p class="text">
                                    File Type: <span class="data-type"><?php echo $photo->type; ?></span>
                                </p>
                                <p class="text">
                                    File Size: <span class="data-size"><?php echo $photo->size; ?></span>
                                </p>
                            </div>
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                            </div>
                        </div>          
                    </div>





                </div>

            </div><!--Modal Body-->
            <div class="modal-footer">
                <div class="row">
                    <!--Closes Modal-->
                    <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->