<?php 
session_start();
IF(ISSET($_SESSION['username']))
{
	include "functions/db_con.php";		
	$logged_user = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];

	
$result = $conn->query("SELECT COUNT(*) FROM users WHERE status = 1 AND user_level =2 ");
$studentcount = $result->fetch_row();

$result = $conn->query("SELECT COUNT(*) FROM instructors WHERE instructor_status = 1 ");
$instructcount = $result->fetch_row();

$result = $conn->query("SELECT COUNT(*) FROM sports WHERE sports_status=1 ");
$sportscount = $result->fetch_row();

$result = $conn->query("SELECT COUNT(*) FROM sports_events WHERE event_status=1 ");
$eventscount = $result->fetch_row();

$result = $conn->query("SELECT COUNT(*) FROM student_achievements WHERE achievement_status=1 ");
$achievementcount = $result->fetch_row();

$result = $conn->query("SELECT COUNT(*) FROM practice_sessions WHERE practice_status=1 ");
$practisecount = $result->fetch_row();

	$tablebody ="";
$stdResult  = $conn->query("SELECT
users.user_id,
users.full_name,
users.user_number,
students.student_grade,
students.student_id,
users.profile_pic,
sports_events.event_title,
sports_events.event_id
FROM
students
INNER JOIN users ON users.user_id = students.user_id
INNER JOIN students_to_events_map ON students.student_id = students_to_events_map.students_id
INNER JOIN sports_events ON students_to_events_map.event_id = sports_events.event_id
WHERE
users.`status` = 1 AND
students_to_events_map.request_status = 1");
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
						<td>'.$students['event_title'].'</td>
						<td>
							<a href="view_event.php?id='.$students['event_id'].'" class="btn btn-info btn-md"  > View Event</a>
						</td>
                    </tr>';
	}
}
else
{
		$tablebody =" No students have allocated to the event";
}

$userresults = $conn->query("SELECT
*
FROM
students
INNER JOIN users ON users.user_id = students.user_id
WHERE
users.user_id = $user_id ");

$student = mysqli_fetch_assoc($userresults);	
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | Dashboard </title>
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
		background: #435d7d;
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
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
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
		max-width: 400px;
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
	
</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
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
					<li class="active">
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
                    <li>
						<a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-chart-pie"></i>
                             Reports
                        </a>
                        <ul class="collapse list-unstyled" id="reportSubmenu">
                            <li ><a href="report_students_per_sport.php"><i class="fas fa-users"></i>Students Per Sports</a></li>
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
<div class="d-flex justify-content-right"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out <span class="sr-only">(current)</span></a><a href="#" class="btn btn-sm btn-dark navbar-btn" onclick="history.back()" ><i class="fas fa-arrow-left"></i> <span> Back</span></a></div>

			</div>
		</nav>	

<div class="row">
<div class="col-xl-6">
<div class="row">
	<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$studentcount[0];?> Students</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="student_list.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
	
	<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$instructcount[0];?> Instructors</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="instructors_list.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
</div>	
<div class="row">	
	<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card text-white bg-danger o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$sportscount[0];?> Sports</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="sports_list.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
	<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card text-white bg-secondary o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$eventscount[0];?> Events</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="events_list.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
</div>	
<div class="row">		
	<div class="col-xl-12 col-sm-6 mb-3">
		<div class="card text-white bg-dark o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$achievementcount[0];?> Students Achievements</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="student_achievments.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
</div>		
<div class="row">	
	<div class="col-xl-12 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden h-40">
		<div class="card-body d-flex justify-content-center">

		<h2><?=$practisecount[0];?> Practice Sessions</h2>

		</div>
		<a class="card-footer text-white clearfix  z-1" href="practice_sessions_list.php">
		<span class="float-left">View Details</span>
		<span class="float-right">
		<i class="fa fa-angle-right"></i>
		</span>
		</a>
		</div>
	</div>	
</div>		
</div>

<div class="col-xl-6">
<div class="row">	
		<div class="col-xl-12 col-sm-6 mb-3">
				<div class="card-rows">
					<div class="card border-success">
						<div class="card-body ">
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<img class="avatar rounded-circle" height="155" src="images/profiles/<?=$student['profile_pic']; ?>"  />																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?=$student['user_number']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h2><b><?=$student['full_name']; ?></b></h2>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?=$student['student_grade']; ?></h5>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Phone: <b>'.$student['student_phone'] .'</b>  eMail:<b>'.$student['user_name']; ?></b></h5>																
								</div>
							</div>								
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h4><b><?= $student['student_address']; ?></b></h4>																
								</div>
							</div>							
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<h5><?= 'Member Since: <b>'.date( 'd-M-Y', strtotime($student['joined_date']) ); ?></b></h5>																
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center">					
									<a href="view_student.php?std=<?=$student['student_id']; ?>" class="btn btn-primary" >View My profile</a>																													
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