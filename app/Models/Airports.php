<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class airports extends Mmb  {
	
	protected $table = 'def_airports';
	protected $primaryKey = 'airportID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_airports.* FROM def_airports  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_airports.airportID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
