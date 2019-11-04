<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class bookroom extends Mmb  {
	
	protected $table = 'book_room';
	protected $primaryKey = 'roomID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT book_room.* FROM book_room  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE book_room.roomID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
