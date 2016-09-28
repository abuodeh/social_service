<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/register.css">

	</head>
	<body>
		<div>
			<?php
			    
				echo form_open('UsersController/register');
			?>
			<h3>User Name </h3>
			<input name="name" class="input" type="text" placeholder="Please Enter your name" >
			<h3>Email </h3>
			<input name="email" class="input" type="email" placeholder="Please Enter your Email" >
			<h3>Password </h3>
			<input name="password" class="input" type="password" >
			<br/>
			<br/>
			<center>
			<input id="submit"value="Register" type="submit" >
			</center>
				
			<?php
				echo form_close();
			?>
			<h4 style="color:#9e0f0f;">
			<?php
			echo validation_errors(); 
			?>
			
			</h4 >
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