<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class currency extends Mmb  {
	
	protected $table = 'def_currency';
	protected $primaryKey = 'currencyID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_currency.* FROM def_currency  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_currency.currencyID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
