@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1> {{ Lang::get('core.tandc') }}</h1>
    </section>

  <div class="content">
<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('tandc?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('tandc/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif

		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('tandc/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('tandc/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>


	</div>
	<div class="box-body" >

		<table class="table table-striped table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.title') }}</strong></td>
						<td>{!! $row->title !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right' style="vertical-align:initial"><strong>{{ Lang::get('core.tandc') }}</strong></td>
						<td>{!! $row->tandc !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.created') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->created_at)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.updated') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->updated_at)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.status') }}</strong></td>
						<td>{!! \App\Library\GeneralStatuss::Status($row->status) !!} </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
</div>

@stop
