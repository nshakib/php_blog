<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock">
                   <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        $theme = mysqli_real_escape_string($db->link,$_POST['theme']);

                            $query = "UPDATE tbl_theme SET theme='$theme' WHERE id='1'";
                            $categoryUpdate = $db->update($query);

                            if($categoryUpdate)
                            {
                                echo "<span class='success'>Theme Updated successfully!!</span>";
                            }else
                            {
                                echo "<span class='error'>Theme not updated successfully!!</span>";
                            }
                    } 
                   ?>    
               <?php
                    $query = "SELECT * FROM tbl_theme WHERE id ='1' ";
                    $themes = $db->select($query);
                        while($result = $themes->fetch_assoc())
                            {

               ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                               <input <?php if($result['theme']== 'default'){ echo "checked";}?> 
                               type="radio" name="theme" value="default">default
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <input <?php if($result['theme']== 'green'){ echo "checked";}?>
                                type="radio" name="theme" value="green">Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <input <?php if($result['theme']== 'red'){ echo "checked";}?> 
                               type="radio" name="theme" value="red">Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php };?>
                </div>
            </div>
        </div>
        <?php include ('inc/footer.php');?>