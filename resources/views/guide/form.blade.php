@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ Lang::get('core.guides') }}</h1>
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

		 {!! Form::open(array('url'=>'guide/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">

				{!! Form::hidden('guideID', $row['guideID']) !!}
									  <div class="form-group  " >
										<label for="Name & Surname" class=" control-label col-md-4 text-left"> {{ Lang::get('core.namesurname') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='name' id='name' value='{{ $row['name'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Email" class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Mobilephone" class=" control-label col-md-4 text-left"> {{ Lang::get('core.mobilephone') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='mobilephone' id='mobilephone' value='{{ $row['mobilephone'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                                    <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>

									  <div class="form-group  " >
										<label for="City" class=" control-label col-md-4 text-left"> {{ Lang::get('core.city') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='cityID' rows='5' id='cityID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                                        <div class="form-group  " >
										<label for="Address" class=" control-label col-md-4 text-left"> {{ Lang::get('core.address') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <textarea name='address' rows='3' id='address' class='form-control '
				         required  >{{ $row['address'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>

									  <div class="form-group  " >
										<label for="License No" class=" control-label col-md-4 text-left"> {{ Lang::get('core.licenseno') }} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  <input  type='text' name='license_no' id='license_no' value='{{ $row['license_no'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="LanguageID" class=" control-label col-md-4 text-left"> {{ Lang::get('core.spokenlanguages') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='languageID[]' multiple rows='5' id='languageID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="CV" class=" control-label col-md-4 text-left"> {{ Lang::get('core.cv') }} </label>
										<div class="col-md-6">
										  <textarea name='CV' rows='5' id='editor' class='form-control editor '
						 >{{ $row['CV'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left">  </label>
										<div class="col-md-6">
										  <div class="btn btn-primary btn-file tips" title="{{ Lang::get('core.image') }}"><i class="fa fa-camera fa-2x"></i>
                                              <input  type='file' name='image' id='image' @if($row['image'] =='') class='required' @endif style='width:150px !important;'  />
                                            </div>
					 	<div >
                        @if(file_exists('./uploads/images/'.$row['image']) && $row['image'] !='')
                        <span class="pull-left removeMultiFiles "  url="/uploads/images/{{$row['image']}}">
							<i class="fa fa-trash-o fa-2x text-red "
                               data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" >
                            </i></span>
                            {!! \App\Library\SiteHelpers::showUploadedFile($row['image'],'/uploads/images/') !!}
                        @endif

						</div>

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
					<button type="button" onclick="location.href='{{ URL::to('guide?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>
				  </div>

		 {!! Form::close() !!}
	</div>
</div>
</div>

   <script type="text/javascript">
	$(document).ready(function() {


		$("#cityID").jCombo("{!! url('guide/comboselect?filter=def_city:cityID:city_name&limit=WHERE:status:=:1') !!}&parent=countryID:",
		{  parent: '#countryID', selected_value : '{{ $row["cityID"] }}' });

		$("#countryID").jCombo("{!! url('guide/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });

		$("#languageID").jCombo("{!! url('guide/comboselect?filter=def_languages:languageID:language_name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["languageID"] }}' });


		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("guide/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});
            $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });


	});
	</script>
@stop
