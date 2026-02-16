<?php 

namespace UserController;

require_once __DIR__ . '/../models/users.php';

use UserModel\User;

class UserController{
    

    public function handleRegistration(){

      // created a var inside that superglobal var file from upload
      // mapping that input file to its name and tmp_name for files and img
      
      $img_name = $_FILES['UploadImage']['name'];
      $tmp_img = $_FILES['UploadImage']['tmp_name'];
        
      $doc_name = $_FILES['UploadPdf']['name'];
      $tmp_pdf = $_FILES['UploadPdf']['tmp_name'];

      $imgFolder = __DIR__."/../assets/image/".$img_name;
      $docFolder = __DIR__."/../assets/doc/".$doc_name;

      // After submiting the img is stored in tmp in server in that dir
      // for temporarily then from that tmp to that img folder

      move_uploaded_file($tmp_img,$imgFolder);
      move_uploaded_file($tmp_pdf,$docFolder);

      $Fname = $_POST['fullName'];
      $email = $_POST['email'];
      $PNumber = $_POST['PhNumber'];
    
      $coid = $_POST['select_country'];
      $sid = $_POST['state'];
      $cid = $_POST['city'];

      $data = [
          ":fname" => $Fname,
          ":email" => $email,
          ":ph_num" => $PNumber,
          ":img_path" => $img_name,
          ":pdf_path" => $doc_name,
          ":coid" => $coid,
          ":sid" => $sid,
          ":cid" => $cid
        ];

        $user = new User();
        return $user -> createClient($data);
    }

    public function displayAll(){
        $user = new User();
        return $user -> displayAllUsers();
    }

    public function displayById($id){
        $user = new User();
        return $user -> displayUserById($id);
    }

    public function UpdateById($id,$data){
        $user = new User();
        return $user -> UpdateWithUpload($id, $data);
    }

    public function delete($id){
        $user = new User();
        return $user -> delete($id);
    }
}