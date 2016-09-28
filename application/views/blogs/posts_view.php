

<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="http://[::1]/test-ITG/CodeIgniter/Social-service-task/css/posts.css">

	</head>
	<body>
	<!--div information and text area field -->
		<div id="top_div" class="div">
		<h3>User name : <?php echo $this->session->name;?> </h3>
		<h3>Email : <?php echo $this->session->email;?></h3>
		<!--Logout button -->
			<?php
			echo form_open('PlogsController/logOut');
			?>
				<input id="logout" class="submit" value="LogOut" type="submit" >
			<?php
			echo form_close();
			?>
			<br>
			<br>
		<hr style="width:70%;">
			<?php
			echo form_open('PlogsController/post');
			?>
				<h3>Enter your post :</h3>
				<textarea rows="4" name="post" required ></textarea>
				<br/>
				<br/>
				<input class="submit" value="Enter post" type="submit" >
			<?php
			echo form_close();
			?>
			<br>
			<br>
			<hr id="hr">
			<br>
			<!--Upload button -->
			<?php
			echo form_open_multipart('PlogsController/upload_image');
			?>
				<label class="custom-file-upload">
					<input type="file" name="image"/>
					Choose Image ...
				</label>
				<input  class="submit" value="Upload Image" type="submit" >
			<?php
			echo form_close();
			?>
			
			<!--validation_errors -->
			<h4 style="color:#9e0f0f;">
			<?php
			echo validation_errors(); 
			?>
			</h4 >
			
		</div>
		<!--posts -->
		<?php
			 foreach ($posts as $data_item): ?>
			<div class="div">
			    <!--delete button -->
				<?php
				if($data_item['user_id'] ==  $this->session->id)
				{
						echo form_open('PlogsController/deletePost/'.$data_item['id'].'/'.$data_item['user_id']);
					?>
						<input id="delete" class="submit" value="Delete" type="submit" >
						<br>
						<br>
					<?php
						echo form_close();
				}
				?>
				<!--/delete button -->
				<!--post data -->
				<h5 class="text  time"><?php echo $data_item['time']?></h5>
				<h2 class="text "><?php echo $data_item['name'] ?>:</h2>
				<!--post text or image -->
				<?php 
					if($data_item['check_image'] == 0){
						?><h4 class="text">"<?php echo $data_item['post'] ?>"</h4><?php
					}
					else{
						?><center>
							<img border="0" src="http://localhost/test-ITG/CodeIgniter/Social-service-task/uploads/images/
							<?php echo $data_item['image'];?>" 
							style="width: 400px;height: 300px;margin-bottom: 10px;">
						</center>
						<?php
					}
				?>
				<!--/post data -->
				<!--comments div -->
				<div>
					<?php
						echo form_open('PlogsController/comment/'.$data_item['id']);
					?>
						<input name="comment" class="input" required type="text" >
						<input id="comment" class="submit" value="Add Comment" type="submit" >
					<?php
						echo form_close();
					?>
				</div>
				<!--/comments div -->
				<!-- print comments to every post -->
				
					<?php foreach ($comments as $comment):
						if($comment['post_id'] == $data_item['id'])
						{
							?>
							<div class="comments">
								<h5 class="text_comment  time"><?php echo $comment['time']?></h5>
								<h3 class="text_comment"><?php echo $comment['name'] ?></h3>
								<h4 class="text_comment">"<?php echo $comment['comment'] ?>"</h4>
								<!--delete button -->
								<?php
								if($comment['user_id'] ==  $this->session->id)
								{
										echo form_open('PlogsController/deleteComment/'.$comment['id'].'/'.$comment['user_id']);
									?>
										<input id="delete" class="submit" value="Delete" type="submit" >
										<br>
										<br>
									<?php
										echo form_close();
								}
								?>
								<!--/delete button -->
							</div>
							
							<?php
						}
						else
						{
							
						}
						endforeach;
					?>
					<!-- /print comments to every post -->
			</div>
			
			<hr id="hr">
			
		<?php endforeach ?>
						
	</body>
</html>