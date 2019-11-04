<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class createbooking extends Mmb  {
	
	protected $table = 'bookings';
	protected $primaryKey = 'bookingsID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT bookings.* FROM bookings  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE bookings.bookingsID IS NOT NULL";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
