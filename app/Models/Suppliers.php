<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class suppliers extends Mmb  {
	
	protected $table = 'def_supplier';
	protected $primaryKey = 'supplierID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_supplier.* FROM def_supplier  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_supplier.supplierID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
