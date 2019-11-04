@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}

    <section class="content-header">
      <h1>{{ Lang::get('core.users') }}</h1>
    </section>
	<ul class="parsley-error-list">
	</ul>

<div class="content">
	@include('mmb.config.tab')
<div class="col-md-9">
<div class="box box-primary ">
	<div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">
	 {!! Form::open(array('url'=>'core/users/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped table-bordered" id="UserTable">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th >{{ Lang::get('core.btn_action') }}</th>
				<th >{{ Lang::get('core.image') }}</th>
				<th >{{ Lang::get('core.group') }}</th>
				<th >{{ Lang::get('core.username') }}</th>
				<th >{{ Lang::get('core.namesurname') }}</th>
				<th >{{ Lang::get('core.email') }}</th>
				<th >{{ Lang::get('core.m_membersince') }}</th>
				<th >{{ Lang::get('core.lastlogin') }}</th>
				<th >{{ Lang::get('core.status') }}</th>
			  </tr>
        </thead>

        <tbody>

            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>
					<td>
						 	@if($access['is_detail'] ==1)
							<a href="{{ URL::to('core/users/show/'.$row->id.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i></a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ URL::to('core/users/update/'.$row->id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i></a>
							@endif

					</td>
                    <td>	<?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?>
							<img alt="" src="https://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
							<?php } ?>
                    </td>
                    <td>{{ $row->group_id}}</td>
                    <td>{{ $row->username}}</td>
                    <td>{{ $row->first_name}} {{ $row->last_name}}</td>
                    <td>{{ $row->email}}</td>
                    <td>{{ \App\Library\SiteHelpers::TarihFormat(Session::get('join'))}}</td>
                    <td>{{ \App\Library\SiteHelpers::TarihFormat(Session::get('ll'))}}</td>
                    <td>@if($row->active ==1)
					 			<lable class="label label-success">{{ Lang::get('core.fr_mactive') }}</label>
					 		@elseif($row->active ==2)
					 			<lable class="label label-danger"> {{ Lang::get('core.pending') }} </label>
					 		@else
					 			<lable class="label label-warning">{{ Lang::get('core.fr_minactive') }}</label>
					 		@endif
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	</div>
</div>

</div>
</div>
                  			<div style="clear: both;"></div>

<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ URL::to("core/users/multisearch")}}');
		$('#MmbTable').submit();
	});

});
</script>
<script>
  $(function () {
    $('#UserTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "lengthMenu": [ [25, 50, -1], [25, 50, "All"] ],
      "autoWidth": true

    });
  });
</script>




@stop
