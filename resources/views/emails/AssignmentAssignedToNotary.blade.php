<!DOCTYPE html>
<html>
<head>
	<title>New assignment assigned</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<h2>{{ $details['assigned_by'] }} assigned an assinment. Please have a look </h2>
				<p>
					
					Please login to the dashboard to check the new assignment from {{ $details['assigned_by'] }} <br/>
					
					<hr/><br/>
					<b>Assignment Type:</b> {{ $details['assignment_type'] }} <br/>
					<b>Assignment Assigned By:</b> {{ $details['assigned_by'] }} <br/>
					<b>Special Instruction :</b> {{ $details['special_instruction'] }} <br/>
					<b>Offer Amount:</b> ${{ $details['pay_amount'] }} <br/>
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