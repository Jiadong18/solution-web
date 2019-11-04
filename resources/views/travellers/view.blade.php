@extends('layouts.app') @section('content')
<section class="content-header">
    <h1>{{Lang::get('core.travellers')}}</h1>
</section>

<div class="box-header with-border">
    <div class="box-header-tools pull-left">
        <a href="{{ url('travellers?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-left fa-2x"></i></a>
        @if($access['is_add'] ==1)
        <a href="{{ url('travellers/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i> </a>
        <a href="{{ url('createbooking/update?travellerID='.$id)}}" title="{{Lang::get('core.newbooking')}}" class="tips text-blue"><i class="fa fa-suitcase fa-2x"></i></a>
        <a href="{{ url('invoice/update?travellerID='.$id)}}" title="{{Lang::get('core.addnewinvoice')}}" class="tips text-yellow"><i class="fa fa-file-text fa-2x"></i></a>
        <a href="{{ url('payments/update?travellerID='.$id)}}" title="{{Lang::get('core.addnewpayment')}}" onclick="MmbModal(this.href,'{{ Lang::get('core.addnewpayment') }}'); return false;" class="tips text-green"><i class="fa fa-cc-visa fa-2x"></i></a>
        <a href="{{ url('travellersfiles/update?travellerID='.$id)}}" title="{{Lang::get('core.addnewfile')}}" onclick="MmbModal(this.href,'{{ Lang::get('core.addnewfile') }}'); return false;" class="tips text-red"><i class="fa fa-paperclip fa-2x"></i></a> @endif
        <a href="{{ url('travellersnote/update?travellerID='.$id)}}" title="{{Lang::get('core.addnewnote')}}" onclick="MmbModal(this.href,'{{Lang::get('core.addnewnote')}}'); return false;" class="tips text-purple"><i class="fa fa-sticky-note fa-2x"></i></a>
    </div>
    <div class="box-header-tools pull-right ">
        <a href="{{ ($prevnext['prev'] != '' ? url('travellers/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="{{Lang::get('core.previous')}}"><i class="fa fa-arrow-left fa-2x"></i>  </a>
        <a href="{{ ($prevnext['next'] != '' ? url('travellers/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="{{Lang::get('core.next')}}"> <i class="fa fa-arrow-right fa-2x"></i> </a>
        @if(Session::get('gid') ==1) @endif
    </div>
</div>

<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h3 class="text-center">
                @if(file_exists('./uploads/images/'.$row->image) && $row->image !='')
                    {!! \App\Library\SiteHelpers::formatRows($row->image,$fields['image'],$row ) !!}
                @else
                <img src=" {{ asset('/uploads/images/no-image-person.png') }}" />
                @endif
            </h3>
            <h3 class="profile-username text-center">{{ $row->nameandsurname}}</h3>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>{{Lang::get('core.email')}}</b> <a href="mailto:{{ $row->email}}" class="pull-right">{{ $row->email}}</a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.phone')}}</b> <a class="pull-right">{{ $row->phone}} </a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.country')}}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }} </a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.city')}}</b> <a class="pull-right">{{ $row->city }}</a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.address')}}</b>
                </li>
                <li class="list-group-item">
                <a>{{ $row->address}} </a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.interests')}}</b>
                </li>
                <li class="list-group-item">
                    <a>{{ $row->interests}}</a>
                </li>
                <li class="list-group-item">
                    <b>{{Lang::get('core.status')}}</b> <a class="pull-right">{!! \App\Library\GeneralStatuss::Status($row->status) !!}
</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-9">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.travellersdetails')}}</a></li>
            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.bookings')}}</a></li>
            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.invoices')}}</a></li>
            <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.payments')}}</a></li>
            <li><a href="#tab_6" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.m_files')}}</a></li>
            <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i>
 {{Lang::get('core.notes')}}</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="col-md-12">
                    <div class="box-header">
                        <h3 class="box-title with-border">{{Lang::get('core.passport')}}</h3>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.dateofbirth')}}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::TarihFormat($row->dateofbirth)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.dateofissue')}}</b><a class="pull-right">{{ \App\Library\SiteHelpers::TarihFormat($row->passportissue)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.passportcountry')}}</b><a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->passportcountry,'passportcountry','1:def_country:countryID:country_name') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.passportno')}} </b> <a class="pull-right">{{ $row->passportno}} </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.dateofexpiry')}} </b> <a class="pull-right">{{ \App\Library\SiteHelpers::TarihFormat($row->passportexpiry)}}</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-header">
                        <h3 class="box-title with-border">{{Lang::get('core.emergencycontactdetails')}}</h3>
                    </div>
                    <div class="col-md-12">

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.emergencycontact')}}</b> <a class="pull-right">{{ $row->emergencycontactname}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.email')}}</b><a href="mailto:{{$row->emergencycontactemail}}" class="pull-right">{{ $row->emergencycontactemail}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.phone')}}</b><a class="pull-right">{{ $row->emergencycontanphone}} </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-header">
                        <h3 class="box-title with-border">{{Lang::get('core.insurancedetails')}}</h3>
                    </div>
                    <div class="col-md-12">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.insurancecompany')}}</b> <a class="pull-right">{{ $row->insurancecompany}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.insurancepolicyno')}}</b><a class="pull-right">{{ $row->insurancepolicyno}} </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{Lang::get('core.insurancecompanyphone')}}</b> <a class="pull-right">{{ $row->insurancecompanyphone}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-header">
                        <h3 class="box-title with-border">{{Lang::get('core.specialreq')}}</h3>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.bedconfiguration')}}</b> <a class="pull-right">{!! \App\Library\SiteHelpers::formatRows($row->bedconfiguration,$fields['bedconfiguration'],$row ) !!}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{Lang::get('core.dietaryreq')}}</b><a class="pull-right">{{ $row->dietaryrequirements}}</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div style="clear: both;"></div>

            </div>
            <div class="tab-pane" id="tab_2">
                <table id="bookings" class="table  table-striped">
                    <thead>
                        <tr>
                            <th>{{Lang::get('core.bookingno')}}</th>
                            <th>{{Lang::get('core.tour')}}</th>
                            <th>{{Lang::get('core.hotel')}}</th>
                            <th>{{Lang::get('core.flight')}}</th>
                            <th>{{Lang::get('core.car')}}</th>
                            <th>{{Lang::get('core.extraservices')}}</th>
                            <th>{{Lang::get('core.bookingdate')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book as $bk)
                        <tr>
                            <td>
                                <a href="{{ url('createbooking/show/'.$bk['bookingsID'])}}" target="_blank">{{ $bk['bookingno'] }}</a>
                            </td>
                            <td>{!! \App\Library\SiteHelpers::Tour($bk['tour']) !!}</td>
                            <td>{!! \App\Library\SiteHelpers::Hotel($bk['hotel']) !!}</td>
                            <td>{!! \App\Library\SiteHelpers::Flight($bk['flight']) !!}</td>
                            <td>{!! \App\Library\SiteHelpers::Car($bk['car']) !!}</td>
                            <td>{!! \App\Library\SiteHelpers::Extraservices($bk['extraservices']) !!}</td>
                            <td>{{ \App\Library\SiteHelpers::TarihFormat($bk['created_at'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <table id="invoices" class="table  table-striped">
                    <thead>
                        <tr>
                            <th>{{Lang::get('core.invoiceno')}}</th>
                            <th>{{Lang::get('core.bookingno')}}</th>
                            <th>{{Lang::get('core.issuedate')}}</th>
                            <th>{{Lang::get('core.status')}}</th>
                            <th>{{Lang::get('core.duedate')}}</th>
                            <th>{{Lang::get('core.amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invo as $in)
                        <?php $payment=\DB::table('invoice_payments')->where('invoiceID', $in['invoiceID'] )->sum('amount'); ?>
                        <tr>
                            <td>
                                <a href="{{ url('invoice/show/'.$in['invoiceID'])}}" target="_blank">{{ $in['invoiceID'] }}</a>
                            </td>
                            <td><a href="{{ url('createbooking/show/'.$in['bookingID'])}}" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($in['bookingID'],'bookingID','1:bookings:bookingsID:bookingno') }}</a></td>
                            <td>{{ \App\Library\SiteHelpers::TarihFormat($in['DateIssued'])}}</td>
                            <td>{!! \App\Library\InvoiceStatus::Payments( $payment , $in['InvTotal']) !!}</td>
                            <td>{!! \App\Library\InvoiceStatus::paymentstatus($in['DueDate'],$in['status']) !!}</td>
                            <td>{{ \App\Library\SiteHelpers::formatLookUp($in['currency'],'currencyID','1:def_currency:currencyID:currency_sym') }} {{ $in['InvTotal'] }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="tab-pane" id="tab_4">
                <table id="payments" class="table  table-striped">
                    <thead>
                        <tr>
                            <th>{{Lang::get('core.invoiceno')}}</th>
                            <th>{{Lang::get('core.amount')}}</th>
                            <th>{{Lang::get('core.paymenttype')}}</th>
                            <th>{{Lang::get('core.notes')}}</th>
                            <th>{{Lang::get('core.paymentdate')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pay as $pt)
                        <tr>
                            <td><a href="{{ url('invoice/show/'.$pt['invoiceID'])}}" target="_blank">
                            {{ $pt['invoiceID'] }}</a></td>
                            <td>{{ \App\Library\SiteHelpers::formatLookUp($pt['currency'],'currencyID','1:def_currency:currencyID:currency_sym|symbol') }} {{ $pt['amount'] }} </td>
                            <td>{{ \App\Library\SiteHelpers::formatLookUp($pt['payment_type'],'paymenttypeID','1:def_payment_types:paymenttypeID:payment_type') }}</td>
                            <td>{{ $pt['notes'] }}</td>
                            <td>{{ \App\Library\SiteHelpers::TarihFormat($pt['payment_date'])}}</td>
                            <td>@if($access['is_remove'] =='1')
                                <a href="{{ url('travellers/paymentdelete/'.$pt['invoicePaymentID'].'/'.$pt['invoicePaymentID'])}}" class=" pull-right" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-2x text-red"></i></a> @endif @if($access['is_edit'] =='1')
                                <a href="{{ url('payments/update/'.$pt['invoicePaymentID'].'/?travellerID='.$id)}}" onclick="MmbModal(this.href,'{{Lang::get('core.editpayment')}}'); return false;" class=" pull-right tips" title="{{Lang::get('core.editpayment')}}"><i class="fa fa-edit fa-2x text-navy"></i></a> @endif </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab_5">
                <table id="notes" class="table  table-striped">
                    <thead>
                        <tr>
                            <th style="width:10px;"></th>
                            <th>{{Lang::get('core.title')}}</th>
                            <th>{{Lang::get('core.note')}}</th>
                            <th style="width:60px;">{{Lang::get('core.date')}}</th>
                            <th style="width:40px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tnotes as $tn)
                        <tr>
                            <td><a class="text-{{ $tn['style'] }} tips" title="{{ $tn['style'] }}" href="#"><i class="fa fa-square fa-2x"></i></a></td>
                            <td>{{ $tn['title'] }}</td>
                            <td>{{ $tn['note'] }}</td>
                            <td>{{ \App\Library\SiteHelpers::TarihFormat($tn['created_at'])}}</td>
                            <td>@if($access['is_remove'] =='1')
                                <a href="{{ url('travellers/notedelete/'.$tn['travellerID'].'/'.$tn['travellers_noteID'])}}" class=" pull-right" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-2x text-red"></i></a> @endif @if($access['is_edit'] =='1')
                                <a href="{{ url('travellersnote/update/'.$tn['travellers_noteID'].'/?travellerID='.$id)}}" onclick="MmbModal(this.href,'{{Lang::get('core.editnote')}}'); return false;" class=" pull-right tips" title="{{ Lang::get('core.editnote') }}"><i class="fa fa-edit fa-2x text-navy"></i></a> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                        <div class="tab-pane" id="tab_6">
                        <table id="files" class="table  table-striped">
                    <thead>
                        <tr>
                            <th style="width:60px;">{{Lang::get('core.m_files')}}</th>
                            <th style="width:100px;">{{Lang::get('core.filetype')}}</th>
                            <th>{{Lang::get('core.remarks')}}</th>
                            <th style="width:60px;">{{Lang::get('core.date')}}</th>
                            <th style="width:40px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($file as $fl)
                        <tr>
                            <td>{!! \App\Library\SiteHelpers::showUploadedFile($fl['file'],'/uploads/files/') !!}</td>
                            <td>@if($fl['file_type']==1) Passport @elseif ($fl['file_type']==2) ID Card @elseif ($fl['file_type']==3) Photo @elseif ($fl['file_type']==4) Other Documents  @endif</td>
                            <td>{{ $fl['remarks'] }}</td>
                            <td>{{ \App\Library\SiteHelpers::TarihFormat($fl['created_at'])}}</td>
                            <td>@if($access['is_remove'] =='1')
                                <a href="{{ url('travellers/filedelete/'.$fl['travellerID'].'/'.$fl['fileID'])}}" class="pull-right" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-2x text-red "></i></a> @endif @if($access['is_edit'] =='1')
                                <a href="{{ url('travellersfiles/update/'.$fl['fileID'].'/?travellerID='.$id)}}" onclick="MmbModal(this.href,'{{Lang::get('core.editnote')}}'); return false;" class=" pull-right tips" title="{{ Lang::get('core.editfile') }}"><i class="fa fa-edit fa-2x text-navy"></i></a> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                        </div>
        </div>
    </div>
</div>


<div style="clear: both;"></div>

<script>
    $(function() {
        $("#bookings,#invoices,#payments,#notes,#files").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });

            $('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("travellers/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

    });




</script>

<script type="text/javascript">
    $(function() {
        $('.editItem').click(function() {
            $('.displayItem').hide();
            $('.displayEdit').show();
        });
        $('.closeItem').click(function() {
            $('.displayItem').show();
            $('.displayEdit').hide();
        });

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });

    })

</script>

@stop
