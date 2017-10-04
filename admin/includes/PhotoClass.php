<?php


class Photo extends Db_object {

    protected static $db_table = "photos";


    protected static $db_table_fields = array('title','caption','description','filename','alternate_text','type','size');
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
    public $upload_profile_img_dir = "profile_images";
    public $view_photo_comments_dir = "admin";
    public $errors = array();
    public $upload_errors_array = array (

        UPLOAD_ERR_OK              => "There is no error",
        UPLOAD_ERR_INI_SIZE        => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE       => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in HTML",
        UPLOAD_ERR_PARTIAL         => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE         => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR      => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE      => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION       => "A PHP extension stopped the file upload"

    );



    public function set_file($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";

            return false;

        } elseif ($file['error'] != 0) {

            $this->errors[] = $this->upload_errors_array[$file['error']];

            return false;

        } else {

            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }

    }


    public function picture_path() {

        return $this->upload_directory.DS.$this->filename;
    }

    public function photo_image_path_and_placeholder() {

        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }


    public function save() {

        if($this->id) {
            $this->update();

        } else {

            if(!empty($this->errors)) {

                return false;

            } 

            if (empty($this->filename) || empty($this->tmp_path)){

                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;


            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;

            }

            if(move_uploaded_file($this->tmp_path, $target_path)) {
                echo "move upload file";

                if($this->create()) {
                    unset($this->tmp_path);
                    echo "create";
                    return true;

                }

            } else {

                $this->errors[] = "The file permissions are probably not set correctly";
                echo "file perm";
                return false;
            }        


        }
    }
    public function save_profile_img() {

        if($this->id) {
            $this->update();

        } else {

            if(!empty($this->errors)) {

                return false;

            } 

            if (empty($this->filename) || empty($this->tmp_path)){

                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->profile_img_dir. DS . $this->filename;


            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;

            }

            if(move_uploaded_file($this->tmp_path, $target_path)) {
                echo "move upload file";

                if($this->create()) {
                    unset($this->tmp_path);
                    echo "create";
                    return true;

                }

            } else {

                $this->errors[] = "The file permissions are probably not set correctly";
                echo "file perm";
                return false;
            }        


        }
    } 

    public function delete_photo() {


        if($this->delete()) {

            $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();

            return unlink($target_path) ? true : false;

        } else {

            return false;
        }

    }


}



?>