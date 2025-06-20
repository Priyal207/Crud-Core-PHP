<?php
require_once 'Mailer.php';
    require_once("config/database.php");
    class studentModel extends dbconnection{
        // Fetch All data from database
        public function getData($start_from, $limit, $search = ''){                           
            $query = "SELECT 
            students.id, 
            students.name, 
            students.email, 
            students.number, 
            students.address, 
            students.birthdate,                   
            marks.mark,
            student_images.images
            FROM students 
            LEFT JOIN marks ON students.id = marks.student_id     
            LEFT JOIN student_images ON students.id = student_images.student_id 
            LIMIT $start_from, $limit
            ";
            $result = $this->connection->query($query);
            return $result;
        }

        
      
        // Create Students
        public function createStudent($data, $files = null) {
            $name = $data['name'];
            $email = $data['email'];
            $number = $data['number'];            
            $Address = $data['Address'];
            $birthdate = $data['birthdate'];
            $mark = $data['mark'];

            $insertStudent = "INSERT INTO students (name, email, number, Address, birthdate)
                      VALUES ('$name', '$email', '$number', '$Address', '$birthdate')";

            if ($this->connection->query($insertStudent) === TRUE) {
                $student_id = $this->connection->insert_id;

                // Insert marks
                $insertMark = "INSERT INTO marks (mark, student_id) VALUES ('$mark', '$student_id')";
                if ($this->connection->query($insertMark) !== TRUE) {
                    echo "❌ Error inserting mark: " . $this->connection->error;
                    return false;
                }

               $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $maxSize = 5 * 1024 * 1024; // 5 MB
                    $baseURL = 'http://localhost/Students_Crud/';

                    if (!empty($files['image']['name'][0])) {
                        $imageNames = $files['image']['name'];
                        $tmpNames   = $files['image']['tmp_name'];
                        $fileSizes  = $files['image']['size'];

                        foreach ($imageNames as $index => $imgName) {
                            if ($imgName != '') {
                                $tmpFile = $tmpNames[$index];
                                $fileSize = $fileSizes[$index];
                                $fileType = mime_content_type($tmpFile);

                                if (!in_array($fileType, $allowedTypes)) {
                                    echo "❌ Invalid image type for $imgName. Allowed types: JPEG, PNG, GIF<br>";
                                    continue;
                                }

                                if ($fileSize > $maxSize) {
                                    echo "❌ File $imgName exceeds 5MB limit.<br>";
                                    continue;
                                }

                                $extension = pathinfo($imgName, PATHINFO_EXTENSION);
                                $baseName = pathinfo($imgName, PATHINFO_FILENAME);
                                $baseName = preg_replace('/[^A-Za-z0-9_-]/', '_', $baseName);
                                $safeFileName = uniqid('img_', true) . '_' . $baseName . '.' . strtolower($extension);

                                $targetPath = $uploadDir . $safeFileName;
                                $imageURL = $baseURL . $targetPath;

                                if (move_uploaded_file($tmpFile, $targetPath)) {
                                    $insertImage = "INSERT INTO student_images (student_id, images)
                                                    VALUES ('$student_id', '$imageURL')";
                                    if (!$this->connection->query($insertImage)) {
                                        echo "❌ DB error for $imgName: " . $this->connection->error . "<br>";
                                    }
                                } else {
                                    echo "❌ Failed to move file: $imgName<br>";
                                }
                            }
                        }
                    }

                echo "✅ Student, mark and images inserted successfully!";
                return true;
            } else {
                echo "❌ Error inserting student: " . $this->connection->error;
                return false;
            }
        }


        // Edit Students
        public function editStudent($id){            
            $edit = "Select * from students WHERE id = $id";         
            $result = $this->connection->query($edit);   
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
                }else{
                    echo "Record not found";
            }
        } 

        // Update Students
        public function updateStudent($data, $id) {
            $name = $data['name'];
            $email = $data['email'];
            $number = $data['number'];
            $Address = $data['Address'];
            $birthdate = $data['birthdate'];

            $sql = "UPDATE students SET name='$name',email='$email',number='$number',Address='$Address',birthdate='$birthdate' WHERE id = '$id'";                   
            $result = $this->connection->query($sql); 
            return $result;
        }

        // Delete Student
        public function deleteStudent($id){
            $deleteMarks = "DELETE FROM marks WHERE student_id = '$id'";
            $this->connection->query($deleteMarks);

            $sql = "DELETE FROM students WHERE id=$id";  
            $result = $this->connection->query($sql);
            return $result;
        }

        // View Students
        public function viewOnerecord($id){                 
            // $query = "SELECT * FROM students where id='$id' LIMIT 1";
            $query = "SELECT students.*, marks.mark 
              FROM students 
              LEFT JOIN marks ON students.id = marks.student_id 
              WHERE students.id = '$id'";
            $result = $this->connection->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
                }else{
                    echo "Record not found";
                }
            return $result;
        }

        Public function select_data($start_from,$limit){ 
            $sql = "SELECT * FROM students order by id DESC LIMIT $start_from, $limit";
            $result = $this->connection->query($sql);
            return $result;
        }

        // Pagination
        public function pagination(){
            $sql = "SELECT * FROM students ";
            $get_data = $this->connection->query($sql);
            return $get_data;
        }

        // export data
        function exportData(){
            $result = "select * from students";
            $select = $this->connection->query($result);
            return $select;
        }
    }
?>