<?php namespace App\Models;

use App\Models\Airlines;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Mmb
{

    protected $table = 'staffs';

   protected $primaryKey = 'staffID';
    protected $fillable = ['name', 'email', 'phone', 'address', 'stafftypeID', 'cityID',
        'countryID','status'];

    public $timestamps  = false;
    public function staffType()
    {
        return $this->belongsTo('App\Models\StaffType', 'stafftypeID');

    }  public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'cityID');

    }  public function country()
    {
        return $this->belongsTo('App\Models\Countries', 'countryID');

    }



}
