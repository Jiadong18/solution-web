<?php


namespace App\Library;


use Illuminate\Support\Facades\Lang;

class ReviewStatus
{
    static public function status($status)
    {

        if ($status ==0)
        {
            return '<span class="label label-danger">'.Lang::get('core.new').'</span>';

        }elseif($status ==1)

        {
            return '<span class="label label-success">'.Lang::get('core.approved').'</span>';
        }

    }
}
