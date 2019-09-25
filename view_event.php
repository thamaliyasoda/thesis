<?php 
session_start();
IF(ISSET($_SESSION['username']))
{
	include "functions/db_con.php";	
	$success_msg ="";
	$logged_user = $_SESSION['username'];
	$loggeduser_id = $_SESSION['user_id'];

	if (!isset($_GET['id'])) 
	{
		header("location:".$_SESSION['user_home']); 
	}
$evid = $_GET['id'];
	if(isset($_POST['add_award_sbmt']))
	{
		$award_title = $_POST['award_title'];
		$award_description = $_POST['award_description'];

		$insert = $conn->query("INSERT INTO event_awards (event_id, award_title,award_description,created_by) VALUES ('$evid','$award_title','$award_description',$loggeduser_id)");

		$success_msg ="<label style='color:green;font-size:15px' id='success_msg' >You have added new award successfully! </label>";

	}
	
	if(isset($_POST['std_apply']))
	{
			$result = $conn->query("SELECT student_id FROM students WHERE user_id=$loggeduser_id");
			IF($result->num_rows > 0)
			{
				$row = mysqli_fetch_assoc($result);
				$sql="Insert INTO students_to_events_map (students_id,event_id,requested_by) VALUES (".$row['student_id'].",$evid,$loggeduser_id)";
				$conn->query($sql);
				$success_msg ="<label style='color:green;font-size:15px' id='success_msg' >You have applied for the event successfully! </label>";
				
			}
			ELSE
			{
				$success_msg = "<label style='color:red; font-size:15px' id='success_msg' > You are not a student, you cannot apply! </label>";					
			}
			
	}		


$userresults = $conn->query("SELECT
*
FROM
sports_events
WHERE
event_id = $evid ");
$event = mysqli_fetch_assoc($userresults);


	$tablebody ="";
$stdResult  = $conn->query("SELECT
users.user_id,
users.user_name,
users.full_name,
users.user_number,
students.student_grade,
students.student_id,
students.student_address,
users.profile_pic
FROM
students
INNER JOIN users ON users.user_id = students.user_id
INNER JOIN students_to_events_map ON students.student_id = students_to_events_map.students_id
WHERE
users.`status` = 1 AND
students_to_events_map.event_id = $evid AND
students_to_events_map.request_status > 1");
if(mysqli_num_rows($stdResult ) > 0)
{
	while($students = mysqli_fetch_array($stdResult ))
	{
		$tablebody .='  <tr>
						<td>
							<img class="avatar rounded-circle" height="55" src="images/profiles/'.$students['profile_pic'].'"  />		
						</td>
						<td>'.$students['user_number'].'</td>
                        <td><a href="view_student.php?std='.$students['student_id'].'" >'.$students['full_name'].'</a></td>
						<td>'.$students['student_grade'].'</td>
                    </tr>';
	}
}
else
{
		$tablebody =" No students have allocated to the event";
}

$awardtablebody ="";
$awardResult  = $conn->query("SELECT * FROM event_awards
WHERE
event_id =$evid AND award_status = 1");
if(mysqli_num_rows($awardResult ) > 0)
{
	while($award = mysqli_fetch_array($awardResult ))
	{
		$awardtablebody .='  <tr>
						<td>'.$award['award_title'].'</td>
						<td>'.$award['award_description'].'</td>
                    </tr>';
	}
}
else
{
		$awardtablebody =" No awards have allocated to the event";
}

$relatedsportsbody ="";
$relatedsportsResult  = $conn->query("SELECT
sports.sport_name,
sports.sport_id,
sports.sport_category,
sports.age_category,
sports.sport_year,
sports.sport_picture
FROM
sports_to_events_map
INNER JOIN sports ON sports_to_events_map.sports_id = sports.sport_id
WHERE
sports.sports_status = 1 AND
sports_to_events_map.event_id = $evid AND
sports_to_events_map.map_status = 1");
if(mysqli_num_rows($relatedsportsResult ) > 0)
{
	while($sports = mysqli_fetch_array($relatedsportsResult ))
	{
		$relatedsportsbody .='  <tr>
						<td>
							<img class="avatar rounded-circle" height="35" src="images/sports/'.$sports['sport_picture'].'"  />		
						</td>
						 <td>'.$sports['sport_category'].'</td>
						<td>'.$sports['sport_name'].'</td>
						<td>'.$sports['age_category'].' - '.$sports['sport_year'].'</td>
                    </tr>';
	}
}
else
{
		$relatedsportsbody =" No sports have allocated to the event";
}


$instructtablebody ="";
$instructResult  = $conn->query("SELECT
instructors.instructor_id,
instructors.instructor_name,
instructors.instructor_field,
instructors.instructor_pic
FROM
instructors
INNER JOIN instructors_to_events_map ON instructors_to_events_map.instructor_id = instructors.instructor_id
WHERE
instructors_to_events_map.event_id = $evid AND
instructors_to_events_map.map_status = 1");
if(mysqli_num_rows($instructResult ) > 0)
{
	while($instruct = mysqli_fetch_array($instructResult ))
	{
		
		$instructtablebody .='<tr > 
						<td>
							<img class="avatar rounded-circle" height="35" src="images/profiles/'.$instruct['instructor_pic'].'"  />		
						</td>
                        <td>'.$instruct['instructor_name'].'</td>
						<td> '.$instruct['instructor_field'].'</td>
                    </tr>';
	}
}	
else
{
		$instructtablebody =" No instructors  have allocated to the event";
}
?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | <?=$event['event_title']; ?></title>
<link rel="shortcut icon" href="images/kdmv.ico" type="image/x-icon"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>	  
        <link rel="stylesheet" href="style/style4.css">



<style type="text/css">

    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #762c82;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }

	table.table tr th:last-child {
		width: 150px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
	table.table td a.view {
        color: #1864AB;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 800px;
	}

	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}
	
			.upload-preview {border-radius:4px;width: 150px;height: 150px;}
		#body-overlay {z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
		#body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
		#targetOuter{	
			position:relative;
			text-align: center;

			margin: 20px auto;
			width: 150px;
			height: 150px;
			border-radius: 4px;
		}
		#targetOuter2{	
			position:relative;
			text-align: center;

			margin: 20px auto;
			width: 150px;
			height: 150px;
			border-radius: 4px;
		}
		.inputFile{
			margin-top: 0px;
			left: 0px;
			right: 0px;
			top: 0px;
			width: 150px;
			height: 36px;
			background-color: #FFFFFF;
			overflow: hidden;
			opacity: 0;
			position: absolute;
			cursor: pointer;
		}
		.icon-choose-image {
			position: absolute;
			cursor:pointer;
			
		}
		#profile-upload-option{
			display:none;
			position: absolute;
			top: 92px;
			left: 24px;
			margin-top: -24px;
			margin-left: -24px;
			border: #d8d1ca 1px solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			width: 150px;
		}
				#profile-upload-option2{
			display:none;
			position: absolute;
			top: 92px;
			left: 24px;
			margin-top: -24px;
			margin-left: -24px;
			border: #d8d1ca 1px solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			width: 150px;
		}
		.profile-upload-option-list{
			margin: 1px;
			height: 25px;
			border-bottom: 1px solid #cecece;
			cursor: pointer;
			position: relative;
			padding:5px 0px;
		}
		.profile-upload-option-list:hover{
			background-color: #0AA3E4;
		}
</style>

</head>

<body>
<div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>SPORTS DESK</h3>
                    <strong>SD</strong>
                </div>

                 <ul class="list-unstyled components">
					<li >
                        <a href="<?=$_SESSION['user_home']; ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
					<?php if($_SESSION['user_level'] == 3 || $_SESSION['user_level'] == 2 ){ ?>
                    <li >
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-user-graduate"></i>
                            Students
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li ><a href="student_list.php"><i class="fas fa-users"></i>Student List</a></li>
                            <li><a href="student_achievments.php"><i class="fas fa-award"></i>Student Achievements</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="instructors_list.php">
                            <i class="fas fa-user-tie"></i>
                            Instructors
                        </a>
					</li>
					<?php }?>
					 <li>
					    <a href="sports_list.php">
                            <i class="fas fa-volleyball-ball"></i>
                            Sports
                        </a>
                    </li>
                    <li class="active">
                        <a href="events_list.php">
                            <i class="fas fa-calendar-day"></i>
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="practice_sessions_list.php">
                            <i class="fas fa-walking"></i>
                            Practices
                        </a>
                    </li>
					<?php if($_SESSION['user_level'] == 3){ ?>
                    <li >
						<a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-chart-pie"></i>
                             Reports
                        </a>
                        <ul class="collapse list-unstyled" id="reportSubmenu">
                            <li><a href="report_students_per_sport.php"><i class="fas fa-users"></i>Students Per Sports</a></li>
                            <li><a href="report_events_per_month.php"><i class="fas fa-calendar-day"></i>Events per Month</a></li>
							<li><a href="report_schedule_for_time_period.php"><i class="fas fa-calendar-alt"></i>Schedule For a Duration</a></li>
							<li><a href="report_compare_students.php"><i class="fas fa-not-equal"></i>Compare Students</a></li>
                        </ul>
                    </li>
					<?php }?>
                </ul>

                <ul class="list-unstyled CTAs">
                     <img src="images/logo_long.png"  height="65"  alt="">
					 <center><?php echo $_SESSION['sys_version'];?>v
					 <p><?php echo $_SESSION['sys_client'];?></p></center>
                </ul>
            </nav>

	<!-- Page Content Holder -->
	<div class="col-lg" id="content">	
		<nav class="navbar navbar-default">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" id="sidebarCollapse" class="btn btn-sm btn-dark navbar-btn">
						 <i class="fas fa-compress"></i>
						<span>Toggle Sidebar</span>
					</button>
				</div>
				<div class="d-flex justify-content-center">
				 						<?php
				echo $success_msg;
				?>
				</div>
<div class="d-flex justify-content-right"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out <span class="sr-only">(current)</span></a><a href="#" class="btn btn-sm btn-dark navbar-btn" onclick="history.back()" ><i class="fas fa-arrow-left"></i> <span> Back</span></a></div>

			</div>
		</nav>		

		<div class="row">
			<div class="col-sm-12">
				<div class="card-rows">
					<div class="card border-success">
						<div class="card-body ">
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h2><b><?=$event['event_title']; ?></b></h2>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><?= 'From: '.date( 'd-M-y g:i A', strtotime($event['event_start_datetime']) ).'  To: '.date( 'd-M-y g:i A', strtotime($event['event_end_datetime']) ); ?></h4>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?= 'at: '.$event['event_location']; ?></b></h4>																
								</div>
							</div>		
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h6><?=$event['event_description']; ?></h6>																
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<?php if($_SESSION['user_level'] == 2){ ?>	<a href="#applyStudentModal" class="btn btn-primary" data-toggle="modal"><i class="fas fa-volleyball-ball"></i>  <span>Request to Join</span></a>	<?php }?>																													
								</div>
							</div>							
						</div>						
					</div>	
				</div>
			</div>	
		</div>			
				<br/>
		<div class="row">
			<div class="col-sm-12">			
				
				<div class="row">
					<div class="col-sm-6">
					<div class="card">
						<div class="card border-primary">
							<div class="card-body ">
								<div class="row">
									<div class="col-sm-6">
										<h3><b>Allocated Students</b></h3>
									</div>
									<div class="col-sm-6 text-right">
											<?php if($_SESSION['user_level'] == 3){ ?>	<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-user-graduate"></i>  <span>Manage Related Students</span></a><?php }?>					
														
									</div>
								</div>
								<div class="row">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>
													
												</th>
												<th>Number</th>
												<th>Name</th>
												<th>Grade</th>
											</tr>
										</thead>

										<tbody>

											<?php echo $tablebody; ?>

										</tbody>

									</table>
								</div>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
						<div class="col-sm-12">
						<div class="card">
							<div class="card border-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-sm-5">
											<h3><b>Instructors</b></h3>
										</div>
										<div class="col-sm-7 text-right">
												<?php if($_SESSION['user_level'] == 3){ ?>	<a href="#addInstructorModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-user-tie"></i>  <span>Manage Related Instructors</span></a>	<?php }?>			
															
										</div>
									</div>
									<div class="row">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th></th>
													<th>Name</th>
													<th>Field</th>
												</tr>
											</thead>

											<tbody>

												<?php echo $instructtablebody; ?>

											</tbody>

										</table>
									</div>
								</div>
							</div>
							</div>
							</div>
						</div>
						<br/>
						<div class="row">
						<div class="col-sm-12">
						<div class="card">
							<div class="card border-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-sm-6">
											<h3><b>Related Sports</b></h3>
										</div>
										<div class="col-sm-6 text-right">
										<?php if($_SESSION['user_level'] == 3){ ?>	<a href="#addSportsModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-volleyball-ball"></i>  <span>Manage Related Sports</span></a>	<?php }?>					
															
										</div>
									</div>
									<div class="row">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th></th>
													<th>Title</th>
													<th>Category</th>
													<th>Group</th>
												</tr>
											</thead>

											<tbody>

												<?php echo $relatedsportsbody; ?>

											</tbody>

										</table>
									</div>
								</div>
							</div>
							</div>
							</div>
						</div>
						<br/>
						<div class="row">
						<div class="col-sm-12">
						<div class="card">
							<div class="card border-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-sm-6">
											<h3><b>Awards</b></h3>
										</div>
										<div class="col-sm-6 text-right">
												<?php if($_SESSION['user_level'] == 3){ ?>	<a href="#addAwardModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-award"></i>  <span>Manage Related Awards</span></a><?php }?>					
															
										</div>
									</div>
									<div class="row">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>Award Title</th>
													<th>Description</th>
												</tr>
											</thead>

											<tbody>

												<?php echo $awardtablebody; ?>

											</tbody>

										</table>
									</div>
								</div>
							</div>
							</div>
							</div>
						</div>						
					</div>
					</div>
			
					</div>
				</div>				
	</div>


</div>
		<!-- add students Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addstudentModelDIV" class="modal-content">
			</div>
		</div>
	</div>
		<!-- add instructor Modal HTML -->
	<div id="addInstructorModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addinstructorModelDIV" class="modal-content">
			</div>
		</div>
	</div>	
		<!-- add sport Modal HTML -->
	<div id="addSportsModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addSportsModelDIV" class="modal-content">
			</div>
		</div>
	</div>	
		<!-- add award Modal HTML -->
	<div id="addAwardModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addAwardModelDIV" class="modal-content">
			</div>
		</div>
	</div>

	<!-- Apply Modal HTML -->
	<div id="applyStudentModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Apply for the Event</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div id="dele_std_sec" class="modal-body">					
						<p>Are you sure you want to Apply for this Event?</p>
						<p class="text-success"><small>Once you okay this action an administer will check and approve your request. You will be notified via eMail. </small></p>
						<div id="apply_std"></div>
					</div>

										
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="std_apply" class="btn btn-primary" value="Apply">
					</div>
				</form>
			</div>
		</div>

	</div>	
 <script type="text/javascript">
	 $(document).ready(function () {
		 $('#sidebarCollapse').on('click', function () {
			 $('#sidebar').toggleClass('active');
		 });
	 });
	 
	 	$('#addEmployeeModal').on('show.bs.modal', function(e) {
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_get_event_students.php",
		   data: {
			   event_id: <?= $evid; ?>
		   },
		   success: function(html) {
			   $("#addstudentModelDIV").html(html).show();
		   }
	   });
	});
	
	$('#addInstructorModal').on('show.bs.modal', function(e) {
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_get_event_instructors.php",
		   data: {
			   event_id: <?= $evid; ?>
		   },
		   success: function(html) {
			   $("#addinstructorModelDIV").html(html).show();
		   }
	   });
	});
	
	$('#addSportsModal').on('show.bs.modal', function(e) {
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_get_event_sports.php",
		   data: {
			   event_id: <?= $evid; ?>
		   },
		   success: function(html) {
			   $("#addSportsModelDIV").html(html).show();
		   }
	   });
	});	

		$('#addAwardModal').on('show.bs.modal', function(e) {
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_get_event_awards.php",
		   data: {
			   event_id: <?= $evid; ?>
		   },
		   success: function(html) {
			   $("#addAwardModelDIV").html(html).show();
		   }
	   });
	});
	
 function checkAll(tablename)
 {
     var table = document.getElementById (tablename);
     var checkboxes = table.querySelectorAll ('input[type=checkbox]');
     var val = checkboxes[0].checked;
     for (var i = 0; i < checkboxes.length; i++) checkboxes[i].checked = val;
 }

function get_selected_checkboxes_array()
{ 
	var ch_list=Array(); 
	$("input:checkbox[type=checkbox]:checked").each(function()
	{
		if($(this).val() != 'on')
		{
			ch_list.push($(this).val());
		}
	}); 
	return ch_list; 
}
	

function add_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_students.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Approved';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_row('+id+')" ><i class="fas fa-user-minus" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function remove_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_students.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           document.getElementById("status_row"+id).innerHTML= 'Removed from the Event';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="view" onclick="add_row('+id+')" ><i class="fas fa-user-plus" data-toggle="tooltip" title="Add student"></i></a>';

        }
    });
}

function approveAllSelectedStudents()
{
	var studentlist = get_selected_checkboxes_array();
	alert(studentlist);
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_students.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
		   //$("#addstudentModelDIV").html(response).show();
        }
    });
}	

function removeAllSelectedStudents()
{
	var studentlist = get_selected_checkboxes_array();
	alert(studentlist);
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_students.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
		   //$("#addstudentModelDIV").html(response).show();
        }
    });
}

function add_Instructors_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_instructors.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_row('+id+')" ><i class="fas fa-user-minus" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function include_Instructors_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_instructors.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'include'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_row('+id+')" ><i class="fas fa-user-minus" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function remove_Instructors_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_instructors.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           document.getElementById("status_row"+id).innerHTML= 'Removed from the Event';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="view" onclick="add_row('+id+')" ><i class="fas fa-user-plus" data-toggle="tooltip" title="Add student"></i></a>';

        }
    });
}

function approveAllSelectedInstructors()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_instructors.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
        }
    });
}	

function removeAllSelectedInstructors()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_instructors.php",
        data: {students : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
        }
    });
}

function add_Sports_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_sports.php",
        data: {sports : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_Sports_row('+id+')" ><i class="fas fa-minus-square" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function include_Sports_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_sports.php",
        data: {sports : jsonString, event_id: <?= $evid; ?>, action_type: 'include'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_Sports_row('+id+')" ><i class="fas fa-minus-square" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function remove_Sports_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_sports.php",
        data: {sports : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           document.getElementById("status_row"+id).innerHTML= 'Removed from the Event';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="view" onclick="add_Sports_row('+id+')" ><i class="fas fa-plus-square" data-toggle="tooltip" title="Add student"></i></a>';

        }
    });
}

function approveAllSelectedSports()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_sports.php",
        data: {sports : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
        }
    });
}	

function removeAllSelectedSports()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_sports.php",
        data: {sports : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           window.location = window.location.href.split("#")[0];
        }
    });
}

//awards
function add_Awards_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_Awards_row('+id+')" ><i class="fas fa-minus-square" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function insert_Awards_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'include'}, 
        cache: false,

        success: function(){
			document.getElementById("status_row"+id).innerHTML= 'Allocated';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="delete" onclick="remove_Awards_row('+id+')" ><i class="fas fa-minus-square" data-toggle="tooltip" title="Remove student"></i></a>';

        }
    });
}

function remove_Awards_row(id)
{
	var student = [id];
	var jsonString = JSON.stringify(student);
		$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           document.getElementById("status_row"+id).innerHTML= 'Removed from the Event';
			document.getElementById("action_row"+id).innerHTML= '<a href="#" class="view" onclick="add_Awards_row('+id+')" ><i class="fas fa-plus-square" data-toggle="tooltip" title="Add student"></i></a>';

        }
    });
}

function approveAllSelectedAwards()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'approve'}, 
        cache: false,

        success: function(){
          // document.location.reload(true);
		  window.location = window.location.href.split("#")[0];
		   
        }
    });
}	

function removeAllSelectedAwards()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'reject'}, 
        cache: false,

        success: function(){
           //document.location.reload(true);
		  window.location = window.location.href.split("#")[0];
        }
    });
}

function deleteAllSelectedAwards()
{
	var studentlist = get_selected_checkboxes_array();
	var jsonString = JSON.stringify(studentlist);
	$.ajax({
        type: "POST",
        url: "functions/ajax_update_event_awards.php",
        data: {awards : jsonString, event_id: <?= $evid; ?>, action_type: 'delete'}, 
        cache: false,

        success: function(){
           //document.location.reload(true);
		  window.location = window.location.href.split("#")[0];
        }
    });
}
	</script>
</body>
</html>
<?php 
}else
{
	header("location:login.php"); 
}
?>