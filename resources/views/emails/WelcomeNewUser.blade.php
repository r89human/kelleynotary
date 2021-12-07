<h1>Hi, {{ $mailData->name }}</h1>
<p>A new account is created for you and here is your login credential: 
	<br/> <b>Email : </b> {{$mailData->email}}
	<br/> <b>Password : </b> {{$mailData->password}}
	<br/> <a href="http://app.kelleysmobilenotary.com/login">Click here to login</a>
</p>
<p>Thank you.</p>