<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class inclusions extends Mmb  {
	
	protected $table = 'def_inclusions';
	protected $primaryKey = 'inclusionID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_inclusions.* FROM def_inclusions  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_inclusions.inclusionID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
