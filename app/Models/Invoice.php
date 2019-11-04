<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class invoice extends Mmb  {
	
	protected $table = 'invoice';
	protected $primaryKey = 'invoiceID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT invoice.* FROM invoice  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE invoice.invoiceID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
