<?php 
     if(!empty($result) && empty($_POST)){
        $name = $result['name'] ?? '';
        $email = $result['email'] ?? '';
        $number = $result['number'] ?? '';
        $mark = $result['mark'] ?? '';
        $Address = $result['Address'] ?? '';
        $birthdate = $result['birthdate'] ?? '';
    } else if (!empty($_POST)){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $number = $_POST['number'] ?? '';
        $mark = $result['mark'] ?? '';
        $Address = $_POST['Address'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
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
    <title>View Student</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student View Details 
                        <a href="?controller=studentController&action=listing" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                 <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">                            
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control">                            
                        </div>

                        <div class="mb-3">
                            <label>PhoneNumber</label>
                            <input type="text" name="number" value="<?php echo $number; ?>" class="form-control">                            
                        </div>

                        <div class="mb-3">
                            <label>Marks</label>
                            <input type="text" name="mark" value="<?php echo $mark; ?>" class="form-control">                            
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="Address" value="<?php echo $Address; ?>" class="form-control">                            
                        </div>

                        <div class="mb-3">
                            <label>Birthdate</label>
                            <input type="text" name="birthdate" value=" <?php echo $birthdate; ?>" class="form-control">                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
</html>