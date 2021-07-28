
<?php 
	include('../lib/session.php');
    Session::checkSession();
?>
<?php 
	include('../config/config.php');
    include('../lib/database.php');
?>
<?php 
	$db = new Database();
?>

<?php
            $delpage= mysqli_real_escape_string($db->link,$_GET['delpage']);//validation
            if(!isset( $delpage) ||  $delpage==NULL)
            {
                echo "<script>window.location = 'index.php';</script>";
                // header('Location:catlist.php');
            } else
            {
                $delpageid =  $delpage;

                $delquery = "DELETE from tbl_page where id = '$delpageid'";
                $deldata = $db->delete($delquery);
                
                if($deldata)
                {
                    echo "<script>alert('Page deleted successfully')</script>";
                    echo "<script>window.location = 'index.php';</script>";
                }else
                {
                    echo "<script>alert('Page not deleted successfully')</script>";
                    echo "<script>window.location = 'index.php';</script>";
                }
            }
        ?>
