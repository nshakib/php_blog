<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            //$name = $_POST['name'];
                            $fb = $fm->validation($_POST['fb']);
                            $tw = $fm->validation($_POST['tw']);
                            $ln = $fm->validation($_POST['ln']);
                            $gp = $fm->validation($_POST['gp']);

                            $fb = mysqli_real_escape_string($db->link,$fb);
                            $tw = mysqli_real_escape_string($db->link,$tw);
                            $ln = mysqli_real_escape_string($db->link,$ln);
                            $gp = mysqli_real_escape_string($db->link,$gp);
                        
                            if($fb == "" || $tw == "" || $ln == "" || $gp == "")
                            {
                                echo "<span class='error'>Field must not be empty!!</span>";
                            }else
                            {
                                $query = "UPDATE tbl_social SET
                                fb = '$fb',
                                tw = '$tw',
                                ln = '$ln',
                                gp = '$gp'
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
                        $query = "SELECT * FROM tbl_social where id ='1' ";
                        $socail_media = $db->select($query);
                        if($socail_media)
                        {
                            while($result = $socail_media->fetch_assoc())
                            {
                    ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb'] ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['ln'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $result['gp'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
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