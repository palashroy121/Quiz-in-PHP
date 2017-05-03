<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();

if(isset($_POST['btn'])) {
    $quiz_id = $_POST['q_id'];
    $sql = "SELECT * FROM tbl_answer WHERE quiz_id=$quiz_id AND correct_answer=1";
    $answer = mysqli_query($obj->conn, $sql);
    $ans='';
    while($row=mysqli_fetch_array($answer)) {

        $ans .= $row['question_id'] .':'. $row['answer_id'].',';
    }
    $ans = rtrim($ans, ',');

    $sql_2 = "SELECT * FROM tbl_participant WHERE correct_answers='$ans'";
    $answer_2 = mysqli_query($obj->conn, $sql_2);

    //print_r($answer_2);
}
?>

<html>
<body>
<table width="90%" height="auto" border="1">
    <tr>
        <td>
            Name
        </td>
        <td>
            Email
        </td>
        <td>
            Phone
        </td>
    </tr>
    <?php
    while($row=mysqli_fetch_array($answer_2)) {

        ?>
    <tr>
        <td>
            <h3><?php echo $row['name'];?></h3>
        </td>
        <td>
            <h4><?php echo $row['email'];?></h4>
        </td>
        <td>
            <h4><?php echo $row['phone'];?></h4>
        </td>
    </tr>
        <?php
    }
    exit();
    ?>
</table>
</body>
</html>

<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
$q_result = $obj->select_all_quiz();
if(isset($_POST['btn'])) {
    $quiz_id = $_POST['q_id'];
    $sql = "SELECT * FROM tbl_answer WHERE quiz_id='$quiz_id' AND correct_answer=1";
    $answer = mysqli_query($obj->conn, $sql);
    $ans='';
    while($row=mysqli_fetch_array($answer)) {
        $ans .= $row['question_id'] .':'. $row['answer_id'].',';
    }
    $ans = rtrim($ans, ',');
    print_r($ans);
    $sql_2 = "SELECT * FROM tbl_participant WHERE correct_answer='$ans'";
    $answer_2 = mysqli_query($obj->conn, $sql_2);

    print_r($answer_2);
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
                    <option> Select Quiz </option>
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
                <input type="checkbox" name="correct_anawer" value="1">
            </div>
            <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <?php
            while($row=mysqli_fetch_array($answer_2)) {

                ?>
            <tr>
                <td><h4><?php echo $row['name'];?></h4></td>
                <td><h4><?php echo $row['email'];?></h4></td>
                <td><h4><?php echo $row['phone'];?></h4></td>
            </tr>
                <?php
            }
            exit();
            ?>
        </table>
    </div>
</div>

<?php require 'footer.php'; ?>