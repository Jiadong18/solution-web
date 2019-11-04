<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class cities extends Mmb  {
	
	protected $table = 'def_city';
	protected $primaryKey = 'cityID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_city.* FROM def_city  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_city.cityID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
