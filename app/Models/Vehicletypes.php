<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class vehicletypes extends Mmb  {
	
	protected $table = 'def_vehicle';
	protected $primaryKey = 'vehicleID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_vehicle.* FROM def_vehicle  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_vehicle.vehicleID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
