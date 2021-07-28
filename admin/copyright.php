<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            //$name = $_POST['name'];
                            $note = $fm->validation($_POST['note']);

                            $note = mysqli_real_escape_string($db->link,$note);
                        
                            if($note == "")
                            {
                                echo "<span class='error'>Field must not be empty!!</span>";
                            }else
                            {
                                $query = "UPDATE tbl_footer SET
                                note = '$note'
                                WHERE id ='1'";

                                $updated_rows = $db->update($query);

                                if ($updated_rows) 
                                {
                                    echo "<span class='success'>Data updated Successfully.</span>";
                                }
                                else 
                                {
                                    echo "<span class='error'>Data Not updated !</span>";
                                } 
                            }
                        }
                ?>


                <?php
                    $query = "SELECT * FROM tbl_footer where id ='1' ";
                    $copyright = $db->select($query);
                    if($copyright)
                        {
                            while($result = $copyright->fetch_assoc())
                                {
                    ?>
                <div class="block copyblock">
                    <form action="" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['note'] ?>" name="note" class="large" />
                                </td>
                            </tr>
                            
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php }}?>
            </div>
        </div>
        <?php include ('inc/footer.php');?>
