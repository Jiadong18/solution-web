<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class airlines extends Mmb  {
	
	protected $table = 'def_airlines';
	protected $primaryKey = 'airlineID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_airlines.* FROM def_airlines  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_airlines.airlineID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
