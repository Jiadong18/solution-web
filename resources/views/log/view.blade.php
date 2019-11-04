@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>{{ Lang::get('core.log') }}</h1>
    </section>

  <div class="content">
@include('mmb.config.tab')
<div class="col-md-9">

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('log?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('log/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif
		</div>
		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('log/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('log/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>
	</div>
	<div class="box-body" >
		<table class="table table-striped table-bordered" >
			<tbody>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.ip') }}</strong></td>
						<td>{{ $row->ipaddress}} </td>
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.username') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->user_id,'user_id','1:tb_users:id:username|first_name|last_name') }} </td>
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.module') }}</strong></td>
						<td>{{ $row->module}} </td>
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.task') }}</strong></td>
						<td>{{ $row->task}} </td>
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.note') }}</strong></td>
						<td>{{ $row->note}} </td>
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.logdate') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->logdate)}} </td>
					</tr>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
	                    			<div style="clear: both;"></div>

@stop
