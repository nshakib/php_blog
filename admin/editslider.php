<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
        <?php
            $sliderid= mysqli_real_escape_string($db->link,$_GET['sliderid']);//validation
            if(!isset($sliderid) || $sliderid==NULL)
            {
                echo "<script>window.location = 'sliderlist.php';</script>";
                // header('Location:catlist.php');
            } else
            {
                $sliderid = $sliderid;
            }
        ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "uploads/slider/".$unique_image;

                        if($title == "" )
                        {
                            echo "<span class='error'>Field must not be empty!!</span>";
                        }
                        else
                        {
                            if(!empty($file_name))
                            {
                                if ($file_size >1048567) 
                                    {
                                        echo "<span class='error'>Image Size should be less then 1MB!
                                        </span>";
                                    } 
                                
                                elseif (in_array($file_ext, $permited) === false) 
                                    {
                                        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                                    }
                                else
                                    {
                                        move_uploaded_file($file_temp, $uploaded_image);
                                        $query = "UPDATE tbl_slider SET
                                            title = '$title',
                                            image = '$uploaded_image'
                                            WHERE id ='$sliderid'
                                        ";
                                        $updated_rows = $db->update($query);
    
                                        if ($updated_rows) 
                                        {
                                            echo "<span class='success'>Slider updated Successfully.</span>";
                                        }
                                        else 
                                        {
                                            echo "<span class='error'>Slider Not updated !</span>";
                                        }
                                    }
                            }
                            else
                            {
                                // move_uploaded_file($file_temp, $uploaded_image);
                                $query = "UPDATE tbl_slider SET
                                    title    = '$title'
                                    WHERE id ='$sliderid'
                                ";
                                $updated_rows = $db->update($query);
    
                                if ($updated_rows) 
                                {
                                    echo "<span class='success'>Slider updated Successfully.</span>";
                                }
                                else 
                                {
                                    echo "<span class='error'>Slider Not updated !</span>";
                                }
                            }
                        }
                    }  
                ?>
                <div class="block"> 
                    <?php
                        $query = "SELECT * FROM tbl_slider where id ='$sliderid'";
                        $getslider = $db->select($query);
                        while($result = $getslider->fetch_assoc())
                        {

                    ?>            
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                                </td>
                            </tr>
                        
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $result['image'];?>" height="100px" width="250px" alt=""><br>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update Slider" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php include ('inc/footer.php');?>
