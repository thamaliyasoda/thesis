<?php 
session_start();
IF(ISSET($_SESSION['username']))
{
	include "functions/db_con.php";	
	$success_msg ="";
	$logged_user = $_SESSION['username'];
	$loggeduser_id = $_SESSION['user_id'];

	if (!isset($_GET['first_std']) OR !isset($_GET['second_std']) ) 
	{
		header("location:".$_SESSION['user_home']); 
	}
$stid1 = $_GET['first_std'];
$stid2 = $_GET['second_std'];


$userresults = $conn->query("SELECT
*
FROM
students
INNER JOIN users ON users.user_id = students.user_id
WHERE
student_id = $stid1 ");
$student1 = mysqli_fetch_assoc($userresults);

$userresults = $conn->query("SELECT
*
FROM
students
INNER JOIN users ON users.user_id = students.user_id
WHERE
student_id = $stid2 ");
$student2 = mysqli_fetch_assoc($userresults);


$eventtablebody1 ="";
$eventResult  = $conn->query("SELECT
sports_events.event_title,
sports_events.event_description,
sports_events.event_location,
sports_events.event_id,
sports_events.event_start_datetime,
sports_events.event_end_datetime
FROM
students_to_events_map
INNER JOIN sports_events ON students_to_events_map.event_id = sports_events.event_id
WHERE
students_to_events_map.students_id = $stid1 AND
sports_events.event_status = 1 AND
students_to_events_map.request_status = 2");
if(mysqli_num_rows($eventResult ) > 0)
{
	while($events = mysqli_fetch_array($eventResult ))
	{
		
		$eventtablebody1 .='                    <tr > 

                        <td>'.$events['event_title'].'</td>
						<td> '.date( 'd-M-y g:i A', strtotime($events['event_start_datetime']) ).'  To: '.date( 'd-M-y g:i A', strtotime($events['event_end_datetime']) ).'</td>
						 <td>'.$events['event_location'].'</td>
                    </tr>';
	}
}	
else
{
		$eventtablebody1 =" The student has not allocated to events";
}
$eventtablebody2 ="";
$eventResult  = $conn->query("SELECT
sports_events.event_title,
sports_events.event_description,
sports_events.event_location,
sports_events.event_id,
sports_events.event_start_datetime,
sports_events.event_end_datetime
FROM
students_to_events_map
INNER JOIN sports_events ON students_to_events_map.event_id = sports_events.event_id
WHERE
students_to_events_map.students_id = $stid2 AND
sports_events.event_status = 1 AND
students_to_events_map.request_status = 2");
if(mysqli_num_rows($eventResult ) > 0)
{
	while($events = mysqli_fetch_array($eventResult ))
	{
		
		$eventtablebody2 .='                    <tr > 

                        <td>'.$events['event_title'].'</td>
						<td> '.date( 'd-M-y g:i A', strtotime($events['event_start_datetime']) ).'  To: '.date( 'd-M-y g:i A', strtotime($events['event_end_datetime']) ).'</td>
						 <td>'.$events['event_location'].'</td>
                    </tr>';
	}
}	
else
{
		$eventtablebody2 =" The student has not allocated to events";
}

$awardtablebody1 ="";
$awardResult  = $conn->query("SELECT
student_achievements.achievement_title,
student_achievements.achievement_description,
event_awards.award_title
FROM
student_achievements
LEFT JOIN event_awards ON student_achievements.award_id = event_awards.award_id
WHERE
student_achievements.student_id = $stid1 AND
student_achievements.achievement_status = 1");
if(mysqli_num_rows($awardResult ) > 0)
{
	while($award = mysqli_fetch_array($awardResult ))
	{
		$awardtablebody1 .='  <tr>
						<td>'.$award['achievement_title'].'</td>
						<td>'.$award['achievement_description'].'</td>
						<td>'.$award['award_title'].'</td>
                    </tr>';
	}
}
else
{
		$awardtablebody1 =" No awards have allocated to the event";
}
$awardtablebody2 ="";
$awardResult  = $conn->query("SELECT
student_achievements.achievement_title,
student_achievements.achievement_description,
event_awards.award_title
FROM
student_achievements
LEFT JOIN event_awards ON student_achievements.award_id = event_awards.award_id
WHERE
student_achievements.student_id = $stid2 AND
student_achievements.achievement_status = 1");
if(mysqli_num_rows($awardResult ) > 0)
{
	while($award = mysqli_fetch_array($awardResult ))
	{
		$awardtablebody2 .='  <tr>
						<td>'.$award['achievement_title'].'</td>
						<td>'.$award['achievement_description'].'</td>
						<td>'.$award['award_title'].'</td>
                    </tr>';
	}
}
else
{
		$awardtablebody2 =" No awards have allocated to the event";
}

$relatedsportsbody1 ="";
$relatedsportsResult  = $conn->query("SELECT
sports.sport_name,
sports.sport_id,
sports.sport_category,
sports.age_category,
sports.sport_year,
sports.sport_picture
FROM
students_to_sports_map
INNER JOIN sports ON students_to_sports_map.sports_id = sports.sport_id
WHERE
sports.sports_status = 1 AND
students_to_sports_map.student_id = $stid1 AND
students_to_sports_map.map_status = 1");
if(mysqli_num_rows($relatedsportsResult ) > 0)
{
	while($sports = mysqli_fetch_array($relatedsportsResult ))
	{
		$relatedsportsbody1 .='  <tr>
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
		$relatedsportsbody1 =" No sports have allocated to the event";
}
$relatedsportsbody2 ="";
$relatedsportsResult  = $conn->query("SELECT
sports.sport_name,
sports.sport_id,
sports.sport_category,
sports.age_category,
sports.sport_year,
sports.sport_picture
FROM
students_to_sports_map
INNER JOIN sports ON students_to_sports_map.sports_id = sports.sport_id
WHERE
sports.sports_status = 1 AND
students_to_sports_map.student_id = $stid2 AND
students_to_sports_map.map_status = 1");
if(mysqli_num_rows($relatedsportsResult ) > 0)
{
	while($sports = mysqli_fetch_array($relatedsportsResult ))
	{
		$relatedsportsbody2 .='  <tr>
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
		$relatedsportsbody2 =" No sports have allocated to the event";
}

$practicetablebody1 ="";
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
INNER JOIN students_to_sports_map ON sports.sport_id = students_to_sports_map.sports_id
WHERE
practice_sessions.practice_status = 1 AND
students_to_sports_map.student_id = $stid1 AND
students_to_sports_map.map_status = 1
ORDER BY
practice_sessions.practice_date DESC");
if(mysqli_num_rows($practiceResult ) > 0)
{
	while($sessions = mysqli_fetch_array($practiceResult ))
	{
		$practicetablebody1 .='  <tr>
						<td>'.$sessions['sport_name'].'</td>
						<td>On '.$sessions['practice_date'].' From '.date( 'g:i A', strtotime($sessions['practice_start_time']) ).' To<br/> '.date( 'g:i A', strtotime($sessions['practice_end_time']) ).'</td>
						 <td>'.$sessions['practice_location'].'</td>
                        <td>'.$sessions['instructor_name'].'</td>
                    </tr>';
	}
}
else
{
		$practicetablebody1 =" No practice sessions have allocated to the sports";
}
$practicetablebody2 ="";
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
INNER JOIN students_to_sports_map ON sports.sport_id = students_to_sports_map.sports_id
WHERE
practice_sessions.practice_status = 1 AND
students_to_sports_map.student_id = $stid2 AND
students_to_sports_map.map_status = 1
ORDER BY
practice_sessions.practice_date DESC");
if(mysqli_num_rows($practiceResult ) > 0)
{
	while($sessions = mysqli_fetch_array($practiceResult ))
	{
		$practicetablebody2 .='  <tr>
						<td>'.$sessions['sport_name'].'</td>
						<td>On '.$sessions['practice_date'].' From '.date( 'g:i A', strtotime($sessions['practice_start_time']) ).' To<br/> '.date( 'g:i A', strtotime($sessions['practice_end_time']) ).'</td>
						 <td>'.$sessions['practice_location'].'</td>
                        <td>'.$sessions['instructor_name'].'</td>
                    </tr>';
	}
}
else
{
		$practicetablebody2 =" No practice sessions have allocated to the sports";
}
?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | Compare Students</title>
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
                        <a href="admin_dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
					<?php if($_SESSION['user_level'] == 3 || $_SESSION['user_level'] == 2 ){ ?>
                    <li class="active" >
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="true">
                            <i class="fas fa-user-graduate"></i>
                            Students
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li ><a href="student_list.php"><i class="fas fa-users"></i>Student List</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="instructors_list.php">
                            <i class="fas fa-user-tie"></i>
                            Instructors
                        </a>
					</li>
					<?php }?>
					 <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-volleyball-ball"></i>
                            Sports
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="sports_list.php"><i class="fas fa-basketball-ball"></i>Sports List</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="events_list.php">
                            <i class="fas fa-calendar-day"></i>
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
			<div class="col-sm-6">
				<div class="card-rows">
					<div class="card border-success">
						<div class="card-body ">
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<img class="avatar rounded-circle" height="155" src="images/profiles/<?=$student1['profile_pic']; ?>"  />																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?=$student1['user_number']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h2><b><?=$student1['full_name']; ?></b></h2>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?=$student1['student_grade']; ?></h5>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Phone: <b>'.$student1['student_phone'] .'</b>  eMail:<b>'.$student1['user_name']; ?></b></h5>																
								</div>
							</div>								
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?= $student1['student_address']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Member Since: <b>'.date( 'd-M-Y', strtotime($student1['joined_date']) ); ?></b></h5>																
								</div>
							</div>	
		
					
						</div>						
					</div>	
				</div>
			</div>	
			<div class="col-sm-6">
				<div class="card-rows">
					<div class="card border-success">
						<div class="card-body ">
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<img class="avatar rounded-circle" height="155" src="images/profiles/<?=$student2['profile_pic']; ?>"  />																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?=$student2['user_number']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h2><b><?=$student2['full_name']; ?></b></h2>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?=$student2['student_grade']; ?></h5>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Phone: <b>'.$student2['student_phone'] .'</b>  eMail:<b>'.$student2['user_name']; ?></b></h5>																
								</div>
							</div>								
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?= $student2['student_address']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Member Since: <b>'.date( 'd-M-Y', strtotime($student2['joined_date']) ); ?></b></h5>																
								</div>
							</div>	
		
					
						</div>						
					</div>	
				</div>
			</div>				
		</div>	
<br/>		
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-6">
									<h3><b>Related Sports</b></h3>
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

										<?php echo $relatedsportsbody1; ?>

									</tbody>

								</table>
							</div>
						</div>
					</div>
					</div>						
			

			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-6">
									<h3><b>Related Sports</b></h3>
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

										<?php echo $relatedsportsbody2; ?>

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
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Registered Events</b></h3>
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

										<?php echo $eventtablebody1; ?>

									</tbody>

								</table>
							</div>
						</div>
					</div>
					</div>
				</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Registered Events</b></h3>
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

										<?php echo $eventtablebody2; ?>

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
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Practice Sessions</b></h3>
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

										<?php echo $practicetablebody1; ?>

									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Practice Sessions</b></h3>
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

										<?php echo $practicetablebody2; ?>

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
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Achivements</b></h3>
								</div>
							</div>
							<div class="row">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Title</th>
											<th>Description</th>
											<th>Award Title</th>
										</tr>
									</thead>

									<tbody>

										<?php echo $awardtablebody1; ?>

									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card border-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-sm-12">
									<h3><b>Achivements</b></h3>
								</div>
							</div>
							<div class="row">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Title</th>
											<th>Description</th>
											<th>Award Title</th>
										</tr>
									</thead>

									<tbody>

										<?php echo $awardtablebody2; ?>

									</tbody>

								</table>
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
	 
	 	$('#addEmployeeModal').on('show.bs.modal', function(e) {
		

	</script>
</body>
</html>
<?php 
}else
{
	header("location:login.php"); 
}
?>