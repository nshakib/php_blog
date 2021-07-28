<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>
<?php 
    if(Session::get('userRole') != '0')
    {
        echo "<script>window.location = 'index.php';</script>";
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
                   <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        $username = $fm->validation($_POST['username']);
                        $password = $fm->validation(md5($_POST['password']));
                        $email = $fm->validation($_POST['email']);
                        $role = $fm->validation($_POST['role']);
                        


                        $username = mysqli_real_escape_string($db->link,$username);
                        $password = mysqli_real_escape_string($db->link,$password);
                        $email = mysqli_real_escape_string($db->link,$email);
                        $role = mysqli_real_escape_string($db->link,$role);
                        


                        if(empty($username) || empty($password)|| empty($email || empty($role) ))
                        {
                            echo "<span class='error'>Field must Not be empty</span>";
                        }else{
                            $emailquery = "SELECT * FROM tbl_user where email='$email' LIMIT 1";
                            $mailcheck = $db->select($emailquery);
                            if($mailcheck !=false)
                            {
                                echo "<span class='error'>Email alreadt exits!!</span>";
                            }else
                            {
                                $query = "INSERT INTO tbl_user(username, password, email, role) values('$username','$password','$email', '$role')";
                                $categoryInsert = $db->insert($query);
    
                                if($categoryInsert)
                                {
                                    echo "<span class='success'>User Created successfully!!</span>";
                                }else
                                {
                                    echo "<span class='error'>User Not Created successfully!!</span>";
                                }
                            }
                        }

                       
                    } 
                   ?>    
               
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label for="username">User Name</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" value="<?php echo $fm->randomPassword(); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Enter valid email address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="role">User Role</label>
                            </td>
                            <td>
                                <select id="select" name="role">
                                    <option value="">Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
                        
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php include ('inc/footer.php');?>