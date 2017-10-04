$(document).ready(function(){
    
var user_href;
var user_href_splitted;
var user_id;
var image_src;
var image_src_splitted;
var image_name;
var photo_id;
var photo_filename;
var photo_type;
var photo_size;
    
$(".modal_thumbnails").click(function(){
    
$("#set_user_image").prop('disabled', false);


user_href = $("#user-id").prop('href');
user_href_splitted = user_href.split("=");    
user_id = user_href_splitted[user_href_splitted.length-1];

image_src = $(this).prop("src");
image_src_splitted = image_src.split("/");
image_name = image_src_splitted[image_src_splitted.length-1];

photo_id = $(this).attr("data-id");
photo_filename = $(this).attr("data-filename");
photo_type = $(this).attr("data-type");
photo_size = $(this).attr("data-size");
    
            $(".photo-info-box.hidden").removeClass("hidden");
            $(".data-photo_id").html(photo_id);    
            $(".data-filename").html(photo_filename);
            $(".data-type").html(photo_type);
            $(".data-size").html(photo_size);
    
        /*$.ajax({
        
        url: "includes/ajax_code.php",
        data:{photo_id: photo_id, photo_filename: photo_filename, photo_type: photo_type, photo_size: photo_size},
        type: "POST",
        success:function(data) {
            
            if(!data.error) {
                
            $(".data-photo_id").html(photo_id);    
            $(".data-filename").html(photo_filename);
            $(".data-type").html(photo_type);
            $(".data-size").html(photo_size);
            //location.reload(true);
            
                
            }
            
        }
        
        
        
    });*/
    

    
});

$("#set_user_image").click(function(){
    
    $.ajax({
        
        url: "includes/ajax_code.php",
        data:{image_name: image_name, user_id: user_id},
        type: "POST",
        success:function(data) {
            
            if(!data.error) {
                
            $(".user_img_box a img").prop('src', data);    
            location.reload(true);
            
                
            }
            
        }
        
        
        
    });

});
    
    


/*******************Edit Photo Sidebar*****************/

$(".info-box-header").click(function(){
    
    $(".inside").slideToggle("fast");
    $("#toggle").toggleClass("glyphicon-menu-down , glyphicon-menu-up");
    
});

/***********Delete Functio***********/


$(".delete_link").click(function(){

return confirm("Are you sure you want to delete this item");

});



});
