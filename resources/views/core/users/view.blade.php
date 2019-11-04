@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>{{ Lang::get('core.m_users') }}</h1>
</section>
 <div class="content">
	@include('mmb.config.tab')
<div class="col-sm-9">
<div class="box box-primary ">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			<a href="{{ url('core/users?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a>
		</div>
		<div class="box-header-tools " >
			@if(Session::get('gid') ==1)

			@endif
		</div>

	</div>
	<div class="box-body">
	<table class="table table-striped table-bordered" >
		<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.image') }}</strong></td>
						<td>
							<?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?>
							<img alt="" src="https://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
							<?php } ?>
						</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.group') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::gridDisplayView($row->group_id,'group_id','1:tb_groups:group_id:name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.username') }}</strong></td>
						<td class='label-view text-left'>{{ $row->username }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.firstname') }}</strong></td>
						<td>{{ $row->first_name }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.lastname') }}</strong></td>
						<td>{{ $row->last_name }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.email') }}</strong></td>
						<td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a> </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.created') }}</strong></td>
						<td>{{ $row->created_at }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.lastlogin') }}</strong></td>
						<td>{{ $row->last_login }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.updated') }}</strong></td>
						<td>{{ $row->updated_at }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.status') }}</strong></td>
						<td>{!! ($row->active ==1 ? '<lable class="label label-success">'.Lang::get('core.fr_mactive').'</label>' : '<lable class="label label-danger">'.Lang::get('core.fr_minactive').'</label>')  !!} </td>

					</tr>

		</tbody>
	</table>

	</div>
</div>


</div>
</div>
		<div style="clear:both;"></div>


@stop
