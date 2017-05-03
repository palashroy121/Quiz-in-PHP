<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();

if(isset($_POST['btn'])) {
    $answers = $_POST['answer'];
    $ans = '';
    foreach ($answers as $key => $value) {
        $ans .= $key .':'. $value .',';
    }
    $ans = rtrim($ans, ',');
    $quiz_id1 = $_POST['quiz_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    
    $sql = "INSERT INTO tbl_participant (quiz_id, name, address, email, phone, correct_answers) VALUES ('$quiz_id1', '$name','$address','$email','$phone', '$ans')";
    //mysqli_query($obj->conn,$sql);
    if(mysqli_query($obj->conn,$sql)) {
            echo 'Your quiz has been submitted successfully!';
            //return $message;
        }
        else {
            echo 'Sql Error:'. mysqli_error($obj->conn);
        }
    //echo 'Your quiz has been submitted successfully!';

}

$sql = "SELECT * from tbl_quiz WHERE conditions=1 AND quiz_id=1";
$quiz = mysqli_query($obj->conn, $sql);
while($row=mysqli_fetch_array($quiz)) {
    $quid = $row['quiz_id'];
    ?>
<div class="row">
    <div class="col-md-8">
        <h3><?php echo $row['quiz_title'];?></h3>
        <form action="" method="post">
            <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'];?>">
            <?php } ?>
        <hr/>
        
            <?php

            $sql1 = "SELECT * FROM `tbl_question` WHERE quiz_id = $quid";
            $question = mysqli_query($obj->conn, $sql1);
            while($row=mysqli_fetch_array($question)) {
                $qid = $row['question_id'];
                ?>
            <h3>Question: <?php echo $row['question'];?></h3>
                <?php

                $sql2 = "SELECT * FROM tbl_answer WHERE question_id = $qid";
                $answers = mysqli_query($obj->conn, $sql2);
                while($ans=mysqli_fetch_array($answers)) {
                    ?>
            <div class="radio">
                <label>
                    <input type="radio" name="answer[<?php echo $ans['question_id']; ?>]" value="<?php echo $ans['answer_id']; ?>" />
                            <?php echo $ans['answers']; ?><br/>
                </label>
            </div>

                    <?php
                }
            }
            ?>
            <h3>Name: </h3><input type="text" name="name" required />
            <h3>Address: </h3><input type="text" name="address" required />
            <h3>Email: </h3><input type="email" name="email" />
            <h3>Phone: </h3><input type="text" name="phone" /><br/><br/>
            <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button><br/>
        </form>
    </div>
    <div class="row">
        <div class="col-md-4">
            
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>