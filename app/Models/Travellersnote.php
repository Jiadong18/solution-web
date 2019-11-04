<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class travellersnote extends Mmb  {
	
	protected $table = 'travellers_note';
	protected $primaryKey = 'travellers_noteID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT travellers_note.* FROM travellers_note  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE travellers_note.travellers_noteID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
