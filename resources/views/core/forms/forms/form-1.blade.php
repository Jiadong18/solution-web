{!! Form::open(array('url'=>'home/proccess/1', 'id'=>'formconfiguration','class'=>'form-vertical' ,'files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
@if(Session::has('message'))
		{!! Session::get('message') !!}
@endif

<ul class="parsley-error-list">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

<div class="form-group  " >
					<label for="ipt" class="  "> Name&Surname  </label>
				{!! Form::text('namesurname','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Email  </label>
				{!! Form::text('email','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!}
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Phone  </label>
				{!! Form::text('phone','',array('class'=>'form-control', 'placeholder'=>'',   )) !!}
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Country  </label>
				<select name='country' rows='5' id='country' class='form-control ' required  ></select>
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Tour Name  </label>
                <input type="text" class="form-control" disabled name="tourname" value="{!! \App\Library\SiteHelpers::formatLookUp(app('request')->input('tourID'),'tour_name','1:tours:tourID:tour_name') !!}" required="false">
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Tour Code  </label>
                <input type="text" class="form-control" disabled name="tourcode" value="{!! \App\Library\SiteHelpers::formatLookUp(app('request')->input('tourdateID'),'tour_code','1:tour_date:tourdateID:tour_code') !!}" required="false">

		</div>
		<div class="form-group  " >
					<label for="ipt" class="  "> Tour Date  </label>
                <input type="text" class="form-control" disabled name="tourcode" value="{!! \App\Library\SiteHelpers::formatLookUp(app('request')->input('tourdateID'),'start','1:tour_date:tourdateID:start') !!}" required="false">
		</div>

                <div class="col-md-3 text-sm text-uppercase">Adult  </div>
                <div class="col-md-3 mb-3">
		<div class="input-group input-group-quantity input-group-sm" data-toggle="quantity">
                    <span class="input-group-btn">
                      <input type="button" value="-" class="btn btn-secondary quantity-down" field="adult" />
                    </span>
                   <input type="text" name="adult" value="0" class="quantity form-control" />
                    <span class="input-group-btn">
                      <input type="button" value="+" class="btn btn-secondary quantity-up" field="adult" />
                    </span>
		</div>
		</div>
                <div class="col-md-3 text-sm text-uppercase">Child  </div>
                <div class="col-md-3 mb-3">

        <div class="input-group input-group-quantity input-group-sm" data-toggle="quantity">
                    <span class="input-group-btn">
                      <input type="button" value="-" class="btn btn-secondary quantity-down" field="child" />
                    </span>
                  <input type="text" name="child" value="0" class="quantity form-control" />
                    <span class="input-group-btn">
                      <input type="button" value="+" class="btn btn-secondary quantity-up" field="child" />
                    </span>
		</div>
		</div>

		<div class="form-group  " >
					<label for="ipt" class="  "> Remarks  </label>
				<textarea name='remarks' rows='5' id='remarks' class='form-control '
				           ></textarea>
		</div>


		<div class="form-group col-md-12" >
				<button type="submit" name="submit" class="btn btn-primary"> Submit </button>
		</div>

{!! Form::close() !!}

<div style="clear: both;"></div>
<script type="text/javascript">

		$("#country").jCombo("{!! url('post/comboselect?filter=def_country:country_name:country_name') !!}",
		{  selected_value : '' });

</script>
