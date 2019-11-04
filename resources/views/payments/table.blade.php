<?php usort($tableGrid, "\App\Library\SiteHelpers::_sort"); ?>
<div class="box box-primary">
	<div class="box-header with-border">

		@include( 'mmb/toolbar')
	</div>
	<div class="box-body">



	 {!! (isset($search_map) ? $search_map : '') !!}

	 <?php echo Form::open(array('url'=>'payments/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable'  ,'data-parsley-validate'=>'' )) ;?>
<div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
	@if(count($rowData)>=1)
    <table class="table table-bordered table-striped " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th width="20"> No </th>
				<th width="30"> <input type="checkbox" class="checkall" /></th>
				@if($setting['view-method']=='expand')<th width="50" style="width: 50px;">  </th> @endif
				<th width="50"><?php echo Lang::get('core.btn_action') ;?></th>
                <th >{{Lang::get('core.traveller')}}</th>
				<th >{{Lang::get('core.invoiceno')}}</th>
				<th >{{Lang::get('core.amount')}}</th>
				<th >{{Lang::get('core.paymenttype')}}</th>
                <th >{{Lang::get('core.paymentdate')}}</th>
                <th >{{Lang::get('core.received')}}</th>

			  </tr>
        </thead>

        <tbody>
        	@if($access['is_add'] =='1' && $setting['inline']=='true')
			<tr id="form-0" >
				<td> # </td>
				<td> </td>
				@if($setting['view-method']=='expand') <td> </td> @endif
				<td >
					<button onclick="saved('form-0')" class="btn btn-success btn-xs" type="button"><i class="fa fa-play-circle"></i></button>
				</td>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
					<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(\App\Library\SiteHelpers::filterColumn($limited ))
						<td data-form="{{ $t['field'] }}" data-form-type="{{ \App\Library\AjaxHelpers::inlineFormType($t['field'],$tableForm)}}">
							{!! \App\Library\SiteHelpers::transForm($t['field'] , $tableForm) !!}
						</td>
						@endif
					@endif
				@endforeach

			  </tr>
			  @endif

           		<?php foreach ($rowData as $row) :
           			  $id = $row->invoicePaymentID;
           		?>
                <tr class="editable" id="form-{{ $row->invoicePaymentID }}">
					<td class="number"> <?php echo ++$i;?>  </td>
					<td ><input type="checkbox" class="ids" name="ids[]" value="<?php echo $row->invoicePaymentID ;?>" />  </td>
					@if($setting['view-method']=='expand')
					<td><a href="javascript:void(0)" class="expandable" rel="#row-{{ $row->invoicePaymentID }}" data-url="{{ url('payments/show/'.$id) }}"><i class="fa fa-plus " ></i></a></td>
					@endif
				 <td data-values="action" data-key="<?php echo $row->invoicePaymentID ;?>"  >
					{!! \App\Library\AjaxHelpers::buttonAction('payments',$access,$id ,$setting) !!}
					{!! \App\Library\AjaxHelpers::buttonActionInline($row->invoicePaymentID,'invoicePaymentID') !!}

				</td>
                    <td><a href="{{ url('travellers/show/'.$row->travellerID.'?return='.$return)}}" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:nameandsurname') }}</a></td>
                    <td><a href="{{ url('invoice/show/'.$row->invoiceID.'?return='.$return)}}" target="_blank">{{$row->invoiceID}}</a></td>
					 <td>{{$row->amount}} {{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currencyID','1:def_currency:currencyID:currency_sym') }}</td>
					 <td> {{ \App\Library\SiteHelpers::formatLookUp($row->payment_type,'paymenttypeID','1:def_payment_types:paymenttypeID:payment_type') }}</td>
					 <td>{{ \App\Library\SiteHelpers::TarihFormat($row->payment_date)}}</td>
					 <td>{!! $row->received == 1 ? '<i class="fa fa-fw fa-2x fa-thumbs-up text-green"></i>' : '<i class="fa fa-fw fa-2x fa-times-circle text-red"></i>'  !!}</td>

                </tr>
                @if($setting['view-method']=='expand')
                <tr style="display:none" class="expanded" id="row-{{ $row->invoicePaymentID }}">
                	<td class="number"></td>
                	<td></td>
                	<td></td>
                	<td colspan="{{ $colspan}}" class="data"></td>
                	<td></td>
                </tr>
                @endif
            <?php endforeach;?>

        </tbody>

    </table>
	@else

	<div style="margin:100px 0; text-align:center;">

		<p> {{ Lang::get('core.norecord') }} </p>
	</div>

	@endif

	</div>
	<?php echo Form::close() ;?>
        @include('ajaxfooter')
	</div>
</div>

	@if($setting['inline'] =='true') @include('mmb.module.utility.inlinegrid') @endif
<script>
$(document).ready(function() {
	$('.tips').tooltip();
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});
	$('#{{ $pageModule }}Table .checkall').on('ifChecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
	});
	$('#{{ $pageModule }}Table .checkall').on('ifUnchecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('uncheck');
	});

	$('#{{ $pageModule }}Paginate .pagination li a').click(function() {
		var url = $(this).attr('href');
		reloadData('#{{ $pageModule }}',url);
		return false ;
	});

	<?php if($setting['view-method'] =='expand') :
			echo \App\Library\AjaxHelpers::htmlExpandGrid();
		endif;
	 ?>
});
</script>
<style>
.table th { text-align: none !important;  }
.table th.right { text-align:right !important;}
.table th.center { text-align:center !important;}

</style>
