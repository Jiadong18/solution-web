<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class cars extends Mmb  {
	
	protected $table = 'cars';
	protected $primaryKey = 'carsID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT cars.* FROM cars  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE cars.carsID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
