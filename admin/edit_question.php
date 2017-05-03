<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();

if(isset($_POST['btn'])) {
    //$message = $obj -> edit_question($_POST);

    $q_id = $_GET['id'];

        $updated_at = date('Y-m-d h:i:s');
        $sql = "UPDATE tbl_question SET question='$_POST[question]', updated_at='$updated_at' WHERE question_id=$q_id";
        //var_dump($sql);
        mysqli_query($obj->conn,$sql);

        //$question_id = $_POST['question_id'];
       // print_r($_POST['answers']);
    
        foreach($_POST['answers'] as $key => $value) {
            //echo $key;
            if($_POST['correct_answer'] == $key) {
                $sql = "UPDATE tbl_answer SET answers='$value', correct_answer=1 WHERE answer_id=$key";

            }else {
                $sql = "UPDATE tbl_answer SET answers='$value', correct_answer=0 WHERE answer_id=$key";
            }
            
            mysqli_query($obj->conn, $sql);
        }

    header("Location: view_question.php");
}
$q_question_id = $_GET['id'];
//print_r($quiz_id);
$sql = "SELECT * FROM tbl_question WHERE question_id=$q_question_id";
$result = mysqli_query($obj->conn,$sql);
$row=mysqli_fetch_array($result);
$qu_id=$row['question_id'];
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Edit Question</h2>
        <?php
        if(isset($message)) {
            echo $message;
            unset ($message);
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6 ">
        <form action="" method="post" name="question_form">

            <table class="table">
                <tr class="box">
                    <td>
                        Question Name
                    </td>
                    <td>
                        <input class="text-box" type="text" name="question" value="<?php echo $row['question']; ?>" />
                        <input type="hidden" name="question_id" value="<?php echo $row['question_id']; ?>" />
                    </td>
                </tr>
                <?php
                $sql2 = "SELECT * FROM tbl_answer WHERE question_id = $qu_id";
                $answers = mysqli_query($obj->conn, $sql2);
                
                $no=1;
                while($ans=mysqli_fetch_array($answers)) {
                    //print_r($ans);

                    ?>
                <tr>
                    <td>
                        
                        Answer <?php echo $no; ?>
                    </td>
                    <td class="box">

                        <input type="text" class="text-box" name="answers[<?php echo $ans['answer_id'];?>]" value="<?php echo $ans['answers'];?>" />
                        <input type="radio" name="correct_answer" value="<?php echo $ans['answer_id']; ?>" <?php  if($ans['correct_answer']==1){echo 'checked';} ?> />

                    </td>
                </tr>
                    <?php $no++; } ?>
                
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button><br/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>