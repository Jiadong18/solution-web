<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class bookcar extends Mmb  {
	
	protected $table = 'book_car';
	protected $primaryKey = 'bookcarID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT book_car.* FROM book_car  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE book_car.bookcarID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
