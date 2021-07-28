<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
        <?php
            $editid= mysqli_real_escape_string($db->link,$_GET['editid']);//validation
            if(!isset($editid) || $editid==NULL)
            {
                echo "<script>window.location = 'postlist.php';</script>";
                // header('Location:catlist.php');
            } else
            {
                $postid = $editid;
            }
        ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        //$name = $_POST['name'];
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                        $author = mysqli_real_escape_string($db->link,$_POST['author']);
                        $userid = mysqli_real_escape_string($db->link,$_POST['userid']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "uploads/".$unique_image;

                        if($title == "" || $cat == "" || $body == "" || $tags == "" || $author =="")
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
                                        $query = "UPDATE tbl_post SET
                                            cat = '$cat',
                                            title = '$title',
                                            body = '$body',
                                            image = '$uploaded_image',
                                            author = '$author',
                                            tags = '$tags',
                                            userid= '$userid'
                                            WHERE id ='$postid'
                                        ";
                                        $updated_rows = $db->update($query);
    
                                        if ($updated_rows) 
                                        {
                                            echo "<span class='success'>Post updated Successfully.</span>";
                                        }
                                        else 
                                        {
                                            echo "<span class='error'>Post Not updated !</span>";
                                        }
                                    }
                            }
                            else
                            {
                                // move_uploaded_file($file_temp, $uploaded_image);
                                $query = "UPDATE tbl_post SET
                                    cat      = '$cat',
                                    title    = '$title',
                                    body     = '$body',
                                    author   = '$author',
                                    tags     = '$tags',
                                    userid   = '$userid'
                                    WHERE id ='$postid'
                                ";
                                $updated_rows = $db->update($query);
    
                                if ($updated_rows) 
                                {
                                    echo "<span class='success'>Post updated Successfully.</span>";
                                }
                                else 
                                {
                                    echo "<span class='error'>Post Not updated !</span>";
                                }
                            }
                        }
                    }  
                ?>
                <div class="block"> 
                    <?php
                        $query = "SELECT * FROM tbl_post where id ='$postid' order by id desc";
                        $getpost = $db->select($query);
                        while($postresult = $getpost->fetch_assoc())
                        {

                    ?>            
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                        
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                                </td>
                            </tr>
                        
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                    <option>Select Category</option>
                                        <?php
                                            $query = "SELECT * FROM tbl_category";
                                            $category = $db->select($query);
                                            if($category)
                                            {
                                                while($result=$category->fetch_assoc())
                                                {
                                        ?>
                                        <option 

                                            <?php
                                                if($postresult['cat'] == $result['id']){?>
                                                    selected = "selected";
                                                <?php }?>
                                        value="<?php echo $result['id']?>"><?php echo $result['name']?></option>
                                        <?php }}?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postresult['image'];?>" height="100px" width="200px" alt=""><br>
                                    <input type="file" name="image" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" id="elm1"  name="body">
                                        <?php echo $postresult['body']; ?>
                                    </textarea>
                                    <!-- <textarea id="elm1" name="elm1" rows="15" cols="80"><?php echo $sContent;?></textarea> -->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                <input type="text" name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
                                <input type="hidden"  name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
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
