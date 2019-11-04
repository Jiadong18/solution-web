<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class extraservices extends Mmb  {
	
	protected $table = 'def_extra_services';
	protected $primaryKey = 'extraserviceID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_extra_services.* FROM def_extra_services  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_extra_services.extraserviceID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
