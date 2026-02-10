<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
    <link rel="stylesheet" href="task_2/task2/assets/styles/create_form.css">
</head>
<body style="background-image: linear-gradient(to left, #33FFCC,#CCFF99)">
    <form action="add_user.php">
        <div class="container col-lg-8 mt-4">
            <div class="card">
             <a href="display_users.php"> <- Back</a>
             <div class="row">
                 <div class="col-12 text-center">
                     <h3 class="heading">Client Form</h3>
                 </div>
                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Full Name</label>
                     <input type="text" name="" placeholder="Enter your full Name" class="form-control">
                 </div>
                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Email</label>
                     <input type="email" name="" placeholder="Enter your Email" class="form-control">
                 </div>
                 <div class="col-5 ml-5 mt-3 pl-3">
                     <label>Phone number</label>
                     <input type="number" name="" placeholder="Enter your Email" class="form-control">
                 </div>
             </div>
             <div class="row">
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                     <label>Upload Image</label>
                     <input type="file" class="form-control" name="image"
                     accept="image/*">
                 </div>
                 <div class="form-group col-5 ml-5 mt-3 pl-3">
                     <label>Upload PDF</label>
                     <input type="file" class="form-control" name="pdf"
                     accept="application/pdf">
                 </div>
             </div>
             <div class="row">
                 <div class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select Country</label> <br>
                     <select class="form-select" aria-label="Default select example">
                     <option selected>Select the Country</option>
                     <option value="1">India</option>
                     <option value="2">Srilanka</option>
                     <option value="3">SA</option>
                 </select>
                 </div>
                 <div class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select State</label> <br>
                     <select class="form-select" aria-label="Default select example">
                     <option selected>Select the State</option>
                     <option value="1">Gujarat</option>
                     <option value="2">Kolkata</option>
                     <option value="3">Rajasthan</option>
                 </select>
                 </div>
                 <div class="form-group col-sm ml-5 mt-3 pl-3">
                     <label>Select City</label> <br>
                     <select class="form-select" aria-label="Default select example">
                     <option selected>Select the City</option>
                     <option value="1">Rajkot</option>
                     <option value="2">Ahmedabad</option>
                     <option value="3">Surat</option>
                 </select>
                 </div>
             </div>
             <div class="d-flex flex-row-reverse pr-3 pb-3 mt-3">
                 <button type="button submit" class="btn btn-success">Submit</button>
             </div>
         </div>
        </div>
    </form>
</body>
</html>