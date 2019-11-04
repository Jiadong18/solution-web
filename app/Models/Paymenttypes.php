<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class paymenttypes extends Mmb  {
	
	protected $table = 'def_payment_types';
	protected $primaryKey = 'paymenttypeID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_payment_types.* FROM def_payment_types  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_payment_types.paymenttypeID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
