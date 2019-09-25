<?php 
session_start();
IF(ISSET($_SESSION['username']))
{
	include "functions/db_con.php";	
	$success_msg ="";
	$logged_user = $_SESSION['username'];
	$loggeduser_id = $_SESSION['user_id'];

	if(isset($_POST['add_std']))
	{
			$achievement_type = $_POST['atype'];
			$award_id = isset($_POST['award_id']) ? $_POST['award_id']: 'null';
			$student_id = $_POST['student_id'];
			$achievement_title = $_POST['achievement_title'];
			$achievement_description = $_POST['achievement_description'];
			$achievement_date = date( 'Y-m-d', strtotime($_POST['achievement_date']));
			
			$sql="INSERT INTO student_achievements (student_id, achievement_title,achievement_description,achievement_date,achievement_type,award_id, created_by) VALUES ($student_id,'$achievement_title','$achievement_description','$achievement_date',$achievement_type ,$award_id ,$loggeduser_id )";
		if ($conn->query($sql) === TRUE) 
		{
			$success_msg ="<label style='color:green;font-size:15px' id='success_msg' >You have added new student successfully! </label>";
		} 
		else 
		{
			$success_msg  ="<label style='color:red;font-size:15px' id='success_msg' >Error: <br>" . $conn->error ."</label>";
		}
	}
	
	if(isset($_POST['std_del']))
	{
		if(isset($_POST['StdUserId']))
		{
			$std_id = $_POST['StdUserId'];
			$sql="UPDATE student_achievements SET achievement_status = -1 WHERE achievement_id=$std_id";
			$conn->query($sql);
			$success_msg = "<label style='color:#FFC107; font-size:15px' id='success_msg' > Achievement removed from the system ! </label>";	
		}
		else if(isset($_POST['items']))
		{
		    foreach($_POST['items'] as $value)
		    {
				$sql="UPDATE student_achievements SET achievement_status = -1 WHERE achievement_id=$value";
				$conn->query($sql);

			}
			$success_msg = "<label style='color:#FFC107; font-size:15px' id='success_msg' > All selected achievements are removed from the system ! </label>";
		}
	}
	
	if(isset($_POST['edit_ach']))
	{
            $a_id = $_POST['a_id'];
			$award_id = isset($_POST['award_id']) ? $_POST['award_id']: 'null';
			$achievement_date = date( 'Y-m-d', strtotime($_POST['achievement_date']));

			$update = $conn->query("UPDATE student_achievements SET achievement_type = '".$_POST['atype']."', award_id = ".$award_id.", student_id = '".$_POST['student_id']."' , achievement_title = '".$_POST['achievement_title']."', achievement_description = '".$_POST['achievement_description']."', achievement_date = '".$achievement_date."' WHERE achievement_id = $a_id");
			$success_msg ="<label style='color:green; font-size:15px' id='success_msg' >Achievement updated successfully! </label>";
	
	}
	
 $empResult  = $conn->query("SELECT * FROM event_awards WHERE award_status= 1 ");

		if ($empResult->num_rows > 0) 
		{
			 $stds="<option hidden disabled selected value>Select an award</option>";
			 while($us = mysqli_fetch_array($empResult )) 
			 {$stds.= '<option   value="'.$us['award_id'].'">'.$us['award_title'].'</option>';}
		}
		else{
			$stds="<option hidden disabled selected value> No awards available</option>";
		}
$tablebody ="";
$stdResult  = $conn->query("SELECT
users.user_id,
users.user_name,
users.full_name,
users.user_number,
users.profile_pic,
student_achievements.achievement_id,
student_achievements.achievement_title,
student_achievements.achievement_description,
student_achievements.achievement_date,
event_awards.award_title,
students.student_id,
sports_events.event_title
FROM
students
INNER JOIN users ON users.user_id = students.user_id
INNER JOIN student_achievements ON students.student_id = student_achievements.student_id
Left JOIN event_awards ON student_achievements.award_id = event_awards.award_id
Left JOIN sports_events ON event_awards.event_id = sports_events.event_id
WHERE
users.`status` = 1 AND
student_achievements.achievement_status = 1");
if(mysqli_num_rows($stdResult ) > 0)
{
	while($students = mysqli_fetch_array($stdResult ))
	{
		$actionlist = '<a href="#viewEmployeeModal" class="view" data-user-id="'.$students['achievement_id'].'" data-toggle="modal" ><i class="fas fa-eye" data-toggle="tooltip" title="View"></i></a>';
		if($_SESSION["user_level"] == 3){
			$actionlist = '							<a href="#viewEmployeeModal" class="view" data-user-id="'.$students['achievement_id'].'" data-toggle="modal" ><i class="fas fa-eye" data-toggle="tooltip" title="View"></i></a>
                            <a href="#editEmployeeModal" class="edit" data-user-id="'.$students['achievement_id'].'" data-toggle="modal"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-user-id="'.$students['achievement_id'].'" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i></a>';
			}		
		$tablebody .='                    <tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="std'.$students['achievement_id'].'" name="options[]" value="'.$students['achievement_id'].'">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td>
							<img class="avatar rounded-circle" height="35" src="images/profiles/'.$students['profile_pic'].'"  />		
						</td>
						<td>'.$students['user_number'].'</td>
                        <td><a href="view_student.php?std='.$students['student_id'].'" >'.$students['full_name'].'</a></td>
                        <td>'.$students['achievement_title'].'</td>
						<td>'.$students['achievement_description'].'</td>
                        <td>'.$actionlist.'</td>
                    </tr>';
	}
}	
?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports Desk - KDMV | Students' Achievments </title>
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

function get_selected_checkboxes_array()
{ 
	var ch_list=Array(); 
	$("input:checkbox[type=checkbox]:checked").each(function()
	{
		ch_list.push($(this).val());
	}); 
	return ch_list; 
}
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
					<li>
                        <a href="<?=$_SESSION['user_home']; ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
					<?php if($_SESSION['user_level'] == 3 || $_SESSION['user_level'] == 2 ){ ?>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-user-graduate"></i>
                            Students
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li ><a href="student_list.php"><i class="fas fa-users"></i>Student List</a></li>
                            <li class="active"><a href="student_achievments.php"><i class="fas fa-award"></i>Student Achievements</a></li>
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
				<div class="d-flex justify-content-center">
				 						<?php
				echo $success_msg;
				?>
				</div>
<div class="d-flex justify-content-right"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out <span class="sr-only">(current)</span></a><a href="#" class="btn btn-sm btn-dark navbar-btn" onclick="history.back()" ><i class="fas fa-arrow-left"></i> <span> Back</span></a></div>

			</div>
		</nav>		
		<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<h2>Students' <b>Achievements</b></h2>
					</div>
                    <div class="col-sm-5">
						<input type="text" class="form-control input-md" placeholder="Search by student number, student name or achievemnt " id="search" name="search"/>
					</div>
					<div class="col-sm-3">
					<?php if($_SESSION['user_level'] == 3){ ?>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Add Achievement</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-trash-alt"></i><span>Delete</span></a>	
					<?php }?>							
					</div>
                </div>
            </div>
			<div id="student_list">	
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>Avatar</th>
							<th>Number</th>
							<th>Name</th>
							<th>Achievement</th>
							<th>Description</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>

						<?php echo $tablebody; ?>

					</tbody>

				</table>
			</div>
        </div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add New Achievement</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Achievement Type</label>

								<select required class="input-md textinput form-control" id="atype" name="atype" onchange="displayStudentNumber(this)" >
								  <option value="1">Award</option>
								  <option value="2">Achievement</option>
								</select>

						</div>
						<div class="form-group" id="type_div" name="type_div" >
						<label>Award</label>
						<select name="award_id" id="award_id" class="selectpicker form-control" data-live-search="true"><?php echo $stds; ?></select>
						</div>	
						<div class="form-group">
							<label>Student</label>
							<select name="student_id" id="student_id" class="selectpicker form-control "  data-live-search="true">
								<option required  value hidden disabled selected>Select a Student</option>
							<?php	
							 $empResult  = $conn->query("SELECT * FROM 
							 students
								INNER JOIN users ON users.user_id = students.user_id
								WHERE
								users.`status` = 1");
									while($instruct = mysqli_fetch_array($empResult )) {
										echo '<option   value="'.$instruct['student_id'].'">'.$instruct['user_number'].' - '.$instruct['full_name'].'</option>';
										}

										?>
								</select>
						</div>					
						<div class="form-group">
							<label>Achievement Title</label>
							<input name="achievement_title" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Achievement Description</label>
							<textarea name="achievement_description" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Achievement Date</label>
							<input name="achievement_date" type="date" class="form-control">
						</div>		
					
				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="add_std" id="add_std" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div id="editstudentModelDIV" class="modal-content">
				
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Student</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div id="dele_std_sec" class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<div id="dele_std"></div>
					</div>

										
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="std_del" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>

	</div>

	<!-- view Modal HTML -->
	<div id="viewEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div id="viewInstructorModelDIV" class="modal-content">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function displayStudentNumber(level) 
	{
		var x = (level.value || level.options[level.selectedIndex].value); 	
		var val = document.getElementById("type_div");		
		if(x == 2)
		{						
			val.style.display = "none";
		}
		else{
			val.style.display = "block";
		}
	}
	

</script>		
 <script type="text/javascript">
	 $(document).ready(function () {
		 $('#sidebarCollapse').on('click', function () {
			 $('#sidebar').toggleClass('active');
		 });
	 });

	
	 $('#deleteEmployeeModal').on('show.bs.modal', function(e) {

		var studentlist = get_selected_checkboxes_array();
		var bookId = $(e.relatedTarget).data('user-id');
		if(studentlist.length>0)
		{
			var htmllines ="";
			for (var i = 0; i < studentlist.length; i++) {
				htmllines += '<input type="hidden" name="items[]" value="'+escape(studentlist[i])+'" />';
			}
			document.getElementById("dele_std").innerHTML = htmllines;
			//end of multiple delete
		}
		
		//get data-id attribute of the clicked element

		else if(bookId !== undefined)
		{
			document.getElementById("dele_std").innerHTML = '<input type="hidden" name="StdUserId" id="StdUserId" value="'+bookId+'"/>';
		}
		
		else
		{
			document.getElementById("dele_std").innerHTML = '<p class="text-danger">You havent selected a student</p>';
		}
		//populate the textbox
		//$(e.currentTarget).find('input[name="StdUserId"]').val(bookId);
	});
	
	 $('#editEmployeeModal').on('show.bs.modal', function(e) {

		var edituserId = $(e.relatedTarget).data('user-id');
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_edit_achivement_by_id.php",
		   data: {
			   achivement_id: edituserId
		   },
		   success: function(html) {
			   $("#editstudentModelDIV").html(html).show();
		   }
	   });
	});
	
	 $('#viewEmployeeModal').on('show.bs.modal', function(e) {

		var edituserId = $(e.relatedTarget).data('user-id');
		
	$.ajax({
		   type: "POST",
		   url: "functions/ajax_get_achievement_by_id.php",
		   data: {
			   instrcutor_id: edituserId
		   },
		   success: function(html) {
			   $("#viewInstructorModelDIV").html(html).show();
		   }
	   });
	});	
	
function fill(Value) {
 
   $('#search').val(Value);
   $('#student_list').hide();
 
}	
$(document).ready(function() {	
	$("#search").keyup(function() {
       var name = $('#search').val();

       if (name == "") {
		              $.ajax({
               type: "POST",
               url: "functions/ajax_achievment_searcher.php",
               data: {
                   search: name
               },
               success: function(html) {
                   $("#student_list").html(html).show();
               }
           });
       }
       else {
           $.ajax({
               type: "POST",
               url: "functions/ajax_achievment_searcher.php",
               data: {
                   search: name
               },
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
 
                   $("#student_list").html(html).show();
 
               }
           });
       }
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