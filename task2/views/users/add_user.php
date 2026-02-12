<?php 

// importing scripts
require_once '../../controller/CountryController.php';
require_once '../../controller/StateController.php';
require_once '../../controller/CityController.php';

require_once __DIR__ . '/../../controller/userController.php';

// controller
$countryController = new CountryController\CountryController();
$countries = $countryController -> display();

$userController = new userController\userController();


if(isset($_POST['submit'])){
    $userController -> handleRegistration();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
</head>
<body style="background-image: linear-gradient(to left, #33FFCC,#CCFF99)">

    <form action="add_user.php" method="post" enctype="multipart/form-data">

        <div class="container col-lg-8 mt-4">

            <div class="card">
             <a href="display_users.php"> <- back</a>

             <div class="row">

                 <div class="col-12 text-center">
                     <h3 class="heading">Client Form</h3>
                 </div>

                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Full Name</label>
                     <input type="text" name="fullName" placeholder="Enter your full Name" class="form-control">
                 </div>

                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Email</label>
                     <input type="email" name="email" placeholder="Enter your Email" class="form-control">
                 </div>

                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Phone number</label>
                     <input type="text" name="PhNumber" placeholder="Enter your Phone Number" class="form-control">
                 </div>
                 
             </div>
             <div class="row">
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                     <label>Upload Image</label>
                     <input type="file" class="form-control" name="UploadImage"
                     accept="image/*">
                 </div>
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                     <label>Upload PDF</label>
                     <input type="file" class="form-control" name="UploadPdf"
                     accept="application/pdf">
                 </div>
             </div>

             <!-- display Country -->

             <div class="row">
                 <div class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select Country</label> <br>
                     <select name="select_country" onchange="showState(this.value)" class="form-select" aria-label="Default select example">
                     <option selected>Select the Country</option>
                    <?php foreach($countries as $c){?>
                    <option value="<?php echo $c['id']; ?>">
                        <?php echo $c['country_name']; ?>
                    </option>
                    <?php }?>
                 </select>
                 </div>

            <!-- display State -->

            <div id="state" class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select State</label> <br>
                <select name="select_state" class="form-select" aria-label="Default select example">
                     <option value="" selected>Select the State</option>
                </select>
            </div>
            <!-- display City -->

            <div id="city" class="form-group col-sm ml-5 mt-3 pl-3">
                    <label>Select City</label> <br>
                <select name="select_city" class="form-select" aria-label="Default select example">
                    <option value="" selected>Select the City</option>
                </select>
            </div>

             </div>
             <div class="d-flex flex-row-reverse pr-3 pb-3 mt-3">
                 <button type="button submit" name="submit" class="btn btn-success">Submit</button>
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