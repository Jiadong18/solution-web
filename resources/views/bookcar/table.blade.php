<?php usort($tableGrid, "\App\Library\SiteHelpers::_sort"); ?>
@include('mmb.bookingmenu')
<div class="box box-primary col-md-12">
	<div class="box-header with-border">

		@include( 'mmb/toolbar')
	</div>
	<div class="box-body">

	 {!! (isset($search_map) ? $search_map : '') !!}

	 <?php echo Form::open(array('url'=>'bookcar/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable'  ,'data-parsley-validate'=>'' )) ;?>
<div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
	@if(count($rowData)>=1)
    <table class="table table-bordered table-striped " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th width="20"> No </th>
				<th width="30"> <input type="checkbox" class="checkall" /></th>
				@if($setting['view-method']=='expand')<th width="50" style="width: 50px;">  </th> @endif
				<th width="50"><?php echo Lang::get('core.btn_action') ;?></th>
				<th>{{Lang::get('core.bookingno')}}</th>
				<th>{{Lang::get('core.brand')}}</th>
				<th>{{Lang::get('core.model')}}</th>
				<th>{{Lang::get('core.start')}}</th>
				<th>{{Lang::get('core.end')}}</th>
				<th>{{Lang::get('core.rate')}}</th>
				<th>{{Lang::get('core.pickup')}}</th>
				<th>{{Lang::get('core.dropoff')}}</th>
				<th>{{Lang::get('core.created')}}</th>
				<th>{{Lang::get('core.status')}}</th>
			  </tr>
        </thead>

        <tbody>
           		<?php foreach ($rowData as $row) :
           			  $id = $row->bookcarID;
           		?>
                <tr class="editable" id="form-{{ $row->bookcarID }}">
					<td class="number"> <?php echo ++$i;?>  </td>
					<td ><input type="checkbox" class="ids" name="ids[]" value="<?php echo $row->bookcarID ;?>" />  </td>
					@if($setting['view-method']=='expand')
					<td><a href="javascript:void(0)" class="expandable" rel="#row-{{ $row->bookcarID }}" data-url="{{ url('bookcar/show/'.$id) }}"><i class="fa fa-plus " ></i></a></td>
					@endif
				 <td data-values="action" data-key="<?php echo $row->bookcarID ;?>"  >
					{!! \App\Library\AjaxHelpers::buttonAction('bookcar',$access,$id ,$setting) !!}
					{!! \App\Library\AjaxHelpers::buttonActionInline($row->bookcarID,'bookcarID') !!}

				</td>
					 <?php foreach ($tableGrid as $field) :
					 	if($field['view'] =='1') :
							$value = \App\Library\SiteHelpers::formatRows($row->{$field['field']}, $field , $row);
						 	?>
						 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
						 	@if(\App\Library\SiteHelpers::filterColumn($limited ))
								 <td align="<?php echo $field['align'];?>" data-values="{{ $row->{$field['field']} }}" data-field="{{ $field['field'] }}" data-format="{{ htmlentities($value) }}">
									{!! $value !!}
								 </td>
							@endif
						 <?php endif;
						endforeach;
					  ?>
                </tr>
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
