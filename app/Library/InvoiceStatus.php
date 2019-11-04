<?php


namespace App\Library;


use Illuminate\Support\Facades\Lang;

class InvoiceStatus
{
    static function status($status)
    {

        if ($status ==0)
        {
            return '<button type="button" class="btn btn-block btn-xs btn-danger" >'.Lang::get('core.notpaid').'</button>';

        }elseif($status ==1)

        {
            return '<button type="button" class="btn btn-block btn-xs btn-success" >'.Lang::get('core.paid').'</button>';
        }elseif($status ==2)

        {
            return '<button type="button" class="btn btn-block btn-xs btn-warning" >'.Lang::get('core.pending').'</button>';
        }


    }

    static function payments($payment , $InvTotal)
    {

        if ($payment ==0)
        {
            return '<button type="button" class="btn btn-block btn-xs btn-danger">'.Lang::get('core.nopaymentmade').'</button>';

        }elseif($payment == $InvTotal)

        {
            return '<button type="button" class="btn btn-block btn-xs btn-success" >'.Lang::get('core.fullypaid').'</button>';
        } elseif($payment < $InvTotal)

        {
            return '<button type="button" class="btn btn-block btn-xs btn-warning " >'.Lang::get('core.partiallypaid').'</button>';
        }

    }

    static function paymentstatus($Due)
    {
        $monthago = Carbon::parse($Due)->subDays(30);
        $DueDate  = Carbon::parse($Due);
        $today    = Carbon::today();

        if ($DueDate > $today)
        {
            if ($today >= $monthago )
            {
                return '<button type="button" class="btn btn-xs btn-warning tips" title="'.$DueDate->diffForHumans($today).'" >'.$DueDate->format("".CNF_DATE."").'</button>';
            }

            else
            {
                return '<button type="button" class="btn btn-xs btn-success tips" title="'.$DueDate->diffForHumans($today).'">'.$DueDate->format("".CNF_DATE."").'</button>';
            }

        }elseif($DueDate < $today)

        {
            return '<button type="button" class="btn btn-xs btn-danger tips" title="'.$DueDate->diffForHumans($today).'" >'.$DueDate->format("".CNF_DATE."").'</span>';
        }

        elseif($DueDate == $today)

        {
            return '<button type="button" class="btn btn-xs btn-info tips" title="'.Lang::get('core.today').'">'.Lang::get('core.today').'</span>';
        }

    }
}
