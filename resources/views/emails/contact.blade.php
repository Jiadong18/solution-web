<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hello</h2>
		<p> You have new mail</p>
		<p>
			Email : {{ $sender }} <br />
			Name  : {{ $name }}<br />
			Subject : {{ $subject }}<br />
		</p>
		<p> Message : </p>
		<div>
			{!! $notes !!}
		</div>
		
		<p> Thank You </p><br /><br />
		
		{{ CNF_COMNAME }} 
	</body>
</html>