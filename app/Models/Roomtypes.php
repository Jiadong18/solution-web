<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class roomtypes extends Mmb  {
	
	protected $table = 'def_room_types';
	protected $primaryKey = 'roomtypeID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_room_types.* FROM def_room_types  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_room_types.roomtypeID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
