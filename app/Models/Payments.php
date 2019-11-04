<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class payments extends Mmb  {
	
	protected $table = 'invoice_payments';
	protected $primaryKey = 'invoicePaymentID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT invoice_payments.* FROM invoice_payments  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE invoice_payments.invoicePaymentID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
