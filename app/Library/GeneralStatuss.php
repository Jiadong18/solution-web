<?php


namespace App\Library;

use Illuminate\Support\Facades\Lang;

class GeneralStatuss
{
    static public function Status( $Status)
    {
        if($Status =='0'):
            return '<i class="fa fa-fw fa-2x fa-exclamation-circle text-yellow tips" title="'.Lang::get('core.fr_minactive').'"></i>';
        elseif($Status =='1'):
            return '<i class="fa fa-fw fa-2x fa-check-circle text-green tips" title="'.Lang::get('core.fr_mactive').'"></i>';
        elseif($Status =='2'):
            return '<i class="fa fa-fw fa-2x fa-close text-red tips" title="'.Lang::get('core.cancelled').'"></i>';
        endif;

    }

    static public function Visa( $Status)
    {

        if($Status =='0'):
            return '<button type="button" class="btn btn-sm btn-danger btn-block">'.Lang::get('core.rejected').' </button>';
        elseif($Status =='1'):
            return '<button type="button" class="btn btn-sm  btn-warning btn-block">'.Lang::get('core.new').' </button>';
        elseif($Status =='2'):
            return '<button type="button" class="btn btn-sm  btn-info btn-block">'.Lang::get('core.pending').' </button>';
        elseif($Status =='3'):
            return '<button type="button" class="btn btn-sm  btn-success btn-block">'.Lang::get('core.approved').' </button>';
        endif;

    }

    static public function Tour( $Status , $Start , $End ,$id ,$total )
    {

        $room_single = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',1)
            ->where('book_room.status','=',1)
            ->count();

        $room_double = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',2)
            ->where('book_room.status','=',1)
            ->count();

        $room_triple = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',3)
            ->where('book_room.status','=',1)
            ->count();

        $totalbooked= $room_single+($room_double*2)+($room_triple*3) ;
        $available=$total-$totalbooked;

        $today=date("Y-m-d");
        if($Status =='0'):
            return '<span class="tips text-red" title="'.Lang::get('core.fr_minactive').'"> <i class="fa fa-ban fa-2x" aria-hidden="true"></i> </span>';
        elseif($Status =='1'):
            if($Start > $today):
                if ($available!='0')
                    return '<span class="tips text-yellow" title="'.Lang::get('core.upcomingtour').'"><i class="fa fa-random fa-2x" aria-hidden="true"></i>  </span> <span class="btn btn-sm btn-default tips" title="'.Lang::get('core.seatsavailable').'">'.$available.'</span>';
                else
                {return '<span class="text-red tips" title="Upcoming Tour"><i class="fa fa-random fa-2x" aria-hidden="true"></i>  </span> <span class="btn btn-sm btn-danger tips" title="'.Lang::get('core.noseatsavailable').'">0</span>';}
            elseif($End < $today):
                return '<span class="text-blue tips" title="'.Lang::get('core.pasttours').'"> <i class="fa fa-calendar-check-o fa-2x" aria-hidden="true"></i>
  </span>';
            elseif($Start <= $today and $End >= $today):
                return '<span class="tips" title="'.Lang::get('core.fr_mactive').'"> <i class="fa fa-bus fa-2x" aria-hidden="true"></i>
  </span> <span class="btn btn-sm btn-default tips" title="'.Lang::get('core.groupsize').'">'.$totalbooked.'</span>';
            endif;
        elseif($Status =='2'):
            return '<span class="tips text-red" title="'.Lang::get('core.cancelled').'"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>';
        endif;

    }

    static public function tourCapacity( $id ,$total )
    {

        $room_single = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',1)
            ->where('book_room.status','=',1)
            ->count();

        $room_double = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',2)
            ->where('book_room.status','=',1)
            ->count();

        $room_triple = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',3)
            ->where('book_room.status','=',1)
            ->count();

        $totalbooked = $room_single+($room_double*2)+($room_triple*3) ;
        $available   = $total-$totalbooked;

        return $room_single ;
    }
}
