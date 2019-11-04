@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1> {{ Lang::get('core.travelagents') }}</h1>
    </section>

	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('travelagents?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('travelagents/update/'.$id.'?return='.$return) }}" class="tips text-green" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif
            @if($access['is_edit'] =='1')
            <a href="{{ url('agents/update?travel_agency='.$id)}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.addnewagent') }}'); return false;"  class="tips text-blue" title="{{ Lang::get('core.addnewagent') }}"><i class="fa fa-user-plus fa-2x"></i></a>
            <a href="{{ url('travelagentnote/update?travelagentID='.$id)}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.addnewnote') }}'); return false;"  class="tips text-yellow" title="{{ Lang::get('core.addnewnote') }}"><i class="fa fa-sticky-note fa-2x"></i></a>
            @endif


		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('travelagents/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.previousagent') }}"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('travelagents/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.nextagent') }}"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>


	</div>
    <div class="col-md-4">
                    		<div class="box box-primary">
            <div class="box-body box-profile">
<h3 class="text-center">{!! \App\Library\SiteHelpers::formatRows($row->agent_logo,$fields['agent_logo'],$row ) !!} </h3>
              <h3 class="profile-username text-center">{{ $row->agency_name}}</h3>
              <p class=" text-center">{{ $row->legalname }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{{ Lang::get('core.email') }}</b> <a href="mailto:{{ $row->email}}" class="pull-right">{{ $row->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>{{ Lang::get('core.website') }}</b> <a href="http://{{ $row->website}}" target="_blank" class="pull-right">{{ $row->website}} </a>
                </li>
                <li class="list-group-item">
                    <b>{{ Lang::get('core.agencylicencecode') }}</b> <a class="pull-right">{{ $row->agency_licence_code}}</a>
                </li>
                <li class="list-group-item">
                    <b>{{ Lang::get('core.agencycode') }}</b> <a class="pull-right">{{ $row->agency_code}}</a>
                </li>
                <li class="list-group-item">
                    <b>{{ Lang::get('core.personincontact') }}</b> <a class="pull-right">{{ $row->personincontact}}</a>
                </li>
                <li class="list-group-item">
                    <b>{{ Lang::get('core.mobilephone') }}</b> <a class="pull-right">{{ $row->mobilephone}}</a>
                </li>
                <li class="list-group-item">
                  <b>{{ Lang::get('core.phone') }}</b> <a class="pull-right">{{ $row->phone}}  </a>
                </li>
                  <li class="list-group-item">
                  <b>{{ Lang::get('core.fax') }}</b> <a class="pull-right">{{ $row->fax}}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{ Lang::get('core.country') }}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{ Lang::get('core.city') }}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{ Lang::get('core.address') }}</b>
                </li>
                  <li class="list-group-item">
                  <a>{{ $row->address}}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{ Lang::get('core.status') }}</b> <a class="pull-right">{!! \App\Library\GeneralStatuss::Status($row->status) !!}</a>
                </li>
              </ul>

             </div>
          </div>
            </div>
            <div class="col-md-8">
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#agent" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i> {{ Lang::get('core.travelagents') }}</a></li>
              <li><a href="#note" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i> {{ Lang::get('core.notes') }}</a></li>
              <li><a href="#bankdetails" data-toggle="tab"><i class="fa fa-square text-green" aria-hidden="true"></i> {{ Lang::get('core.bankdetails') }}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="agent">
                  <table id="agents" class="table table-striped">
                <thead>
                <tr>
                  <th>{{ Lang::get('core.name') }}</th>
                  <th>{{ Lang::get('core.agentcode') }}</th>
                  <th>{{ Lang::get('core.email') }}</th>
                  <th>{{ Lang::get('core.phone') }}</th>
                  <th>{{ Lang::get('core.location') }}</th>
                  <th>{{ Lang::get('core.status') }}</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
             @foreach($agent as $ag)
                <tr>
                  <td>{{ $ag['agent_name'] }}</td>
                  <td>{{ $ag['agent_code'] }}</td>
                  <td><a href="mailto:{{ $ag['email'] }}">{{ $ag['email'] }}</a></td>
                  <td>{{ $ag['phone'] }}</td>
                  <td>{{ $ag['location'] }}</td>
                  <td>{!! \App\Library\GeneralStatuss::Status($ag['status']) !!}</td>
                  <td>@if($access['is_remove'] =='1')
<a href="{{ url('travelagents/agentdelete/'.$ag['agentID'].'/'.$id)}}"  class="text-red pull-right " data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-2x"></i></a>
					@endif
					@if($access['is_edit'] =='1')
					 <a href="{{ url('agents/update/'.$ag['agentID'].'/?travelagentID='.$id)}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.editagent') }}'); return false;"  class="text-blue pull-right tips" title="{{ Lang::get('core.editagent') }}"><i class="fa fa-edit fa-2x"></i></a>
					@endif </td>
                </tr>
            @endforeach
                </tbody>
              </table>
              </div>
              <div class="tab-pane" id="note">


            <table id="notes" class="table table-striped">
                <thead>
                <tr>
                  <th style="width:10px;"></th>
                  <th>{{ Lang::get('core.title') }}</th>
                  <th>{{ Lang::get('core.note') }}</th>
                  <th style="width:60px;">{{ Lang::get('core.date') }}</th>
                  <th style="width:40px;"></th>
                </tr>
                </thead>
                <tbody>
             @foreach($note as $nt)
                <tr>
                  <td><a class="text-{{ $nt['style'] }} tips" title="{{ $nt['style'] }}" href="#"><i class="fa fa-square fa-2x"></i></a></td>
                  <td>{{ $nt['title'] }}</td>
                  <td>{{ $nt['note'] }}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($nt['created_at'])}}</td>
                  <td>@if($access['is_remove'] =='1')
<a href="{{ url('travelagents/notedelete/'.$nt['travelagentnoteID'].'/'.$id)}}"  class="text-red pull-right" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-2x"></i></a>
					@endif
					@if($access['is_edit'] =='1')
					 <a href="{{ url('travelagentnote/update/'.$nt['travelagentnoteID'].'/?travelagentID='.$id)}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.editnote') }}'); return false;"  class="text-blue pull-right tips" title="{{ Lang::get('core.editnote') }}"><i class="fa fa-edit fa-2x"></i></a>
					@endif
</td>
                </tr>
            @endforeach
                </tbody>
              </table>
              </div>
                <div class="tab-pane" id="bankdetails">

<div class="box-body">
              <dl class="dl-horizontal">
                <dt>{{ Lang::get('core.bankname') }}</dt>
                <dd>{{ $row->bankname}}</dd>
                <dt>{{ Lang::get('core.ibancode') }}</dt>
                <dd>{{ $row->ibancode}}</dd>
                <dt>{{ Lang::get('core.holdername') }}</dt>
                <dd>{{ $row->holder_name}}</dd>
                <dt>{{ Lang::get('core.vatno') }}</dt>
                <dd>{{ $row->vatno}}</dd>
                <dt>{{ Lang::get('core.commisionrate') }}</dt>
                <dd>{{ $row->commissionrate}} %</dd>

              </dl>
            </div>
              </div>
            </div>
          </div>
	              </div>
		<div class="clr clear"></div>


<script>
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

  $(function () {
    $("#agents").DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true
    });
    $("#notes").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>
@stop
