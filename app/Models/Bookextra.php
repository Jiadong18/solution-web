<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class bookextra extends Mmb  {
	
	protected $table = 'book_extra';
	protected $primaryKey = 'bookextraID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT book_extra.* FROM book_extra  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE book_extra.bookextraID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
