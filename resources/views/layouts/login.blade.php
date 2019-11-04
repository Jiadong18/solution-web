<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ManageMyBookings</title>
<link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('mmb')}}/css/bootstrap.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('mmb')}}/css/Grace.css">
<script src="{{ asset('mmb')}}/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="{{ asset('mmb/js/parsley.js') }}"></script>			
<script src="{{ asset('mmb')}}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ asset('mmb/js/form.js') }}"></script>	
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->		
  	</head>
	<body class="hold-transition login-page">
		@yield('content')	
	</body>

</html>