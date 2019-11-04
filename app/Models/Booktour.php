<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class booktour extends Mmb  {
	
	protected $table = 'book_tour';
	protected $primaryKey = 'booktourID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT book_tour.* FROM book_tour  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE book_tour.booktourID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
