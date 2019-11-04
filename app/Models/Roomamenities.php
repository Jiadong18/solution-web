<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class roomamenities extends Mmb  {
	
	protected $table = 'def_room_amenities';
	protected $primaryKey = 'roomamenityID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_room_amenities.* FROM def_room_amenities  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_room_amenities.roomamenityID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
