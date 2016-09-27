<html>
	<head>
		<title></title>
		<style>
		div {
			border: 3px solid rgb(179, 176, 230);
			border-radius: 0px 20px;
			border-left-width: 0px;
			border-top-width: 0px;
			padding: 15px;
			margin: auto;
			position: relative;
			width: 40%;
			margin-top: 2%;
			line-height: 15px;
			font-size: 14px;
			background: -webkit-linear-gradient(bottom, #4e63ca, #f3f3f3 300px);
			font-family: Tahoma, Geneva, sans-serif;
		}
		.input {
			border: 2px solid #b3b0e6;
			border-radius: 0px 5px;
			width: 100%;
			height: 30px;
			padding: 10px;
			background: rgb(251, 251, 251);
		}
		#submit{
			    border: 2px solid #b3b0e6;
				border-radius: 0px 5px;
				height: 30px;
				background: rgb(251, 251, 251);
				font-weight: bold;
				width:150px;
					}
		</style>
	</head>
	<body>
		<div>
			<?php
			    
				echo form_open('social_service/register');
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