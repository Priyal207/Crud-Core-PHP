<?php
    require_once("config/database.php");
    class studentModel extends dbconnection{
        public function getData($start_from, $limit, $search = ''){                 
            // $query = "SELECT * FROM students"; 

            // $query = "SELECT  students.id, students.name, students.email, students.number, students.Address, students.birthdate, marks.mark 
            // FROM students 
            // JOIN marks ON students.id = marks.id";           
          
            $query = "SELECT 
            students.id, 
            students.name, 
            students.email, 
            students.number, 
            students.address, 
            students.birthdate, 
            
            marks.mark 
            FROM students 
            LEFT JOIN marks ON students.id = marks.student_id 
            LIMIT $start_from, $limit";          
            $result = $this->connection->query($query);
            return $result;
        }

        public function createStudent($data,$files = null){
            $name = $data['name'];
            $email = $data['email'];
            $number = $data['number'];            
            $Address = $data['Address'];
            $birthdate = $data['birthdate'];
            $mark = $data['mark'];

            $insertStudent = "INSERT INTO students (name,email,number,Address,birthdate) VALUES ('$name','$email','$number','$Address','$birthdate')";  

            if($this->connection->query($insertStudent) === TRUE){
                $student_id = $this->connection->insert_id;
                $insertMark = "INSERT INTO marks (mark, student_id) VALUES ('$mark', '$student_id')";
                if ($this->connection->query($insertMark) === TRUE) {
                    echo "✅ Student and mark inserted successfully!";
                    return true;
                } else {
                    echo "❌ Error inserting mark: " . $this->connection->error;
                    return false;
                }
            } else {
                echo "❌ Error inserting student: " . $this->connection->error;
                return false;
            }
        }

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

        public function deleteStudent($id){
            $deleteMarks = "DELETE FROM marks WHERE student_id = '$id'";
            $this->connection->query($deleteMarks);

            $sql = "DELETE FROM students WHERE id=$id";  
            $result = $this->connection->query($sql);
            return $result;
        }

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

        public function pagination(){
            $sql = "SELECT * FROM students ";
            $get_data = $this->connection->query($sql);
            return $get_data;
        }

        function exportData(){
            $result = "select * from students";
            $select = $this->connection->query($result);
            return $select;
        }


        public function countStudents($search = '') {
            $where = '';
            if (!empty($search)) {
                $search = $this->connection->real_escape_string($search);
                $where = "WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
            }

            $query = "SELECT COUNT(*) as total FROM students $where";
            $result = $this->connection->query($query);
            $row = $result->fetch_assoc();
            return $row['total'];
        }
    }
?>

git remote add origin git@github.com:Priyal207/Crud-Core-PHP.git
