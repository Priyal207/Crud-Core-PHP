<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(!empty($editData) && empty($_POST)){
        $name = $editData['name'] ?? '';
        $email = $editData['email'] ?? '';
        $number = $editData['number'] ?? '';
        $Address = $editData['Address'] ?? '';
        $birthdate = $editData['birthdate'] ?? '';
        $mark = $editData['mark'] ?? '';
    } else if (!empty($_POST)){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $number = $_POST['number'] ?? '';
        $Address = $_POST['Address'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $mark = $_POST['mark'] ?? '';
        
    }
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
    <title>Student Edit</title>
</head>
<body>  
<div class="container mt-5">
    <?php //include('message.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student Edit 
                        <a href="?controller=studentController&action=listing" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                   <form action="" method="POST">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name ?? ''; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $email ?? ''; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>PhoneNumber</label>
                            <input type="text" name="number" value="<?php echo $number ?? ''; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Marks</label>
                            <input type="text" name="mark" value="<?php echo $mark ?? ''; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="Address" value="<?php echo $Address ?? ''; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Birthdate</label>
                            <input type="text" name="birthdate" value="<?php echo $birthdate ?? ''; ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save" value="" class="btn btn-primary">Save Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
</body>
</html>