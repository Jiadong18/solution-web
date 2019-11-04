<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class tandc extends Mmb  {
	
	protected $table = 'termsandconditions';
	protected $primaryKey = 'tandcID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT termsandconditions.* FROM termsandconditions  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE termsandconditions.tandcID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
