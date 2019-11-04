<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class guidelanguages extends Mmb  {
	
	protected $table = 'def_languages';
	protected $primaryKey = 'languageID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT def_languages.* FROM def_languages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE def_languages.languageID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
