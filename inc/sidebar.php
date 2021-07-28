<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
						<?php
						$query = "SELECT * FROM tbl_category";
						$category = $db->select($query);
						if($category)
						{
							while($result = $category->fetch_assoc())
							{ 
							;?>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']?></a></li>
						<?php }} else{?>

						<li><a href="#">No Category Created</a></li>
						<?php }?>					
					</ul>
			</div>
			<!-- tbl category end -->
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php
					$query = "SELECT * FROM tbl_post LIMIT 5";
					$post = $db->select($query);
					if($post)
					{
						while($result = $post->fetch_assoc())
						{ 
						;?>
				
				<div class="popular clear">
					<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
					<a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
					<p><?php echo $fm->textShorten($result['body']);?></p>	<!-- use text shorten method -->
				</div>

				<?php }} else{header('Location:404.php');}?>
			</div>
			<!-- tbl_post latest article end -->
			
		</div>