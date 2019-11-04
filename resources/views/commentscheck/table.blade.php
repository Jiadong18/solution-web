<?php usort($tableGrid, "\App\Library\SiteHelpers::_sort"); ?>
<div class="box box-primary">
	<div class="box-header with-border">

		@include( 'mmb/toolbar')
	</div>
	<div class="box-body">

	 {!! (isset($search_map) ? $search_map : '') !!}

	 <?php echo Form::open(array('url'=>'commentscheck/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable'  ,'data-parsley-validate'=>'' )) ;?>
<div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
	@if(count($rowData)>=1)
    <table class="table table-bordered table-striped " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th width="20"> No </th>
				<th width="30"> <input type="checkbox" class="checkall" /></th>
				@if($setting['view-method']=='expand')<th width="50" style="width: 50px;">  </th> @endif
				<th width="50"><?php echo Lang::get('core.btn_action') ;?></th>
                <th>{{ Lang::get('core.pageID') }}</th>
                <th>{{ Lang::get('core.namesurname') }}</th>
                <th>{{ Lang::get('core.comment') }}</th>
                <th>{{ Lang::get('core.created') }}</th>
                <th>{{ Lang::get('core.status') }}</th>
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
			  </tr>
			  @endif

           		<?php foreach ($rowData as $row) :
           			  $id = $row->commentID;
           		?>
                <tr class="editable" id="form-{{ $row->commentID }}">
					<td class="number"> <?php echo ++$i;?>  </td>
					<td ><input type="checkbox" class="ids" name="ids[]" value="<?php echo $row->commentID ;?>" />  </td>
					@if($setting['view-method']=='expand')
					<td><a href="javascript:void(0)" class="expandable" rel="#row-{{ $row->commentID }}" data-url="{{ url('commentscheck/show/'.$id) }}"><i class="fa fa-plus " ></i></a></td>
					@endif
				 <td data-values="action" data-key="<?php echo $row->commentID ;?>"  >
					{!! \App\Library\AjaxHelpers::buttonAction('commentscheck',$access,$id ,$setting) !!}
					{!! \App\Library\AjaxHelpers::buttonActionInline($row->commentID,'commentID') !!}

				</td>
                    <td><a href="" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($row->pageID,'pageID','1:tb_pages:pageID:title') }}</a></td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->userID,'id','1:tb_users:id:username') }}</td>
                    <td>{{ $row->comments }}</td>
                    <td>{{ \App\Library\SiteHelpers::TarihFormat($row->posted) }}</td>
                    <td>{!! $row->approved == 1 ? '<i class="fa fa-fw fa-2x fa-thumbs-up text-green tips" title="'.Lang::get('core.approved').'"></i>' : '<i class="fa fa-fw fa-2x fa-times-circle text-red tips" title="'.Lang::get('core.notapproved').'"></i>'  !!}</td>
                </tr>
                @if($setting['view-method']=='expand')
                <tr style="display:none" class="expanded" id="row-{{ $row->commentID }}">
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



