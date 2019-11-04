<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class sites extends Mmb  {
	
	protected $table = 'def_sites';
	protected $primaryKey = 'siteID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_sites.* FROM def_sites  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_sites.siteID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
