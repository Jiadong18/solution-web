<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class visaapplication extends Mmb  {
	
	protected $table = 'visaapplications';
	protected $primaryKey = 'applicationID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT visaapplications.* FROM visaapplications  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE visaapplications.applicationID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
