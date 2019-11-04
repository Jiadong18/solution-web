<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class optionaltours extends Mmb  {
	
	protected $table = 'def_optional_tours';
	protected $primaryKey = 'optionaltourID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_optional_tours.* FROM def_optional_tours  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_optional_tours.optionaltourID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
