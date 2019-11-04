<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class hotels extends Mmb  {
	
	protected $table = 'hotels';
	protected $primaryKey = 'hotelID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT hotels.* FROM hotels ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE hotels.hotelID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
