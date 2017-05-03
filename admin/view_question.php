<?php
require '../class/quiz_class.php';
require 'header.php';
$obj = new Quiz_Class();
$q_result = $obj->select_all_question();
?>
<div class="row">
    <div class="col-md-12">
        
            <table class="table table-bordered">
                <tr>
                    <th>
                        Question Name
                    </th>
                    <th>
                        Answers
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <?php
                while($row=mysqli_fetch_array($q_result)) {
                    ?>
                <tr>
                    <td>
                            <?php echo $row['question'];?>
                    </td>
                    <td>

                            <?php
                            $question_id= $row['question_id'];
                            $sql= "SELECT * FROM tbl_answer WHERE question_id=$question_id";
                            $qu_result=mysqli_query($obj->conn, $sql);
                            $no =1;
                            while($row1=mysqli_fetch_array($qu_result)) {
                                
                                if($row1['correct_answer'] == 1){
                                    echo '<span style="color:green; font-weight: bold;">'.$no.') '.$row1['answers'].'</span><br/>';
                                }else{
                                    echo $no.') '.$row1['answers'].'<br/>';
                                }

                                $no++;
                            }

                            ?>
                    </td>
                    <td>
                        <a href="edit_question.php?id=<?php echo $row['question_id'];?>">Edit</a>
                    </td>
                </tr>
                    <?php
                }
                //exit();
                ?>
            </table>
       
    </div>
</div>
<?php require 'footer.php'; ?>