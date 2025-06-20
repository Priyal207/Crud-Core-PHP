<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Add Student</title>
</head>
<body>  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Add 
                        <a href="?controller=studentController&action=listing" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>PhoneNumber</label>
                            <input type="text" name="number" value="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Marks</label>
                            <input type="text" name="mark" value="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="Address" value="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Birthdate</label>
                            <input type="text" name="birthdate" value="" class="form-control">
                        </div>
                         <div class="mb-3">
                            <label>Upload Images</label>
                            <input type="file" name="image[]" multiple="multiple" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" name="submit" value="" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>