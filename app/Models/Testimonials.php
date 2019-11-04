<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Mmb  {
	
	protected $table = 'testimonials';
	protected $primaryKey = 'testimonialID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT testimonials.* FROM testimonials  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE testimonials.testimonialID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
