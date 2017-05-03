<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
$q_result = $obj->select_all_quiz();
if(isset($_POST['btn'])) {
    $message = $obj -> save_question($_POST);
}
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Add Question</h2>
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

            <table class="table">
                <tr>
                    <td>
                        <p>Quiz Name</p>
                    </td>
                    <td>
                        <select name="quiz_id">
                            <option> Select Quiz </option>
                            <?php while($row=mysqli_fetch_assoc($q_result)) { ?>
                            <option  value="<?php echo $row['quiz_id']; ?>"> <?php echo $row['quiz_title']; ?> </option>
                                <?php
                            }
                            //exit();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Question Name
                    </td>
                    <td>
                        <input type="text" name="question" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        Answer 1
                    </td>
                    <td>
                        <input type="text" name="answers[]" required />
                        <input type="radio" name="correct_answer" value="1" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        Answer 2
                    </td>
                    <td>
                        <input type="text" name="answers[]" required />
                        <input type="radio" name="correct_answer" value="2" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        Answer 3
                    </td>
                    <td>
                        <input type="text" name="answers[]" required />
                        <input type="radio" name="correct_answer" value="3" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        Answer 4
                    </td>
                    <td>
                        <input type="text" name="answers[]" required />
                        <input type="radio" name="correct_answer" value="4" required />
                    </td>
                </tr>
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