@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1> {{ Lang::get('core.tours') }}</h1>
    </section>
  <div class="content">
      <div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a>
		</div>
	</div>
	<div class="box-body">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {!! Form::open(array('url'=>'tours/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">

				{!! Form::hidden('tourID', $row['tourID']) !!}
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourname') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='tour_name' id='tour_name' value='{{ $row['tour_name'] }}'
						     class='form-control ' required />
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Category" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourcategory') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='tourcategoriesID' rows='3' id='tourcategoriesID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-3">
										 </div>
									  </div>
                                    <div class="form-group  " >
										<label for="Featured" class=" control-label col-md-4 text-left"> {{ Lang::get('core.featured') }} </label>
										<div class="col-md-7">
										  <?php $featured = explode(",",$row['featured']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='featured[]' value ='1'   class=''
					@if(in_array('1',$featured))checked @endif
					 />  </label>
										 </div>
									  </div>
									  <div class="form-group  departs" >
										<label for="Departs" class=" control-label col-md-4 text-left"> {{ Lang::get('core.departs') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
					<label class='radio radio-inline'>
					<input type='radio' name='departs' value ='1' required @if($row['departs'] == '1') checked="checked" @endif > {{ Lang::get('core.daily') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='departs' value ='2' required @if($row['departs'] == '2') checked="checked" @endif > {{ Lang::get('core.onrequest') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='departs' value ='3' required @if($row['departs'] == '3') checked="checked" @endif > {{ Lang::get('core.setdate') }} </label>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>

                                    <div class="form-group  multicountry" >
										<label for="Multicountry" class=" control-label col-md-4 text-left"> {{ Lang::get('core.multicountry') }} <span class="asterix"> * </span></label>
										<div class="col-md-6 multicountry">
				    <label class='radio radio-inline'>
					<input type='radio' name='multicountry' value ='1'  @if($row['multicountry'] == '1') checked="checked" @endif > {{ Lang::get('core.yes') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='multicountry' value ='0'  @if($row['multicountry'] == '0') checked="checked" @endif > {{ Lang::get('core.no') }} </label>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
                                    <div class="form-group country-select" >
										<label for="Country" class=" control-label col-md-4 text-left">{{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                                    <div class="form-group tourduration" >
										<label for="Total Days" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourduration') }} <span class="asterix"> * </span></label>
										<div class="col-md-2 ">
										  <input  type='text' name='total_days' id='total_days' value='{{ $row['total_days'] }}'
						required     class='form-control ' />
										 </div>
                                <label for="Total Days" class="control-label col-md-1 text-right">{{ Lang::get('core.days') }}</label>
                                          <div class="col-md-2">
<input  type='text' name='total_nights' id='total_nights' value='{{ $row['total_nights'] }}'
						required     class='form-control ' />
										 </div><label class="control-label col-md-1 text-right">{{ Lang::get('core.nights') }}</label>
                                    </div>
									  <div class="form-group  " >
										<label for="Tour Description" class=" control-label col-md-4 text-left"> {{ Lang::get('core.description') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">
										  <textarea name='tour_description' rows='4' id='tour_description' class='form-control editor'
				         required  >{{ $row['tour_description'] }}</textarea>
										 </div>
										 <div class="col-md-1">
										 </div>
									  </div>

									  <div class="form-group  " >
										<label for="Tour Inclusions" class=" control-label col-md-4 text-left"> {{ Lang::get('core.included') }}</label>
										<div class="col-md-6">
										  <select name='inclusions[]' multiple rows='5' id='inclusions' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Similar Tours" class=" control-label col-md-4 text-left"> {{ Lang::get('core.similartours') }} </label>
										<div class="col-md-6">
										  <select name='similartours[]' multiple rows='5' id='similartours' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Payment Options" class=" control-label col-md-4 text-left"> {{ Lang::get('core.paymentoptions') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='payment_options[]' multiple rows='5' id='payment_options' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>

									  <div class="form-group  " >
										<label for="Term & Conditions" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tandc') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='policyandterms' rows='5' id='policyandterms' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
    <div class="form-group  " >
										<label for="Tourimage" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourimage') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
                                <div class="btn btn-primary btn-file"><i class="fa fa-camera fa-2x"></i>
										  <input  type='file' name='tourimage' id='tourimage' @if($row['tourimage'] =='') class='required' @endif style='width:150px !important;'  />
                                            </div>
					 	<div >
						{!! \App\Library\SiteHelpers::showUploadedFile($row['tourimage'],'/uploads/images/') !!}
						</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Gallery" class=" control-label col-md-4 text-left"> {{ Lang::get('core.gallery') }} </label>
										<div class="col-md-6">

					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('gallery')"><i class="fa fa-plus-square fa-2x tips" title="{{ Lang::get('core.addimage') }}" ></i></a>
					<div class="galleryUpl">
					 	<input  type='file' name='gallery[]'  />
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0;
					$row['gallery'] = explode(",",$row['gallery']);
					?>
					@foreach($row['gallery'] as $files)
						@if(file_exists('./uploads/images/'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="list-group-item">
							<a href="{{ url('/uploads/images/'.$files) }}" target="_blank" class="tips" title="{{ $files }}" >{!! \App\Library\SiteHelpers::showUploadedFile($files,'/uploads/images/') !!}</a>
							<span class="removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/images/{{$files}}">
							<i class="fa fa-trash-o fa-2x"                                data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}"></i></span>
							<input type="hidden" name="currgallery[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif

					@endforeach
					</ul>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                                    <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.fr_minactive') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.fr_mactive') }} </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
			</div>




			<div style="clear:both"></div>
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('tours?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>
				  </div>

		 {!! Form::close() !!}
	</div>
</div>
</div>

   <script type="text/javascript">
	$(document).ready(function() {

        $("#countryID").jCombo("{!! url('tourdetail/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });

		$("#tourcategoriesID").jCombo("{!! url('tours/comboselect?filter=def_tour_categories:tourcategoriesID:tourcategoryname&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["tourcategoriesID"] }}' });

		$("#inclusions").jCombo("{!! url('tours/comboselect?filter=def_inclusions:inclusionID:inclusion') !!}",
		{  selected_value : '{{ $row["inclusions"] }}' });

		$("#similartours").jCombo("{!! url('tours/comboselect?filter=tours:tourID:tour_name') !!}",
		{  selected_value : '{{ $row["similartours"] }}' });

		$("#payment_options").jCombo("{!! url('tours/comboselect?filter=def_payment_types:paymenttypeID:payment_type&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["payment_options"] }}' });

		$("#policyandterms").jCombo("{!! url('tours/comboselect?filter=termsandconditions:tandcID:title&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["policyandterms"] }}' });


		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("tours/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});


    $("input[name='total_days'], input[name='total_nights']").TouchSpin();

    $('.country-select').hide();
    $('.multicountry').hide();

	$('.departs input:radio').on('ifClicked', function() {
	 	 val = $(this).val();
  			dPrts(val);
	});

	$('.multicountry input:radio').on('ifClicked', function() {
	 	 val = $(this).val();
  			mCntry(val);
	});

	dPrts('<?php echo $row['departs'] ?>');
	mCntry('<?php echo $row['multicountry'] ?>');


});

function dPrts( val )
{
		if(val == '1') {
            $('.multicountry').show();
            $('.country-select').hide();


		}
		if(val == '2') {
            $('.multicountry').show();
            $('.country-select').hide();

		}
		if(val == '3') {
            $('.multicountry').show();
			$('.country-select').hide();

		}
}

function mCntry( val )
{
		if(val == '1') {
			$('.country-select').hide();
		}
		if(val == '0') {
			$('.country-select').show();
		}
}


    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });


</script>


@stop
