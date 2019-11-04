<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shoppingtypes extends Mmb  {
	
	protected $table = 'def_shopping_types';
	protected $primaryKey = 'shoppingtypeID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_shopping_types.* FROM def_shopping_types  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_shopping_types.shoppingtypeID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
