<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>

<?php 
    $msgid = mysqli_real_escape_string($db->link,$_GET['msgid']);//validation
    if(!isset($msgid) || $$msgid==NULL)
    {
        echo "<script>window.location = 'inbox.php';</script>";
        // header('Location:catlist.php');
    } else
    {
        $msgid= $msgid;
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        echo "<script>window.location = 'inbox.php';</script>";
                    }  
                ?>
                <div class="block">            
                 <form action="" method="POST">
                     <?php
                     $query = "SELECT * FROM tbl_contact where id='$msgid'";
                     $message = $db->select($query);
                     if($message)
                     {
                         
                         while($result= $message->fetch_assoc())
                             {
                               
                        
                     ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['firstname']. " ".$result['lastname'] ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['email'] ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $fm->formatDate($result['date']) ?>"  class="medium" />
                            </td>
                        </tr>

                     
                        <tr>
                            <td>
                                <label>Message</label>
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
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    <?php }}?>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php include ('inc/footer.php');?>
