<!DOCTYPE html>
<html>
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="stylesheet" href="Media/JS/datetimepicker-master/jquery.datetimepicker.css"/>
			<link rel="stylesheet" href="Media/CSS/font-awesome-4.3.0/css/font-awesome.min.css"/>
	</head>
<body>
<?php $this->title = "GW L - Add a company" ?>


<form id="form" action="profile/company" method="post">

	<p>This informations will necessary to complete the school profile</p>

    <input name="name" type="text" placeholder="Company name" required autofocus>
	<br><br>
    <input name="companyOwner" type="text" placeholder="Company owner" required>
	<br><br>
	<div>
    	<i aria-hidden="true" class="fa fa-calendar fa-3x"></i>
		<input type="text" name="creationDate" id="datetimepicker" placeholder ="Date of creation" required/>
    </div>
    <br>
    <input name="location" type="text" placeholder="Location" required>
	<br><br>
    <label>Industry sector: </label> 
	<SELECT name="industrySector" id="industrySector"> 
		<OPTION value="Aerospace, defence, security ">Aerospace, defence, security </OPTION>
		<OPTION value="Communications">Communications</OPTION>
		<OPTION value="Entertainment, media">Entertainment, media</OPTION>
		<OPTION value="Financial services">Financial services</OPTION>
		<OPTION value="Hospitality">Hospitality</OPTION>
		<OPTION value="Industrial manufacturing">Industrial manufacturing</OPTION>
		<OPTION value="Technology">Technology</OPTION>
		<OPTION value="Transportation, logistics">Transportation, logistics</OPTION>
		<OPTION value="Other">Other</OPTION>
	</SELECT>
    <br><br>
    <textarea rows="10" cols="50" name="about" placeholder="About the company"></textarea>
	<br><br>
    <button id="formSubmitSchool" type="submit">Add the company !</button>

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