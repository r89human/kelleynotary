<!DOCTYPE html>
<html>
<head>
	<title>New assignment has been posted</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<h2>{{ $details['client_name'] }} posted a new assignment. </h2>
				<p>
					
					Please login to the dashboard to check the new assignment from {{ $details['client_name'] }} <br/>
					
					<hr/><br/>
					<b>Assignment Type:</b> {{ $details['assignment_type'] }} <br/>
					<b>Assignment Name:</b> {{ $details['assignment_name'] }} <br/>
					<b>Assignment City:</b> {{ $details['assignment_city'] }} <br/>
					<b>Assignment State:</b> {{ $details['assignment_state'] }} <br/>
					<b>Assignment Zip:</b> {{ $details['assignment_zip'] }} <br/>
					<b>Assignment Date & Time:</b> {{ $details['assignment_date_time'] }} <br/>
				</p>

				<hr/>
				<br/> 
				<a href="http://app.kelleysmobilenotary.com/login" class="btn btn-md btn-info text-center">Click here to login</a>

				<h3>Thank you. </h3>

			</div>
		</div>
	</div>
</div>

</body>
</html>