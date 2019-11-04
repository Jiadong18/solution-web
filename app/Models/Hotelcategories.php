<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class hotelcategories extends Mmb  {
	
	protected $table = 'def_hotel_categories';
	protected $primaryKey = 'hotelcategoryID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_hotel_categories.* FROM def_hotel_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_hotel_categories.hotelcategoryID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
