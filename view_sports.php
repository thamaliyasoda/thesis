<?php 
session_start();
IF(ISSET($_SESSION['username']))
{
	include "functions/db_con.php";	
	$success_msg ="";
	$logged_user = $_SESSION['username'];
	$loggeduser_id = $_SESSION['user_id'];

	if (!isset($_GET['spt'])) 
	{
		header("location:".$_SESSION['user_home']); 
	}
	else{

		$spid = $_GET['spt'];
		$userresults = $conn->query("SELECT
		*
		FROM
		sports
		WHERE
		sport_id = $spid ");
		$sports = mysqli_fetch_assoc($userresults);
	}

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
INNER JOIN students_to_sports_map ON students_to_sports_map.student_id = students.student_id
WHERE
users.`status` = 1 AND students_to_sports_map.map_status = 1 AND
students_to_sports_map.sports_id =$spid");
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
		$tablebody =" No students have allocated to the sports";
}

$practicetablebody ="";
$practiceResult  = $conn->query("SELECT
practice_sessions.practice_id,
practice_sessions.practice_title,
practice_sessions.practice_description,
practice_sessions.practice_location,
practice_sessions.practice_date,
practice_sessions.practice_start_time,
practice_sessions.practice_end_time,
practice_sessions.sport_id,
practice_sessions.instructor_id,
practice_sessions.practice_status,
instructors.instructor_name,
sports.sport_name
FROM
practice_sessions
INNER JOIN instructors ON practice_sessions.instructor_id = instructors.instructor_id
INNER JOIN sports ON practice_sessions.sport_id = sports.sport_id
WHERE
practice_status = 1 AND sports.sport_id = $spid
ORDER BY
practice_sessions.practice_date DESC");
if(mysqli_num_rows($practiceResult ) > 0)
{
	while($sessions = mysqli_fetch_array($practiceResult ))
	{
		$practicetablebody .='  <tr>
						<td>'.$sessions['practice_date'].'</td>
						<td>'.date( 'g:i A', strtotime($sessions['practice_start_time']) ).' To<br/> '.date( 'g:i A', strtotime($sessions['practice_end_time']) ).'</td>
						 <td>'.$sessions['practice_location'].'</td>
                        <td>'.$sessions['instructor_name'].'</td>
                    </tr>';
	}
}
else
{
		$practicetablebody =" No practice sessions have allocated to the sports";
}


$eventtablebody ="";
$eventResult  = $conn->query("SELECT
ev.event_title,
ev.event_description,
ev.event_id,
ev.event_location,
ev.event_start_datetime,
ev.event_end_datetime,
ev.event_status,
IFNULL(GROUP_CONCAT(sp.sport_name ORDER BY sp.sport_name SEPARATOR ',<br/> ' ),'') AS assigned_sports
FROM
sports_events ev
LEFT JOIN sports_to_events_map mp ON ev.event_id = mp.event_id
LEFT JOIN  sports sp ON  mp.sports_id = sp.sport_id
WHERE
mp.map_status = 1 AND ev.event_status = 1 AND sp.sport_id = $spid
 GROUP BY ev.event_id ORDER BY ev.event_end_datetime DESC");
if(mysqli_num_rows($eventResult ) > 0)
{
	while($events = mysqli_fetch_array($eventResult ))
	{
		
		$eventtablebody .='                    <tr > 

                        <td>'.$events['event_title'].'</td>
						<td> '.date( 'd-M-y g:i A', strtotime($events['event_start_datetime']) ).'  To: '.date( 'd-M-y g:i A', strtotime($events['event_end_datetime']) ).'</td>
						 <td>'.$events['event_location'].'</td>
                    </tr>';
	}
}	
else
{
		$eventtablebody =" No practice sessions have allocated to the sports";
}
?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | <?=$sports['sport_name']; ?></title>
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
		max-width: 600px;
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
					 <li class="active">
					    <a href="sports_list.php">
                            <i class="fas fa-volleyball-ball"></i>
                            Sports
                        </a>
                    </li>
                    <li>
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
								<div class="col-md-2">					
									<img src="images/sports/<?=$sports["sport_picture"]; ?>" width="150px" height="150px" />	
																
								</div>

								<div class="col-md-6">							
									<div class="form-group">
										<h3><b><?=$sports["sport_name"]; ?></b></h3>
									</div>
									<div class="form-group">
										<h5>Category: <b><?=$sports["sport_category"]; ?></b></h5>
									</div>
									<div class="form-group">
										<label style='font-size:20px' >Age Category: <b><?=$sports["age_category"]; ?></b></label>
									</div>
									<div class="form-group">
										<label style='font-size:20px' >Year: <b><?=$sports["sport_year"]; ?></b></label>
									</div>
									<div class="form-group">
										<label style='font-size:20px' >Description: <b><?=$sports["sport_description"]; ?></b></label>
									</div>	
								</div>	
								<div class="col-md-4 text-center">	
								<?php
								$userresults = $conn->query("SELECT
										*
										FROM
										instructors
										WHERE
										instructor_id = ".$sports["instructor_id"]."");
									if(mysqli_num_rows($userresults ) > 0)
									{
										$instruct = mysqli_fetch_assoc($userresults);
								?>
									<h5>Instructor</b></h5>								
									<img class="avatar rounded-circle" height="150" src="images/profiles/<?=$instruct["instructor_pic"]; ?>" alt="sport pic">
											<h4><?=$instruct["instructor_name"]; ?></h4>	
									<h6><?=$instruct["instructor_field"]; ?>	</h6>	

									<?php
									}
									else
									{
										echo '<h5>No Instructor allocated</h5>	';
									}
									?>									
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
										<?php if($_SESSION['user_level'] == 3){ ?><a href="sports_student_allocation.php?spt=<?=$spid;?>" class="btn btn-info " ><i class="fas fa-puzzle-piece"></i> <span>Edit Student Allocation</span></a>		<?php }?>				
														
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
										<div class="col-sm-6">
											<h3><b>Practice Sessions</b></h3>
										</div>
										<div class="col-sm-6 text-right">
											<?php if($_SESSION['user_level'] == 3){ ?><a href="practice_sessions_list.php" class="btn btn-info " ><i class="fas fa-walking"></i> <span>Manage Sessions</span></a>	<?php }?>					
															
										</div>
									</div>
									<div class="row">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>Date</th>
													<th>Time</th>
													<th>Place</th>
													<th>Instructor</th>
												</tr>
											</thead>

											<tbody>

												<?php echo $practicetablebody; ?>

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
											<h3><b>Events</b></h3>
										</div>
										<div class="col-sm-6 text-right">
											<?php if($_SESSION['user_level'] == 3){ ?><a href="events_list.php" class="btn btn-info " ><i class="fas fa-calendar-day"></i> <span>Manage Events</span></a>	<?php }?>					
															
										</div>
									</div>
									<div class="row">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>Event Title</th>
													<th>Duration</th>
													<th>Location</th>
												</tr>
											</thead>

											<tbody>

												<?php echo $eventtablebody; ?>

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

 <script type="text/javascript">
	 $(document).ready(function () {
		 $('#sidebarCollapse').on('click', function () {
			 $('#sidebar').toggleClass('active');
		 });
	 });

	</script>
</body>
</html>
<?php 
}else
{
	header("location:login.php"); 
}
?>