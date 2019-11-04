<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class carbrands extends Mmb  {
	
	protected $table = 'def_car_brands';
	protected $primaryKey = 'carbrandID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_car_brands.* FROM def_car_brands  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_car_brands.carbrandID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
