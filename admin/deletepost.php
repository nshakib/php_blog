
<?php 
	include('../lib/session.php');
    Session::checkSession();
?>
<?php 
	include('../config/config.php');
    include('../lib/database.php');
    include('../helpers/format.php');
?>
<?php 
	$db = new Database();
?>

<?php
            $delid= mysqli_real_escape_string($db->link,$_GET['delid']);//validation
            if(!isset($delid) || $delid==NULL)
            {
                echo "<script>window.location = 'postlist.php';</script>";
                // header('Location:catlist.php');
            } else
            {
                $delpostid = $delid;

                $query = "SELECT * FROM tbl_post where id='$delpostid'";
                $getdata = $db->select($query);

                if($getdata)
                {
                    while($delimg = $getdata->fetch_assoc())
                    {
                        $dellink = $delimg['image'];
                        unlink($dellink);
                    }
                }

                $delquery = "DELETE from tbl_post where id = '$delpostid'";
                $deldata = $db->delete($delquery);
                
                if($deldata)
                {
                    echo "<script>alert('Data delete successfully')</script>";
                    echo "<script>window.location = 'postlist.php';</script>";
                }else
                {
                    echo "<script>alert('Data not deleted successfully')</script>";
                    echo "<script>window.location = 'postlist.php';</script>";
                }
            }
        ?>
