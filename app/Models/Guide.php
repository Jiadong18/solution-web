<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class guide extends Mmb  {
	
	protected $table = 'guides';
	protected $primaryKey = 'guideID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT guides.* FROM guides ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE guides.guideID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
