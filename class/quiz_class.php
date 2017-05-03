<?php
class Quiz_Class {
    public $conn;

    //put your code here
    public function  __construct() {
        $username = "root";
        $password = "";
        $hostname = "localhost";
        $dbname = "quiz";
        $this->conn = mysqli_connect($hostname,$username,$password,$dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function save_quiz($data) {
        $sql = "INSERT INTO tbl_quiz (quiz_title, start_date, end_date, conditions, remarks) VALUES ('$data[quiz_title]','$data[start_date]','$data[end_date]','$data[conditions]','$data[remarks]')";
        if(mysqli_query($this->conn,$sql)) {
            $message = 'Save Quiz Successfully!';
            return $message;
        }
        else {
            echo 'Sql Error:'. mysqli_error();
        }
    }

    public function select_all_quiz() {
        $sql = "SELECT * FROM tbl_quiz";
        $result = mysqli_query($this->conn,$sql);
        return $result;
        exit();
    }

    public function save_question($data) {
        $created_at = date('Y-m-d h:i:s');
        $sql = "INSERT INTO tbl_question (quiz_id, question, created_at) VALUES('$data[quiz_id]','$data[question]', '$created_at')";
        mysqli_query($this->conn,$sql);

        $question_id = mysqli_insert_id($this->conn);

        $no = 1;
        foreach($data['answers'] as $value) {
            if($data['correct_answer'] == $no) {
                $sql = "INSERT INTO tbl_answer (quiz_id,question_id,answers,correct_answer) VALUES ($data[quiz_id],$question_id,'$value',1)";

            }else {
                $sql = "INSERT INTO tbl_answer (quiz_id,question_id,answers) VALUES ('$data[quiz_id]',$question_id,'$value')";
            }
            mysqli_query($this->conn, $sql);
            $no++;
        }
    }
    //End Save Question

    public function select_all_question(){
        //echo '<pre>';
        //print_r($data);
        $sql = "SELECT * FROM tbl_question";
        $result = mysqli_query($this->conn,$sql);
        return $result;
        exit();
    }

    public function edit_quiz($data){
        print_r($data);
        $sql ="UPDATE tbl_quiz SET quiz_title='$data[quiz_title]', conditions='$data[conditions]', remarks='$data[remarks]' WHERE quiz_id='$data[quiz_id]'";
        if(mysqli_query($this->conn,$sql)) {
            $message = 'Update Quiz Successfully!';
            return $message;
        }
        else {
            echo 'Sql Error:'. mysqli_error();
        }
    }

    public function edit_question($data){
        print_r($data);
        $updated_at = date('Y-m-d h:i:s');
        $sql = "UPDATE tbl_question SET question='$data[question]', updated_at=$updated_at WHERE question_id='$data[question_id]'";
        mysqli_query($this->conn,$sql);

        $question_id = mysqli_insert_id($this->conn);

        $no = 1;
        foreach($data['answers'] as $value) {
            if($data['correct_answer'] == $no) {
                $sql = "UPDATE tbl_answer answers=$value, correct_answer =1";

            }else {
                $sql = "UPDATE tbl_answer answers=$value";
            }
            mysqli_query($this->conn, $sql);
            $no++;
        }
    }

}
?>