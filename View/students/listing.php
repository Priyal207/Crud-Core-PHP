<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once("Controller/studentController.php");
    $controller = "studentController";    
    $controller = new $controller();  
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
    <title>Students CRUD</title>
</head>
<body>  
<div class="container mt-4">
    <?php // include('message.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Students Details
                        <a href="?controller=studentController&action=addStudent" class="btn btn-primary float-end">Add Students</a>
                        <a href="?controller=studentController&action=export" class="btn btn-primary float-end">Export Data</a>    
                        <input type="text" name="search" placeholder="Search by name or email" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit">Search</button>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>PhoneNumber</th>
                                 <th>Mark</th>
                                <th>Address</th>
                                <th>Birthdate</th> 
                                <th>Images</th>                          
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['number']; ?></td>
                                    <td><?php echo isset($row['mark']) ? $row['mark'] : 'N/A'; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['birthdate']; ?></td>
                                    <td>
                                    <?php
                                        if (!empty($row['images'])) {
                                            $images = explode(",", $row['images']);
                                            foreach ($images as $img) {
                                                echo "<img src='uploads/$img' width='50' height='50' style='margin-right:5px; border-radius:5px; object-fit:cover;'>";
                                            }
                                        } else {
                                            echo "No images uploaded.";
                                        }
                                    ?>
                                    </td>
                                    <td><a href="?controller=studentController&action=viewData&id=<?= $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="?controller=studentController&action=editStudent&id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <form action="" method="POST" class="d-inline">
                                            <a href="?controller=studentController&action=delete&id=<?= $row['id']; ?>" type="submit" name="delete_student" value="<?=$row['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                                        </form>
                                    </td>
                                </tr> 
                                <?php } ?>                            
                        </tbody>
                    </table>
                    <div class="pagination">                      
                    <?php
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;  
                        if ($current_page > 1) { ?>
                            <a class='btn btn-medium btn-secondary' href='index.php?page=<?php echo ($current_page - 1); ?>'>Previous</a>
                        <?php
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = "";
                            if ($i == $current_page) {
                                $active = "active";
                            }
                        ?>
                            <a class='btn btn-small btn-secondary <?php echo $active ?>' href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                        <?php
                        }
                        if ($current_page < $total_pages) { ?>
                            <a class='btn btn-medium btn-secondary' href='index.php?page=<?php echo ($current_page + 1); ?>'>Next</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>