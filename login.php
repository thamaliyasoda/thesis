<?php
$error_message ="";
include "functions/db_con.php";
IF(ISSET($_POST['login'])){
	
	$username = mysqli_real_escape_string($conn, $_POST["username"]);  
	$password = mysqli_real_escape_string($conn, $_POST["password"]);  
	$result = $conn->query("SELECT * FROM users WHERE user_name='$username'");
	IF($result->num_rows > 0)
	{
		$row = mysqli_fetch_assoc($result);
		//echo $row['status'];
		if($row['status'] > 0)
		{
			List($stored_pw, $stored_salt) = explode('$', $row['password']);
			if($stored_pw == sha1($password.$stored_salt)) 
			{
				$sql = "INSERT INTO login_records (record_user) VALUES ( '".$row['user_id']."')";
				mysqli_query($conn, $sql) or die("database error: ". mysqli_error($conn));

				$sql = "SELECT * FROM system_info ORDER BY sysinfo_id DESC LIMIT 1";
				$sys_result = mysqli_fetch_assoc($conn->query($sql));				
				session_start();
				$_SESSION['username'] = $row['user_name'];
				$_SESSION['name'] = $row['full_name'];
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_level'] = $row['user_level'];
				$_SESSION['sys_version'] = $sys_result['info_version'];
				$_SESSION['sys_client'] = $sys_result['info_client'];
				if($row['user_level']==3)
				{
					$_SESSION['user_home'] = "admin_dashboard.php";
					
					header("location:admin_dashboard.php"); 

				}
				else if($row['user_level']==2)
				{
					$_SESSION['user_home'] = "student_dashboard.php";
					
					header("location:student_dashboard.php"); 

				}
				else
				{
					$_SESSION['user_home'] = "visitor_dashboard.php";
				
					header("location:visitor_dashboard.php"); 
				}
			}
			else
			{
				$error_message = "Invalid user name or password. Try again";
			}
		}
		else
		{
			$error_message ="Your account has not activated yet. Please try again later";
		}

	}
	else
	{
		$error_message = "Cannot find your account.Please check your username and password again";
	}
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | Login </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="images/kdmv.ico" type="image/x-icon"/>

<style>

body, html {

  height: 100%;
  margin: 0;
  font: 400 15px/1.8 "Lato", sans-serif;
  color: #777;
}


.bgimg{
   position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('images/home_cover.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
	  background-position: top;
    opacity: 0.2;
    filter:alpha(opacity=80);
}

.caption {
  position: center;
  width: 100%;
  text-align: center;
  color: #000;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  padding: 18px;
  font-size: 25px;
  letter-spacing: 10px;
}

h3 {
  letter-spacing: 3px;
  text-transform: uppercase;
  font: 25px "Lato", sans-serif;
  color: #fff;
}

		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
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

</style>
</head>

<body>
<div class="bgimg"></div>

	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/sports_logo.png" class="brand_logo" alt="Logo">
					</div>
								
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="login.php" method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username" required autofocus>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password" required >
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
						<div class="form-group">
							<label style="color:red;" id="error_msg" ><?php echo $error_message; ?></label><br/>
							<button type="submit" name="login" class="btn login_btn">Login</button>
						</div>
					</form>
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
					
				</div>
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="register.php" class="ml-2">Register</a>
					</div>

				</div>
			</div>
		</div>
	</div>

</body>
</html>

