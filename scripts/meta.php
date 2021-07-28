<?php
		if(isset($_GET['pageid']))
		{
			$pagetitleid= $_GET['pageid'];
			$query = "SELECT * FROM tbl_page where id = '$pagetitleid'";
			$pages = $db->select($query);
			// starting if condition
			if($pages)
			{
				while($result=$pages->fetch_assoc())  {?>
				<title><?php echo $result['name']." - ".TITLE; ?></title>
		<?php }}}
		// elseif condition
		elseif(isset($_GET['id']))
		{
			$postid= $_GET['id'];
			$query = "SELECT * FROM tbl_post where id = '$postid'";
			$post = $db->select($query);
			if($post)
			{
				while($result=$post->fetch_assoc())  { ;?>
				<title><?php echo $result['title']." - ".TITLE; ?></title>
		<?php }}}
		// End elseif condition
		
			// Begining else condition
			else{?>
					<title><?php echo $fm->title()." ".TITLE; ?></title>
				<?php }; ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
	if(isset($_GET['id']))
	{
		$keywordid = $_GET['id'];
		$query = "SELECT * FROM tbl_post where id = '$keywordid'";
		$keywords = $db->select($query);
		if($keywords)
		{
			while($keyresult = $keywords->fetch_assoc())
			{ 
?>
				<meta name="keywords" content="<?php echo $keyresult['tags']; ?>">
<?php 		}
		}	
	}else
		{?>
			<meta name="keywords" content="<?php echo KEYWORDS; ?>">
<?php	}
			
?>
	<meta name="author" content="Delowar">	