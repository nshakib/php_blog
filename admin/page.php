<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>

<?php
    $pageid = mysqli_real_escape_string($db->link,$_GET['pageid']);//validation
    if(!isset($pageid) || $pageid==NULL)
    {
            echo "<script>window.location = 'index.php';</script>";
    } else
    {
        $id = $_GET['pageid'];
    }
?>

<style>
    .actiondel{margin-left: 10px;}
    .actiondel a{
        background-color: #f0f0f0 none repeat strcoll 0 0;
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        font-weight: normal;
        padding: 4px 10px;
        
    }
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Pages</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        //$name = $_POST['name'];
                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);


                        if($name == "" || $body == "")
                        {
                            echo "<span class='error'>Field must not be empty!!</span>";
                        }
                        else
                        {
                            $query = "UPDATE tbl_page SET name='$name', body = '$body' WHERE id='$id'";
                            $updatePage = $db->update($query);

                            if($updatePage)
                            {
                                echo "<span class='success'>Page Updated successfully!!</span>";
                            }else
                            {
                                echo "<span class='error'>Page not updated successfully!!</span>";
                            }
                        }
                    }  
                ?>
                <div class="block">
                    <?php
                    $query = "SELECT * FROM tbl_page where id = '$id'";
                    $pages = $db->select($query);
                    if($pages)
                        {
                            while($result=$pages->fetch_assoc())
                            {
                    ?>            
                    <form action="" method="POST">
                        <table class="form">
                        
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                                </td>
                            </tr>
                        
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" id="elm1" name="body">
                                        <?php echo $result['body'] ?>
                                    </textarea>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                    <span class="actiondel">
                                        <a onclick="return confirm('Are sure want to delete !!')" 
                                        href="delpage.php?delpage=<?php echo $result['id'] ?>">Delete</a></span>

                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php }}?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php include ('inc/footer.php');?>
