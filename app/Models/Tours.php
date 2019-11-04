<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class tours extends Mmb  {
	
	protected $table = 'tours';
	protected $primaryKey = 'tourID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tours.* FROM tours ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tours.tourID IS NOT NULL  ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
