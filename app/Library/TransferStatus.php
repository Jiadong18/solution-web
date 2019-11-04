<?php


namespace App\Library;


use Illuminate\Support\Facades\Lang;

class TransferStatus
{
    static public function status($status)
    {

        if ($status ==0)
        {
            return '<span class="label label-danger">'.Lang::get('core.cancelled').'</span>';

        }elseif($status ==1)

        {
            return '<span class="label label-success">'.Lang::get('core.completed').'</span>';
        }elseif($status ==2)

        {
            return '<span class="label label-warning">'.Lang::get('core.waiting').'</span>';
        }


    }
}
