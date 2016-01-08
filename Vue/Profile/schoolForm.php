<!DOCTYPE html>
<html>
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="stylesheet" href="Media/JS/datetimepicker-master/jquery.datetimepicker.css"/>
			<link rel="stylesheet" href="Media/CSS/font-awesome-4.3.0/css/font-awesome.min.css"/>
	</head>
<body>
<?php $this->title = "GW L - Add a school" ?>


<form id="form" action="profile/school" method="post">

	<p>This informations will necessary to complete the school profile</p>

    <input name="name" type="text" placeholder="School name" required autofocus>
	<br><br>
    <label>Director:</label>
    <a id="schoolDirector">
    	<?= $this->secure($currentUser['lastName'])." ".$this->secure($currentUser['firstName']) ?>
    </a>   
	<br><br>
	<div>
    	<i aria-hidden="true" class="fa fa-calendar fa-3x"></i>
		<input type="text" name="creationDate" id="datetimepicker" placeholder ="Date of creation" required/>
    </div>
    <br>
    <input name="location" type="text" placeholder="Location" required>
	<br><br>
	<label for="studentsNumber">Number of students: </label>
	<input name="studentsNumber" type="number" min="10" max="100000" value ="5000"/> 
    <br><br>
    <label for="teachersNumber">Number of teachers: </label>
	<input name="teachersNumber" type="number" min="10" max="10000" value ="100"/> 
    <br><br>
    <textarea rows="10" cols="50" name="about" placeholder="About the school"></textarea>
	<br><br>
    <button id="formSubmitSchool" type="submit">Add the school !</button>

</form>

<?php if (isset($errorMessage)): ?>
    <p><?= $errorMessage ?></p>
<?php endif; ?>

<script type="text/javascript" charset="utf8" src="Media/JS/datetimepicker-master/jquery.js"></script>
<script src="Media/JS/datetimepicker-master/jquery.datetimepicker.js"></script>
<script>
	//****************************************************	Datetimepicker	*******************************************************************
	(function(){
		var elem = document.createElement('input');
		elem.setAttribute('type', 'date');
		if ( elem.type === 'text' )
		{
			jQuery('#datetimepicker').datetimepicker({
		
				lang:'en',
				 dayOfWeekStart: 1,
				 value:'1990-01-01', format:'Y-m-d',
				 maxDate:'+1970-01-02',
				 validateOnBlur:true,
				 closeOnDateSelect:true,
				 timepicker:false,
				 format:'Y-m-d',
			});
		}
	})();
</script>
</body>