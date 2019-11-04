<?php 
namespace App\Library;

class MyHelpers {

	static public function formatEmail( $email)
	{
		return '<a href="mailto:'.$email.'">'.$email.'</a>';
	}


}