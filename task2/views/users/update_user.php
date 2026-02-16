<?php 


// importing scripts
require_once '../../controller/CountryController.php';
require_once '../../controller/StateController.php';
require_once '../../controller/CityController.php';

require_once __DIR__ . '/../../controller/userController.php';

$id = intval($_GET['q']);

// controller
$countryController = new CountryController\CountryController();
$countries = $countryController -> display();

$stateController = new StateController\StateController();

$userController = new userController\userController();

$cityController = new CityController\CityController();

$user = $userController -> displayById($id);

if(isset($_POST['update_btn'])){

    $id = intval($_GET['q']);
    $fname = $_POST['fullName'];
    $email = $_POST['email'];
    $PhNumber = $_POST['PhNumber'];
    $coid = $_POST['select_country'];
    $sid = $_POST['state'];
    $cid = $_POST['city'];

    $old_pic = $_POST['old_pic'];
    $old_pdf = $_POST['old_pdf'];

 
    $data = [
        ":fname" => $fname,
        ":email" => $email,
        ":ph_num" => $PhNumber,
        ":coid" => $coid,
        ":sid" => $sid,
        ":cid" => $cid
    ];


    if(!empty($_FILES['image']['name'])){
        $image_file = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $new_img_name = time()."_".$image_file;
        $target_img = "../../assets/image/" . $new_img_name; 

        if(move_uploaded_file($tmp_name, $target_img)){
            $data[":img_path"] = $new_img_name;
            

            if(!empty($old_pic) && file_exists("../../assets/image/".$old_pic)){
                unlink("../../assets/image/".$old_pic);
            }
        }
    }

    if(!empty($_FILES['UploadNewPdf']['name'])){
        $doc_file = $_FILES['UploadNewPdf']['name'];
        $tmp_doc = $_FILES['UploadNewPdf']['tmp_name'];
        $new_doc_name = time()."_".$doc_file;
        $target_doc = "../../assets/doc/".$new_doc_name;

        if(move_uploaded_file($tmp_doc,$target_doc)){
            $data[":pdf_path"] = $new_doc_name;
        }

        if(!empty($old_pdf) && file_exists("../../assets/doc/".$new_doc_name)){
            unlink("../../assets/doc/".$old_pdf);
        }
    }

    $userController->UpdateById($id, $data);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
</head>
<style>
    .img{
        height: 140px;
        width: 140px;
        border-radius: 50%;
    }
    .img1{
        height: 75px;
        width: 75px;
        margin-left: 60px;
        margin-top:10px;
    }
    td{
        align-items: center;
    }
</style>

<body style="background-image: linear-gradient(to left, #33FFCC,#CCFF99)">

    <form action="update_user.php?q=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

        <div class="container col-lg-8 mt-4">

            <div class="card">
             <a href="display_users.php"> <- back</a>
             <img src="" alt="">
             <div class="row">
                 <div class="col-12 text-center">
                     <h3 class="heading">Update Client Form</h3>
                     <img class="img" src="../../assets/image/<?php echo $user['img_path']; ?>" alt="">
                 </div>
                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Full Name</label>
                     <input type="text" name="fullName" 
                     value="<?php echo $user['fname'] ?>"
                     placeholder="Enter your full Name" 
                     class="form-control">
                    </div>
                    
                    <div class="col-5 ml-5 mt-3 pl-3">
                        <label>Email</label>
                        <input 
                        type="email" 
                        value="<?php echo $user['email'] ?>"
                        name="email" 
                        placeholder="Enter your Email" 
                        class="form-control">
                    </div>
                    
                    <div class="col-5 ml-5 mt-3 pl-3">
                        <label>Phone number</label>
                        <input 
                        type="text" 
                        value="<?php echo $user['ph_num']; ?>"
                        name="PhNumber" 
                        placeholder="Enter your Phone Number" 
                        class="form-control">
                    </div>
                </div>
                <img class="img1" src="../../assets/image/<?php echo $user['img_path']; ?>" alt="">
                <div class="row">
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                    <input name="old_img" type="hidden" value="<?php echo $user['img_path']; ?>">
                     <label>Upload Image</label>
                     <input 
                     type="hidden" 
                     name = "old_pic"
                     value="<?php echo $user['img_path']; ?>">
                     <input 
                     type="file" 
                     value="<?php echo $user['img_path'] ?>"
                     class="form-control" 
                     name="image"
                     accept="image/*">
                 </div>
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                     <a href="../../assets/doc/<?php echo basename($user['pdf_path']); ?>"
                     target="_blank">
                     View pdf
                    </a>
                     <br>

                     <label>Upload PDF</label>

                     <input 
                     name="old_pdf" 
                     type="hidden" 
                     value="<?php echo $user['pdf_path'] ?>">

                     <input 
                     type="file"
                     class="form-control" 
                     value="<?php echo $user['pdf_path'] ?>"
                     name="UploadNewPdf"
                     accept="application/pdf">
                 </div>
             </div>

             <!-- display Country -->

             <div class="row">
                 <div class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select Country</label> <br>
                     <select name="select_country" onchange="showState(this.value)" class="form-select" aria-label="Default select example">
                     <option>
                        Select the Country
                    </option>
                    <?php foreach($countries as $c){?>
                        <option value="<?php echo $c['id']; ?>" <?= ($user['coid'] == $c['id']) ? 'selected' : ''; ?>>
                           <?= $c['country_name']; ?>
                        </option>
                    <?php }?>
                 </select>
                 </div>

            <!-- display State -->

                <div id="state" class="form-group col-sm ml-5 mt-3 pl-3">
                        <label>Select State</label> <br>
                        
                    <select name="state" class="form-select" aria-label="Default select example">
                        <?= 
                        $coid = $user['coid']; 
                        $states = $stateController -> Display($coid);
                        ?>
                        <option>
                            Select the State
                        </option>
                        <?php foreach($states as $s){?>
                        <option value="<?php echo $s['State_id']; ?>" <?= ($user['sid'] == $s['State_id']) ? 'selected': '' ?>>
                            <?= $s['name']; ?>
                        </option>
                        <?php }?>
                    </select>
                </div>

            <!-- display City -->

            <div id="city" class="form-group col-sm ml-5 mt-3 pl-3">
                    <label>Select City</label> <br>
                <select name="city" class="form-select" aria-label="Default select example">
                    <?= 
                    $sid = $user['sid'];
                    $cities =  $cityController -> Display($sid);
                    ?>
                    <option>
                        select City
                    </option>
                    <?php foreach($cities as $c) {?>
                    <option value="<?php echo $c['id']; ?>" <?= ($user['cid'] == $c['id']) ? "selected" : "" ?>>
                        <?= $c['city_name'] ?>
                    </option>
                    <?php }?>
                </select>
            </div>

             </div>
             <div class="d-flex flex-row-reverse pr-3 pb-3 mt-3">
                 <button type="submit" name="update_btn" class="btn btn-warning">Update</button>
             </div>
         </div>
        </div>
    </form>
</body>
<script>
    function showState(str){
        if(str == ""){
            document.getElementById("state").innerHTML = "";
            return;
        }else{
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("state").innerHTML = this.responseText;
                }
            }
            xhr.open("GET","get_state.php?q="+str,true);
            xhr.send();
        }
    }

    function showCity(str){
        if(str == ""){
            document.getElementById("city").innerHTML = "";
            return;
        }else{
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("city").innerHTML = this.responseText;
                }
            }
            xhr.open("GET","get_city.php?q="+str,true);
            xhr.send();
        }
    }
</script>
</html>