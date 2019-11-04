@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1>{{ Lang::get('core.support') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'support/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th style="width: 50px;">{{ Lang::get('core.btn_action') }}</th>
				<th style="width: 50px;">{{ Lang::get('core.priority') }}</th>
				<th style="width: 30px;">{{ Lang::get('core.status') }}</th>
				<th>{{ Lang::get('core.title') }}</th>
				<th>{{ Lang::get('core.user') }}</th>
				<th>{{ Lang::get('core.category') }}</th>
				<th style="width: 100px;">{{ Lang::get('core.created') }}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->TicketID }}" />  </td>
					<td>

						 	@if($access['is_detail'] ==1)
							<a href="{{ url('support/show/'.$row->TicketID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ url('support/update/'.$row->TicketID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif

					</td>
                    <td>@if     ($row->Priority =='0') <button type="button" class="btn btn-outline btn-info btn-block">{{ Lang::get('core.low') }}</button>
                        @elseif ($row->Priority =='1') <button type="button" class="btn btn-outline btn-warning btn-block">{{ Lang::get('core.normal') }}</button>
                        @elseif ($row->Priority =='2') <button type="button" class="btn btn-outline btn-danger btn-block">{{ Lang::get('core.critical') }}</button>
                        @endif</td>
                    <td>@if ($row->Status =='New') <button type="button" class="btn btn-sm btn-danger btn-block"> {{ Lang::get('core.new') }} </button>
                        @elseif ($row->Status =='Completed') <button type="button" class="btn btn-sm btn-success btn-block"> {{ Lang::get('core.completed') }} </button>
                        @elseif ($row->Status =='Pending') <button type="button" class="btn btn-sm btn-warning btn-block"> {{ Lang::get('core.pending') }} </button>
                        @elseif ($row->Status =='Processed') <button type="button" class="btn btn-sm btn-info btn-block"> {{ Lang::get('core.processed') }} </button>
                        @endif</td>
                    <td>{{ $row->Title }}</td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->UserID,'UserID','1:tb_users:id:username') }}</td>
                    <td>@if ($row->Category =='1') Tour @elseif ($row->Category =='2') Hotel @elseif ($row->Category =='3') Flight @elseif ($row->Category =='4') Rent a Car @elseif ($row->Category =='5') Extra Services @endif
                        </td>
                    <td>{{ \App\Library\SiteHelpers::TarihFormat($row->createdOn)}}</td>
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
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ url("support/multisearch")}}');
		$('#MmbTable').submit();
	});

	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});

	$('#{{ $pageModule }}Table .checkall').on('ifChecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
	});

	$('.copy').click(function() {
		var total = $('input[class="ids"]:checkbox:checked').length;
		if(confirm('are u sure Copy selected rows ?'))
		{
				$('#MmbTable').attr('action','{{ url("support/copy")}}');
				$('#MmbTable').submit();// do the rest here
		}
	})

});
</script>
<style>
.table th , th { text-align: none !important;  }
.table th.right { text-align:right !important;}
.table th.center { text-align:center !important;}

</style>

<script>
  $(function () {
    $('#{{ $pageModule }}Table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

@stop
