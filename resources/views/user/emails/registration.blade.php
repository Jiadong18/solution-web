	
		<meta charset="utf-8">
	
	
		<h2>Hello {{ $firstname }} ,</h2>
		<p> Thanks for joining us and Welcome to {{ CNF_COMNAME }} </p>
		<p> Following is your account Information </p>
		<p>
			Email : {{ $email }}  <br>
			Password : {{ $password }} <br>
		</p>
		<p> Please follow the link to activate your account <br>
               <a href="{{ URL::to('user/activation?code='.$code) }}"> Active my account now</a></p>
		<p> If the link does not work, please copy and paste link below </p>
		<p> {{ URL::to('user/activation?code='.$code) }}</p><p> Thank You</p>
<h3>{{ CNF_COMNAME }}</h3>