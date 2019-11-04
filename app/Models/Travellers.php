<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class travellers extends Mmb  {
	
	protected $table = 'travellers';
	protected $primaryKey = 'travellerID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT travellers.* FROM travellers  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE travellers.travellerID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
