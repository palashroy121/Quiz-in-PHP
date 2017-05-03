<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
$q_result = $obj->select_all_quiz();
if(isset($_POST['btn'])) {
    $quiz_id = $_POST['q_id'];

    //$sqlans = "AND correct"AND correct_answer=$co_answer

    if(isset($_POST['correct_answer'])) {
        $sql2 = "SELECT * FROM tbl_answer WHERE quiz_id=$quiz_id AND correct_answer=1";
        //var_dump($sql2);
        $answer2 = mysqli_query($obj->conn, $sql2);
        $ans = '';
        while ($row = mysqli_fetch_array($answer2)) {
            $ans .= $row['question_id'] . ':' . $row['answer_id'] . ',';

        }
        $ans = rtrim($ans, ',');
        $sql = "SELECT * FROM tbl_participant WHERE quiz_id=$quiz_id AND correct_answers='$ans'";
        //echo $sql;
    }else{
        $sql = "SELECT * FROM tbl_participant WHERE quiz_id=$quiz_id";
    }
    $answer = mysqli_query($obj->conn, $sql);
    //print_r($ans);

    //$sql3 = "SELECT * FROM tbl_participant WHERE quiz_id='$quiz_id' AND correct_answer='$ans'";
    //$answer3 = mysqli_query($obj->conn, $sql2);
    //var_dump(empty($answer));

}

?>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Search Quiz Answer</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6 ">
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Select Quiz Name</label>
                <select name="q_id" class="form-control" id="exampleInputEmail1">
                    <option name="quiz_id"> Select Quiz </option>
                    <?php while($row=mysqli_fetch_array($q_result)) { ?>
                    <option  value="<?php echo $row['quiz_id']; ?>"> <?php echo $row['quiz_title']; ?> </option>
                        <?php
                    }
                    //exit();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Correct Answer </label>
                <input type="checkbox" name="correct_answer" value="1">
            </div>
            <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
    <div class="col-md-12">
        <?php
        if(!empty($answer)) {
            ?>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <?php

                while ($row = mysqli_fetch_array($answer)) {

                    ?>
                    <tr>
                        <td><h4><?php echo $row['name']; ?></h4></td>
                        <td><h4><?php echo $row['email']; ?></h4></td>
                        <td><h4><?php echo $row['phone']; ?></h4></td>
                    </tr>
                    <?php
                }
                exit();
            ?>
        </table>
        <?php
        }
        ?>
    </div>
</div>

<?php require 'footer.php'; ?>