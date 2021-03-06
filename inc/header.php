<?php 
	include('config/config.php');
    include('lib/database.php');
    include('helpers/format.php');
?>
<?php 
	$db = new Database();
	$fm = new Format();
?>

<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  // Date in the past
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); 
//30days (60sec * 60min * 24hours * 30days)
?>
<!DOCTYPE html>
<html>
<head>
	
	<?php include 'scripts/meta.php'?>
	<?php include 'scripts/css.php'?>
	<?php include 'scripts/js.php'?>
	
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				<?php
					$query = "SELECT * FROM title_slogan where id ='1' ";
					$blog_title = $db->select($query);
					if($blog_title)
					{
						while($result = $blog_title->fetch_assoc())
						{ 
				?>
				<img src="admin/<?php echo $result['image'] ?>" alt="Logo"/>
				<h2><?php echo $result['title'] ?></h2>
				<p><?php echo $result['slogan'] ?></p>
				<?php }}?>
			</div>
		</a>
		<div class="social clear">
			<!-- Social menu -->
			<?php
                $query = "SELECT * FROM tbl_social where id ='1' ";
                $socail_media = $db->select($query);
                if($socail_media)
				{
                    while($result = $socail_media->fetch_assoc())
                    	{
                    ?>
			<div class="icon clear">
				<a href="<?php echo $result['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php }}?>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
		$path = $_SERVER['SCRIPT_FILENAME'];
        $current_page = basename($path, '.php'); 
	?>
	<ul>
		<!-- Menu high light -->
		<li><a
		<?php if($current_page == 'index'){echo "id='active'";} ?>
		
		href="index.php">Home</a></li>

		<!-- Other page menu highlight -->
		<?php
            $query = "SELECT * FROM tbl_page";
            $pages = $db->select($query);
            if($pages)
            {
                while($result=$pages->fetch_assoc())
                    {
            ?>
        <li><a <?php if(isset($_GET['pageid']) && $_GET['pageid']== $result['id'])
		{
			echo "id='active'";
		}?> 
		href="page.php?pageid= <?php echo $result['id']?>"><?php echo $result['name']?></a> </li>
        <?php }}?>

		<li><a
		<?php if($current_page == 'contact'){echo "id='active'";} ?> 
		href="contact.php">Contact</a></li>
		<!-- Contact menu highlight -->
	</ul>
</div>