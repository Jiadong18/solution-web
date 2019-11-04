<?php usort($tableGrid, "\App\Library\SiteHelpers::_sort"); ?>
<div class="box box-primary">
	<div class="box-header with-border">

		@include( 'mmb/toolbar')
	</div>
	<div class="box-body">

	 {!! (isset($search_map) ? $search_map : '') !!}

	 <?php echo Form::open(array('url'=>'travellersfiles/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable'  ,'data-parsley-validate'=>'' )) ;?>
<div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
	@if(count($rowData)>=1)
    <table class="table table-bordered table-striped " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th width="20"> No </th>
				<th width="30"> <input type="checkbox" class="checkall" /></th>
				@if($setting['view-method']=='expand')<th width="50" style="width: 50px;">  </th> @endif
				<th width="50"><?php echo Lang::get('core.btn_action') ;?></th>
				<th>{{Lang::get('core.namesurname')}}</th>
				<th>{{Lang::get('core.documenttype')}}</th>
				<th>{{Lang::get('core.m_files')}}</th>
				<th>{{Lang::get('core.remarks')}}</th>
				<th>{{Lang::get('core.created')}}</th>
				<th>{{Lang::get('core.updated')}}</th>

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
           			  $id = $row->fileID;
           		?>
                <tr class="editable" id="form-{{ $row->fileID }}">
					<td class="number"> <?php echo ++$i;?>  </td>
					<td ><input type="checkbox" class="ids" name="ids[]" value="<?php echo $row->fileID ;?>" />  </td>
					@if($setting['view-method']=='expand')
					<td><a href="javascript:void(0)" class="expandable" rel="#row-{{ $row->fileID }}" data-url="{{ url('travellersfiles/show/'.$id) }}"><i class="fa fa-plus " ></i></a></td>
					@endif
				 <td data-values="action" data-key="<?php echo $row->fileID ;?>"  >
					{!! \App\Library\AjaxHelpers::buttonAction('travellersfiles',$access,$id ,$setting) !!}
					{!! \App\Library\AjaxHelpers::buttonActionInline($row->fileID,'fileID') !!}

				</td>
					 <td><a href="{{ url('travellers/show/'.$row->travellerID)}}" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:nameandsurname') }}</a></td>
					 <td>@if ($row->file_type == 1) {{Lang::get('core.passport')}} @elseif ($row->file_type == 2) {{Lang::get('core.idcard')}} @elseif ($row->file_type == 3) {{Lang::get('core.photo')}} @elseif ($row->file_type == 1) {{Lang::get('core.otherdocuments')}} @endif</td>
					 <td>{!! \App\Library\SiteHelpers::showUploadedFile($row->file,'/uploads/images/') !!}</td>
					 <td>{{$row->remarks }}</td>
					 <td>{{ \App\Library\SiteHelpers::TarihFormat($row->created_at)}}</td>
					 <td>{{ \App\Library\SiteHelpers::TarihFormat($row->updated_at)}}</td>
                </tr>
                @if($setting['view-method']=='expand')
                <tr style="display:none" class="expanded" id="row-{{ $row->fileID }}">
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

		<p> {{Lang::get('core.norecord')}} </p>
	</div>

	@endif

	</div>
	<?php echo Form::close() ;?>
<!--
        @include('ajaxfooter')
-->

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

<script>
  $(function () {
    $('#{{ $pageModule }}Table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>



