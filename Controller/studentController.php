<?php 
    require_once("Model/studentModel.php");
    class studentController{
        private $model;
        public function __construct()
        {
            $this->model = new studentModel();
        }

        public function listing(){
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $limit = 5;
            $page = 1;
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            }
            $start_from = ($page - 1) * $limit;
            $result = $this->model->select_data($start_from, $limit);
            $students = [];
            while ($row = $result->fetch_assoc()) {
                // Decode the JSON array of image paths
                $row['images'] = json_decode($row['images'] ?? '[]', true) ?: [];
                $students[] = $row;
            }
            $students = $this->model->pagination();
            $page = $students->num_rows;
            $total_pages = ceil($page / $limit);
            $result = $this->model->getData($start_from, $limit, $search); 
            include 'View/students/listing.php';
        }

        public function addStudent(){
            if (isset($_POST['submit'])){	
                $data = [
                    "name" => $_POST['name'],
                    "email" => $_POST['email'],
                    "number" => $_POST['number'],
                    "Address" => $_POST['Address'],
                    "birthdate" => $_POST['birthdate'],
                    "mark" => $_POST['mark']                    
                ];      
                
                $sql = $this->model->createStudent($data);          
                if ($sql) {
                    header("location:?controller=studentController&action=listing");
                } else {
                    echo "try again";
                }
            }
            include 'View/students/create.php';
        }

        public function editStudent(){
            $id = $_GET['id'];        
            if (isset($_POST['save'])){	
                $data = [
                    "name" => $_POST['name'],
                    "email" => $_POST['email'],
                    "number" => $_POST['number'],
                    "Address" => $_POST['Address'],
                    "birthdate" => $_POST['birthdate'],
                ];   
                $sql = $this->model->updateStudent($data, $id);
                if ($sql) {
                    echo "Updated successfully";
                    header("location:?controller=studentController&action=listing");
                } else {
                    echo "try again";
                }
            }
            else if (!empty($id)) {
                $editData = $this->model->editStudent($id);
            } else {
                echo 'Id not found';
                exit;
            }
            include 'View/students/edit.php';
        }

        public function delete(){
            $id = $_GET['id'];
            $sql = $this->model->deleteStudent($id);
            if ($sql) {
                echo "Delete successfully";
                header("location:?controller=studentController&action=listing");
            } else {
                echo "try again";
            }
        }

        public function viewData(){
            $data = $_GET;
            if($data['id']=='') {
                $data = [
                    "name" => $_POST['name'],
                    "email" => $_POST['email'],
                    "number" => $_POST['number'],
                    "mark" => $_POST['mark'],
                    "Address" => $_POST['Address'],
                    "birthdate" => $_POST['birthdate'],
                ];            
            } else {
                $result = $this->model->viewOnerecord($data['id']); 
            }         
            include 'View/students/view.php'; 
        }

        public function export()
        {
            $filename = 'students_data' . date('Ymd') . '.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");
            $students_Data = $this->model->exportData();

            $file = fopen('php://output', 'w');
            $header = array('id', 'name', 'email', 'number', 'mark', 'Address', 'birthdate');
            fputcsv($file, $header);
            foreach ($students_Data as $value) {
                fputcsv($file, $value);
            }
            fclose($file);
            exit;
        }
    }

?>