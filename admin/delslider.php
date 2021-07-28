
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
            $delsliderid= mysqli_real_escape_string($db->link,$_GET['delsliderid']);//validation
            if(!isset($delsliderid) || $delsliderid==NULL)
            {
                echo "<script>window.location = 'sliderlist.php';</script>";
                // header('Location:catlist.php');
            } else
            {
                $delsliderid = $delsliderid;

                $query = "SELECT * FROM tbl_slider where id='$delsliderid'";
                $getdata = $db->select($query);

                if($getdata)
                {
                    while($delimg = $getdata->fetch_assoc())
                    {
                        $dellink = $delimg['image'];
                        unlink($dellink);
                    }
                }

                $delquery = "DELETE from tbl_slider where id = '$delsliderid'";
                $deldata = $db->delete($delquery);
                
                if($deldata)
                {
                    echo "<script>alert('Slider delete successfully')</script>";
                    echo "<script>window.location = 'sliderlist.php';</script>";
                }else
                {
                    echo "<script>alert('Slider not deleted successfully')</script>";
                    echo "<script>window.location = 'slider.php';</script>";
                }
            }
        ?>
