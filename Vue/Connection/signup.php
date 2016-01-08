<!DOCTYPE html>
<html>
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="stylesheet" href="Media/JS/datetimepicker-master/jquery.datetimepicker.css"/>
			<link rel="stylesheet" href="Media/CSS/font-awesome-4.3.0/css/font-awesome.min.css"/>
	</head>
<body>
<?php $this->title = "GW L - Sign Up" ?>


<form id="form" action="connection/signupConnection" method="post">

	<p>This informations will help us to complete your profile</p>

    <input name="firstName" type="text" placeholder="First name" required autofocus>
	<input name="lastName" type="text" placeholder="Last name" required>
	<br><br>
	<div>
    	<i aria-hidden="true" class="fa fa-calendar fa-3x"></i>
		<input type="text" name="birthDate" id="datetimepicker" placeholder ="Birth Date" required/>
    </div>
    <br>
	<input name="sex" type="radio" value="1" checked> Male
	<br>
	<input name="sex" type="radio" value="0"> Female
	<br><br>
    <input name="location" type="text" placeholder="Location" required>
    <br><br>
    <textarea rows="4" cols="50" name="about" placeholder="About yourself"></textarea>
	<br><br>
    <input name="email" type="email" placeholder="E-mail" required>
    <input name="password" type="password" placeholder="Password" required>
    <br><br>
    <button id="formSubmit" type="submit">SIGN UP !</button>

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
				 minDate:'-1995/01/00',
				 maxDate:'+1970/01/00',
				 validateOnBlur:true,
				 closeOnDateSelect:true,
				 timepicker:false,
				 format:'Y-m-d',
			});
		}
	})();
</script>
</body>