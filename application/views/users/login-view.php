<html>
	<head>
		<title></title>
		<?php $this->load->helper('url'); ?>
		<link rel="stylesheet" type="text/css" href="http://[::1]/test-ITG/CodeIgniter/Social-service-task/css/login.css">
	</head>
	<body>
		<div>
			
			<?php
			    
				echo form_open('UsersController/login');
			?>
			<h3>Email </h3>
			<input name="email" class="input" type="email" placeholder="Please Enter your Email" >
			<h3>Password </h3>
			<input name="password" class="input" type="password" >
			<br/>
			<br/>
			<center>
			<input id="submit"value="Login" type="submit" >
			</center>
			
			<?php
				echo form_close();
			?>
			<?php
				echo form_open('UsersController/registerView');
			?>
			<center>
			<input id="submit"value="Sign Up" type="submit" >
			</center>
			<?php
				echo form_close();
			?>
			
			<h4 style="color:#9e0f0f;">
			<?php
			echo validation_errors(); 
			?>
			</h4>
			<h4><u>
			<?php 
				if(isset($note)){
					 echo $note; 
				}
			?>
			</u></h4>
		</div>
	</body>
</html>