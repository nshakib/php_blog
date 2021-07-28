<?php 
    include('inc/header.php');
    include('inc/sidebar.php');
?>

<?php
    $msgid = mysqli_real_escape_string($db->link,$_GET['msgid']);//validation
    if(!isset($msgid) || $msgid==NULL)
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
                        $to = $fm->validation($_POST['toEmail']);
                        $from = $fm->validation($_POST['fromEmail']);
                        $subject = $fm->validation($_POST['subject']);
                        $message = $fm->validation($_POST['message']);
                        $sendmail = mail($to,$subject, $message, $from);

                        if($sendmail)
                        {
                            echo "<span class='success'>Successfuly Email Send !!.</span>";
                        }else{
                            echo "<span class='error'>Something went wrong !!.</span>";
                        }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail" readonly value="<?php echo $result['email'] ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Please Enter Your Email Address"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Please Enter Your Subject"  class="medium" />
                            </td>
                        </tr>

                     
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" id="elm1" name="message">
                                    
                                </textarea>
                                
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
