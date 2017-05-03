<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();

if(isset($_POST['btn'])) {
    $message = $obj -> edit_quiz($_POST);
    header("Location: view_quiz.php");
}

$quiz_id = $_GET['id'];
//print_r($quiz_id);
$sql = "SELECT * FROM tbl_quiz WHERE quiz_id=$quiz_id";
$result = mysqli_query($obj->conn,$sql);
$row=mysqli_fetch_array($result);
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Edit Quiz</h2>
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
        <form action="" method="post" name="quiz_form">
            <div class="form-group">
                <label for="exampleInputEmail1">Quiz Name</label>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_title'];?>">
                <input type="text" name="quiz_title" class="form-control" id="exampleInputEmail1" placeholder="Quiz Title" value="<?php echo $row['quiz_title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Conditions</label>
                <select name="conditions" class="form-control" id="exampleInputEmail1">
                    <option> Select </option>
                    <option value="1">Active</option>
                    <option value="0">Draft</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Remarks</label>
                <textarea name="remarks" style="resize:vertical;" class="form-control" id="exampleInputEmail1" rows="3"><?php echo $row['remarks'];?></textarea>
            </div>
            <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button><br/>
        </form>
    </div>
</div>
<script type="text/javascript">
document.forms['quiz_form'].elements['conditions'].value="<?php echo $row['conditions'];?>";
</script>
<?php require 'footer.php'; ?>