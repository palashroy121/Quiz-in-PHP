<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
if(isset($_POST['btn'])) {
    $message = $obj -> save_quiz($_POST);
}
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Add Quiz</h2>
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
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Quiz Name</label>
                <input type="text" name="quiz_title" class="form-control" id="exampleInputEmail1" placeholder="Quiz Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="exampleInputEmail1" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">End Date</label>
                <input type="date" name="end_date" class="form-control" id="exampleInputEmail1" required>
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
                <textarea name="remarks" style="resize:vertical;" class="form-control" id="exampleInputEmail1" rows="3"></textarea>
            </div>
            <button type="submit" name="btn" value="Submit" class="btn btn-success">Submit</button><br/>
        </form>
    </div>
</div>
<?php require 'footer.php'; ?>