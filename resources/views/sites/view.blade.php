@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
    </section>

  <div class="content">
<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('sites?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('sites/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif

		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('sites/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('sites/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>


	</div>
	<div class="box-body" >

		<table class="table table-striped table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Description', (isset($fields['description']['language'])? $fields['description']['language'] : array())) }}</strong></td>
						<td>{{ $row->description}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Image', (isset($fields['image']['language'])? $fields['image']['language'] : array())) }}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->image,$fields['image'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Featured', (isset($fields['featured']['language'])? $fields['featured']['language'] : array())) }}</strong></td>
						<td>{{ $row->featured}} </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
</div>

@stop
