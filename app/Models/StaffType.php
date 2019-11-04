<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class StaffType extends Mmb  {
	
	protected $table = 'staff_type';
	protected $primaryKey = 'stafftypeID';
    protected $fillable = ['staff_type','status'];
	public function __construct() {
		parent::__construct();
		
	}

	

}
