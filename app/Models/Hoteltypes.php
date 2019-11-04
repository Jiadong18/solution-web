<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class hoteltypes extends Mmb  {
	
	protected $table = 'def_hotel_type';
	protected $primaryKey = 'hoteltypeID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_hotel_type.* FROM def_hotel_type  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_hotel_type.hoteltypeID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
