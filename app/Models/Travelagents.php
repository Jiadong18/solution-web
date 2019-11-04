<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class travelagents extends Mmb  {
	
	protected $table = 'travel_agent';
	protected $primaryKey = 'travelagentID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT travel_agent.* FROM travel_agent  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE travel_agent.travelagentID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
