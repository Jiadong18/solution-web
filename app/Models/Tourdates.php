<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class tourdates extends Mmb  {
	
	protected $table = 'tour_date';
	protected $primaryKey = 'tourdateID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tour_date.* FROM tour_date  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tour_date.tourdateID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
