<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class guidenotes extends Mmb  {
	
	protected $table = 'guide_notes';
	protected $primaryKey = 'guidenotesID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT guide_notes.* FROM guide_notes  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE guide_notes.guidenotesID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
