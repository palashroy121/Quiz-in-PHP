<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
$q_result = $obj->select_all_quiz();
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">View Quiz</h2>
        <?php
        if(isset($message)) {
            echo $message;
            unset ($message);
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post">
            <table class="table table-bordered">
                <tr>
                    <td>
                        Quiz Name
                    </td>
                    <td>
                        Conditions
                    </td>
                    <td>
                        Remarks
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                <?php
                while($row=mysqli_fetch_array($q_result)) {
                    ?>
                <tr>
                    <td>
                            <?php echo $row['quiz_title'];?>
                    </td>
                    <td>
                            <?php echo $row['conditions'];?>
                    </td>
                    <td>
                            <?php echo $row['remarks'];?>
                    </td>
                    <td>
                        <a href="edit_quiz.php?id=<?php echo $row['quiz_id'];?>">Edit</a>
                    </td>
                </tr>
                    <?php
                }
                exit();
                ?>
            </table>
        </form>
    </div>
</div>
<?php require 'footer.php'; ?>