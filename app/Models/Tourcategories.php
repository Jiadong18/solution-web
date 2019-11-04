<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class tourcategories extends Mmb  {
	
	protected $table = 'def_tour_categories';
	protected $primaryKey = 'tourcategoriesID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_tour_categories.* FROM def_tour_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_tour_categories.tourcategoriesID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
