<?php namespace App\Models;

use App\Models\Airlines;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Mmb
{

    protected $table = 'tickets';

   protected $primaryKey = 'ticketID';
    protected $fillable = ['airlinesID', 'class', 'returnn', 'depairportID', 'arrairportID', 'departing',
        'arrFlightNO', 'returning', 'depFlightNO', 'price', 'available_seats', 'seats', 'status', 'eticketno', 'PNR'];

    public function from()
    {
        return $this->belongsTo('App\Models\Airports', 'depairportID');

    }

    public function to()
    {
        return $this->belongsTo('App\Models\Airports', 'arrairportID');
    }

    public function airlines()
    {
        $airlineIds = json_decode($this->airlinesID);
        return Airlines::whereIn('airlineID', $airlineIds)->get();
    }

    public static function querySelect(  ){

        return "  SELECT tickets.* FROM tickets  ";
    }

    public static function queryWhere(  ){

        return "  WHERE tickets.ticketID IS NOT NULL ";
    }

    public static function queryGroup(){
        return "  ";
    }

}
