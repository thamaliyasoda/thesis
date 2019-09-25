<?php 
session_start();

$error_message ="";
$success_msg = "";
	include "functions/db_con.php";
if(isset($_POST['submit']))
{
	$name = $conn->real_escape_string($_POST['name']);	
	$userEmail = $conn->real_escape_string($_POST['email']);
	$userPassword = $conn->real_escape_string($_POST['password']);
	$salt = sha1(getRandomSalt());
	$digest = sha1($userPassword.$salt).'$'.$salt;	
	if(isset($_POST['std_no']))
	{
		$user_id = $_POST['std_no'];
		$status = 1;

		$sql="UPDATE users SET user_name = '".$userEmail."', full_name ='".$name."', password='".$digest."', status =1 WHERE user_id=$user_id";
		$conn->query($sql);
		$success_msg ="You have registered successfully! please <a href='login.php'>Login</a> now";		
	}
	else
	{
		$sql = "SELECT user_id FROM users WHERE user_name='".$userEmail."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			$error_message ="Sorry!, you have already registered with this email address";
		}
		else
		{
			//password encryption
			//https://stackoverflow.com/questions/7063205/md5-salt-login-system
			$salt = sha1(getRandomSalt());
			$digest = sha1($userPassword.$salt).'$'.$salt;
			$status = 0;
			$user_number = 'null';

			$sql="INSERT INTO users (user_name, full_name, password, user_level, status,user_number) VALUES ('".$userEmail."','".$name."', '".$digest."', '".$_POST['usertype']."','".$status."','".$user_number."')";
			$conn->query($sql);
			$success_msg ="You have registered successfully! please <a href='login.php'>Login</a> now";

		}
	}
}

function getRandomSalt() {
     $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
     $randStringLen = 32;

     $randString = "";
     for ($i = 0; $i < $randStringLen; $i++) {
         $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
     }

     return $randString;
}

 $empResult  = $conn->query("SELECT * FROM users WHERE status=0 AND user_level = 2 ");

		if ($empResult->num_rows > 0) 
		{
			 $stds="<option hidden disabled selected value> --Select your student number-- </option>";
			 while($us = mysqli_fetch_array($empResult )) 
			 {$stds.= '<option   value="'.$us[0].'">'.$us[3].'</option>';}
		}
		else{
			$stds="<option hidden disabled selected value> No students to register</option>";
		}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | Register </title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="images/kdmv.ico" type="image/x-icon"/>
<style>

body, html {
	    background-image: linear-gradient(45deg, rgb(54, 54, 55), rgb(91, 93, 131), rgb(54, 120, 150),rgb(54, 54, 55));
    background-repeat: no-repeat;
	    background-opacity: 0.2;
  height: 120%;
  margin: 0;
  font: 400 15px/1.8 "Lato", sans-serif;
  color: #777;
}

		.user_card {
			width: 100%;
			margin-top: 80;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: white;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			
		}
		.form_container {
			margin-top: 20px;
		}
		.title_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
h3 {
  letter-spacing: 3px;
  text-transform: uppercase;
  font: 25px "Lato", sans-serif;
  color: #fff;
}

</style>
<script type="text/javascript">	

	function displayStudentNumber(level) 
	{
		var x = (level.value || level.options[level.selectedIndex].value); 		
		if(x == 2)
		{						
			document.getElementById("number_div").innerHTML = '<label for="student_number" class="col-sm-4 col-form-label">Student Number</label><div  class="col-sm-8"><select name="std_no" id="std_no" class="form-control" required data-live-search="true"><?php echo $stds ?></select></div><div id="number_error" name="file_error" style="color:red;" class="help-block with-errors "></div>'
		}
		else{
			document.getElementById("number_div").innerHTML = '';
		}
	}
</script>

</head>
<body>
<div class="container">
	<div class="col-sm-6 mx-auto d-flex justify-content-center h-100">
		<div class="user_card ">
			<div class="d-flex justify-content-center">
				<div class="brand_logo_container">
					<img src="images/sports_logo.png" class="brand_logo" alt="Logo">
				</div>
			</div>
			<div class="d-flex justify-content-center title_container">
				<h3>Registration</h3><br/>
			</div>
			<div class="d-flex justify-content-center" ><label style="color:red;" id="error_msg" ><?php echo $error_message; ?></label><label style="color:green;" id="success_msg" ><?php echo $success_msg; ?></label></div>
		<div class="d-flex justify-content-center form_container">

			<form class="form-horizontal justify-content-center" role="form" method="post" action="register.php" data-toggle="validator" enctype="multipart/form-data" >
				<div class="form-group required row">
					<label for="username" class="col-sm-4  col-form-label">Register As</label>
					<div  class="col-sm-8">

						<select required class="input-md textinput form-control" id="usertype" name="usertype" onchange="displayStudentNumber(this)" >
						  <option value="1">Visitor</option>
						  <option value="2">Student</option>
						  <option value="3">Administrator</option>
						</select>
					</div>
					<div style="color:red;" class="help-block with-errors"></div>
				</div>
				<div class="form-group required row" id="number_div" name="number_div" >
				
				</div>
				<div  class="form-group required row">
					<label for="name" class="col-sm-4 col-form-label">Name</label>
					<div  class="col-sm-8">
						<input required type="text" class="input-md textInput form-control" id="name" name="name" placeholder="Your full name" value="">
					</div>
					<div style="color:red;" class="help-block with-errors"></div>
				</div>
				<div  class="form-group required row">
					<label for="email" class="col-sm-4  col-form-label">Email (Username)</label>
					<div  class="col-sm-8">
						<input required type="email" class="input-md  textinput textInput form-control" id="email" name="email" placeholder="example@domain.com" value="">
					</div>
					<div style="color:red;" class="help-block with-errors"></div>
				</div>
				<div class="form-group required row">
					<label for="password" class="col-sm-4  col-form-label">Password</label>
					<div  class="col-sm-8">
						<input required data-minlength="5" type="password" class="input-md  textinput textInput form-control" id="password" name="password" placeholder="Your password" value="">
					</div>
					<div style="color:red;" class="help-block with-errors"></div>
				</div>
				<div class="form-group required row">
					<label for="confirm_password" class="col-sm-4  col-form-label">Confirm Password</label>
					<div  class="col-sm-8">
						<input type="password" required data-match="#password" data-match-error="Whoops, these don't match"  class="input-md  textinput textInput form-control" id="confirm_password" name="confirm_password" placeholder="confirm your password" value="">
					</div>
					<div style="color:red;" class="help-block with-errors "></div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 text-center">
						<input  id="submit" name="submit" type="submit" value="Register" class="btn btn-primary">
						<a  href="login.php"  class="btn btn-success">Login</a>
					</div>
				</div>
			</form>
        </div>
        </div>
		</div>
</div>
<br/>
</body>
</html>
<script language="javascript">
$(document).ready(function() 
	{
		$("#submit").click(function() 
		{

			var letter = $('#letter').val();
			if(letter=='')
			{
				$('#file_error').html('<span id="vl_transport_id" style="color:#FF0000" >Please select a file</span>');
				return false;
			}
		});
		
	});
</script>