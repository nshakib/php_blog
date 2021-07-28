<?php 
    include('inc/header.php');
?>
<?php 
	if(!isset($_GET['id']) || $_GET['id']== NULL)
	{
		header('Location:404.php');
	}else{
		$id = $_GET['id'];
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "SELECT * FROM tbl_post where id=$id";
					$post = $db->select($query);
					if($post)
					{
						while($result = $post->fetch_assoc())
						{ 
						;?>
				<h2><?php echo $result['title'];?></h2>
				<h4><?php echo $fm->formatDate($result['DATE']);?>, By <?php echo $result['author'];?></h4>
				
				<img src="admin/<?php echo $result['image'];?>" alt="post image"/>
				<p><?php echo ($result['body']);?></p>

				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$catid = $result['cat']; 
						$query = "SELECT * FROM tbl_post where cat='$catid' order by rand() LIMIT 6";
						$post = $db->select($query);
						if($post)
						{
							while($result = $post->fetch_assoc())
							{ 
							;?>
					<a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
					<?php }}else{echo "NO related post available !!";}?>
				</div>
				<?php }} else{header('Location:404.php');}?>
			</div>

		</div>
		<?php include('inc/sidebar.php'); ?>
		<?php include('inc/footer.php'); ?>