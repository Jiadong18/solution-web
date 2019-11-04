<form method="POST" id="editForm"
	  accept-charset="UTF-8" class="form-horizontal" parsley-validate="" novalidate=" "
	  enctype="multipart/form-data" action="{{route('staffs.update',$staff->staffID)}}">
	@csrf
	<div class="col-md-12">
		<fieldset>
			<legend> {{ Lang::get('core.staffs') }}</legend>
			<div class="form-group  ">
				<label for="Staff type"
					   class=" control-label col-md-4 text-left">{{ Lang::get('core.stafftype') }}<span
							class="asterix"> * </span></label>
				<div class="col-md-6">
					<select name='stafftypeID' rows='5' id='stafftypeID' class='select2 ' required>

						<option value="">-- Please Select --</option>
						@foreach($staff_types as $st)
							<option {{$staff->stafftypeID==$st->stafftypeID?'selected':''}} value="{{$st->stafftypeID}}">{{$st->staff_type}}</option>
						@endforeach

					</select>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Supplier Name"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.staffname') }}
					<span class="asterix"> * </span></label>
				<div class="col-md-6">
					<input type='text' name='name' id='name' value='{{$staff->name}}'
						   required class='form-control '/>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Email"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }} <span
							class="asterix"> * </span></label>
				<div class="col-md-6">
					<input type='text' name='email' id='email' value='{{$staff->email}}'
						   required class='form-control '/>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Phone"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.phone') }} </label>
				<div class="col-md-6">
					<input type='text' name='phone' id='phone' value='{{$staff->phone}}'
						   class='form-control '/>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Address"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.address') }} </label>
				<div class="col-md-6">
										  <textarea name='address' rows='5' id='address' class='form-control '
										  >{!! $staff->address !!}</textarea>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Country"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }} <span
							class="asterix"> * </span></label>
				<div class="col-md-6">
					<select name='countryID' rows='5' id='countryID' class='select2 ' required>

						<option value="">-- Please Select --</option>
						@foreach($countries as $country)
							<option {{$staff->countryID==$country->countryID?'selected':''}} value="{{$country->countryID}}">{{$country->country_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="City"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.city') }} <span
							class="asterix"> * </span></label>
				<div class="col-md-6">
					<select name='cityID' rows='5' id='cityID' class='select2 ' required>

						<option value="">-- Please Select --</option>
						@foreach($cities as $city)
							<option  {{$staff->cityID==$city->cityID?'selected':''}} value="{{$city->cityID}}">{{$city->city_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="form-group  ">
				<label for="Status"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span
							class="asterix"> * </span></label>
				<div class="col-md-6">

					<label class='radio radio-inline'>
						<input type='radio' name='status' value='0' required
							   @if($staff['status'] == 0) checked="checked" @endif > {{ Lang::get('core.fr_minactive') }}
					</label>
					<label class='radio radio-inline'>
						<input type='radio' name='status' value='1' required
							   @if($staff['status'] == 1) checked="checked" @endif > {{ Lang::get('core.fr_mactive') }}
					</label>
				</div>
				<div class="col-md-2">

				</div>
			</div>
		</fieldset>
	</div>


	<div style="clear:both"></div>

	<div class="form-group">
		<label class="col-sm-4 text-right">&nbsp;</label>
		<div class="col-sm-8">
			<button type="submit" id="storeBtn" class="btn btn-primary btn-sm "><i
						class="fa fa-play-circle"></i> {{ Lang::get('core.sb_save') }} </button>
			<button type="button" onclick="modalClose('edit')" class="btn btn-danger btn-sm"><i
						class="fa fa-remove "></i> {{ Lang::get('core.sb_cancel') }} </button>
		</div>
	</div>
</form>

<script>
	$('.select2').select2();
</script>