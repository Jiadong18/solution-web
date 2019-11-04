<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class hotelfacilities extends Mmb  {
	
	protected $table = 'def_hotel_facilities';
	protected $primaryKey = 'hotelfacilityID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_hotel_facilities.* FROM def_hotel_facilities  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_hotel_facilities.hotelfacilityID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
