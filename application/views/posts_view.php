

<html>
	<head>
		<title></title>
		<style>
			.div {
				border: 3px solid rgb(179, 176, 230);
				border-radius: 0px 20px;
				border-left-width: 0px;
				border-top-width: 0px;
				padding: 15px;
				margin: auto;
				position: relative;
				width: 40%;
				margin-bottom:20px;
				margin-top:20px;
				line-height: 15px;
				font-size: 14px;
				background: -webkit-linear-gradient(bottom, #4e63ca, #f3f3f3 300px);
				font-family: Tahoma, Geneva, sans-serif;
			}
			.input {
				border: 2px solid #b3b0e6;
				border-radius: 0px 5px;
				width: 74%;
				height: 30px;
				padding: 10px;
				background: rgb(251, 251, 251);
				display:inline;
				float:left;
			}
			.submit{
					border: 2px solid #b3b0e6;
					border-radius: 0px 5px;
					height: 30px;
					background: rgb(251, 251, 251);
					font-weight: bold;
					width:150px;
						}
			textarea {
					width: 100%;
					height: 100px;
					padding: 10px 20px;
					box-sizing: border-box;
					border: 2px solid #b3b0e6;
					border-radius: 0px 5px;
					background-color: #f8f8f8;
					resize: none;
					
					
			}
			form_close{
				display:inline;
				
			}
			
			#hr{
				width:40%;
			}
			.text{
				margin-left:10px;
			}
			
			.time{
				float:right;
				
			}
			#top_div{
				margin-bottom:20px;
			}
			#logout{
				float:right;
			}
			form{
				display:inline;
			}
			#delete{
				height: 25px;
				width:100px;
				float:right;
			}
			#comment{
				width: 25%;
				margin-left:1%;
			}
			.comments{
				border: 2px solid #b3b0e6;
				border-radius: 0px 5px;
				padding:1px;
				margin:10px;
			}
			.text_comment{
				margin-left:10px;
				margin-top:3px;
				margin-bottom:3px;
			}
		</style>
	</head>
	<body>
	<!--div information and text area field -->
		<div id="top_div" class="div">
		<h3>User name : <?php echo $this->session->name;?> </h3>
		<h3>Email : <?php echo $this->session->email;?></h3>
		<hr style="width:70%;">
			<?php
				echo form_open('social_service/post');
			?>
				<h3>Enter your post :</h3>
				<textarea rows="4" name="post" required ></textarea>
				<br/>
				<br/>
				<input class="submit" value="Enter post" type="submit" >
			<?php
				echo form_close();
			?>
			
			<?php
				echo form_open('social_service/log_out');
			?>
				<input id="logout" class="submit" value="LogOut" type="submit" >
			<?php
				echo form_close();
			?>
			
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
						echo form_open('social_service/delete/'.$data_item['id']);
					?>
						<input id="delete" class="submit" value="Delete" type="submit" >
						<br>
						<br>
					<?php
						echo form_close();
				}
				?>
				
				<h5 class="text  time"><?php echo $data_item['time']?></h5>
				<h2 class="text "><?php echo $data_item['name'] ?>:</h2>
				<h4 class="text">"<?php echo $data_item['post'] ?>"</h4>
				
				<!--comments div -->
				<div>
					<?php
						echo form_open('social_service/comment/'.$data_item['id']);
					?>
						<input name="comment" class="input" required type="text" >
						<input id="comment" class="submit" value="Add Comment" type="submit" >
					<?php
						echo form_close();
					?>
				</div>
				<!-- print comments to every post -->
				
					<?php foreach ($comments as $comment):
						if($comment['post_id'] == $data_item['id'])
						{
							?>
							<div class="comments">
							<h5 class="text_comment  time"><?php echo $comment['time']?></h5>
							<h3 class="text_comment"><?php echo $comment['name'] ?></h3>
							<h4 class="text_comment">"<?php echo $comment['comment'] ?>"</h4>
							</div>
							<?php
						}
						else
						{
							
						}
						endforeach;
					?>
			</div>
			
			<hr id="hr">
			
		<?php endforeach ?>
						
	</body>
</html>