@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1>{{Lang::get('core.invoices')}}</h1>
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
        @if ( \DB::table('bookings')->where('travellerID','=',app('request')->input('travellerID'))->count() ==0 && app('request')->input('travellerID') !='' )
        <div class="alert alert-danger alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="fa fa-warning fa-2x"></i> {{ Lang::get('core.alert') }}</h4>
                        {{ Lang::get('core.alertbooking') }}       
        </div>
        @endif

		 {!! Form::open(array('url'=>'invoice/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
				{!! Form::hidden('invoiceID', $row['invoiceID']) !!}					
									  <div class="form-group  " >
										<label for="Travellers" class=" control-label col-md-4 text-left"> {{Lang::get('core.travellers')}} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='travellerID' rows='5' id='travellerID' class='select2 ' 
                                                  required  ></select> 
										 </div> 
										 <div class="col-md-4">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Booking ID" class=" control-label col-md-4 text-left"> {{Lang::get('core.bookingno')}}<span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='bookingID' rows='5' id='bookingID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-4">
										 	
										 </div>
									  </div> 
                                    <div class="form-group  " >
										<label for="Date Issued" class=" control-label col-md-4 text-left"> {{Lang::get('core.dateissued')}}<span class="asterix"> * </span></label>
										<div class="col-md-2">
										  
				<div class="input-group m-b">
					{!! Form::text('DateIssued', $row['DateIssued'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
				</div> 
										 </div> 
										<label for="Due Date" class=" control-label col-md-2 text-left"> {{Lang::get('core.duedate')}} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  
				<div class="input-group m-b">
					{!! Form::text('DueDate', $row['DueDate'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div>
    <div class="form-group  " >
										<label for="Accepted Payment Types" class=" control-label col-md-4 text-left">{{Lang::get('core.acceptedpayments')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='payment_type[]' multiple rows='5' id='payment_type' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 
									   					
									   					
    <div class="table-responsive " style="padding: 20px; ">
		<table class="table table-striped ">
			<thead>
				<tr>
					<th width="150">{{Lang::get('core.productcode')}}</th>
					<th>{{Lang::get('core.product')}}</th>
					<th width="70"> {{Lang::get('core.qty')}} </th>
					<th width="70"> {{Lang::get('core.price')}}  </th>
					<th width="70"> {{Lang::get('core.total')}} </th>
					<th width="20"> </th>
				</tr>
			</thead>
			<tbody>
			@if($row['invoiceID'] == '')
				<tr class="clone clonedInput">
					<td><input type="text" class="form-control" name="Code[]" placeholder="{{Lang::get('core.productcode')}}" required="false"></td>
					<td><input type="text" class="form-control" name="Items[]" placeholder="{{Lang::get('core.itemname')}} " required="true"></td>
					<td><input type="text" class="form-control" style="width: 70px;" required="true" name="Qty[]"></td>
					<td><input type="text" class="form-control" style="width: 70px;" required="true" name="Amount[]"></td>
					<td><input type="text" class="form-control" style="width: 120px;" readonly="1" name="Total[]" > </td>
					<td><a onclick=" $(this).parents('.clonedInput').remove(); calculateSum(); return false" href="javascript:void(0)" class="remove btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i>
</a></td>
				</tr>
			@else	
				@foreach ($items as $child)
				<tr class="clone clonedInput">
					<td><input type="text" class="form-control" name="Code[]" placeholder="{{Lang::get('core.productcode')}}" required="true" value="{{ $child->Code}}"></td>
					<td><input type="text" class="form-control" name="Items[]" placeholder="{{Lang::get('core.itemname')}}" required="true" value="{{ $child->Items}}"></td>
					<td><input type="text" class="form-control" style="width: 70px;" required="true" name="Qty[]" value="{{ $child->Qty}}"></td>
					<td><input type="text" class="form-control" style="width: 70px;" required="true" name="Amount[]" value="{{ $child->Amount}}"></td>
					<td><input type="text" class="form-control" style="width: 120px;" readonly="1" name="Total[]" value="{{ $child->Qty * $child->Amount }}"> </td>
					<td><a onclick=" $(this).parents('.clonedInput').remove(); calculateSum(); return false" href="javascript:void(0)" class="remove btn btn-xs btn-danger tips" title="{{Lang::get('core.btn_remove')}}"><i class="fa fa-times" aria-hidden="true"></i>
</a>
				 	<input type="hidden" name="counter[]">
					</td>
				</tr>
				@endforeach
			@endif	
				<tr>
					<td colspan="3">
						<a href="javascript:void(0)" class="addC btn btn-success btn-sm tips" title="{{Lang::get('core.addnewproduct')}}" rel=".clone"> <i class="fa fa-plus"></i></a>
					</td>
					<td>{{Lang::get('core.subtotal')}}</td>
					<td><span id="SubtotalShow"></span><input type="hidden" class="form-control" style="width: 120px;" name="Subtotal"  value="{{ $row['Subtotal'] }}"> 
</td>
					<td></td>
				</tr>							
				<tr>
					<td colspan="3"></td>
					<td>{{Lang::get('core.discount')}}</td>
					<td><input type="text" class="form-control" style="width: 120px;" name="discount" value="{{ $row['discount'] }}" ></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td>{{Lang::get('core.tax')}} (%)</td>
					<td><input type="text" class="form-control" style="width: 120px;" name="tax"  value="{{ $row['tax'] }}"></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td>{{Lang::get('core.total')}} </td>
					<td><span id="InvTotalShow"></span>

					<input type="hidden" class="form-control" style="width: 120px;" name="InvTotal"  value="{{ $row['InvTotal'] }}"> 
										 </td>
					<td width="100"><select name='currency' rows='3' id='currency' class='select2 ' required  ></select></td>
				</tr>
			</tbody>
		</table>
		

		</div>
					
									  <div class="form-group  " >
										<label for="Notes" class=" control-label col-md-4 text-left"> {{Lang::get('core.notes')}} </label>
										<div class="col-md-6">
										  <textarea name='notes' rows='5' id='notes' class='form-control '  
				           >{{ $row['notes'] }}</textarea> 
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
					<button type="button" onclick="location.href='{{ URL::to('invoice?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#travellerID").jCombo("{!! url('invoice/comboselect?filter=travellers:travellerID:nameandsurname') !!}",
		{  selected_value : '@if ( app('request')->input('travellerID') != NULL ) {{app('request')->input('travellerID')}} @else {{ $row["travellerID"] }} @endif' });
		
		$("#bookingID").jCombo("{!! url('invoice/comboselect?filter=bookings:bookingsID:bookingno') !!}&parent=travellerID:",
		{  parent: '#travellerID', selected_value : '{{ $row["bookingID"] }}' });
		
		$("#currency").jCombo("{!! url('invoice/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currency"] }}' });
		
		$("#payment_type").jCombo("{!! url('invoice/comboselect?filter=def_payment_types:paymenttypeID:payment_type') !!}",
		{  selected_value : '{{ $row["payment_type"] }}' });
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("invoice/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});

function calculateSum()
{
	var Subtotal = 0;
	$('table tr.clone ').each(function(i){
		var Qty = $(this).find(" input[name*='Qty']").val();
		var Price = $(this).find("input[name*='Amount']").val();
		var sum = Qty * Price ;
		//alert( Qty +' + '+ Price + ' = '+ sum);
		Subtotal += sum;
	   $(this).find("input[name*='Total']").val(sum);
	})

	$('input[name=Subtotal]').val(Subtotal); 

	var Discount 	= $('input[name=discount]').val(); 
	var Tax 		= $('input[name=tax]').val(); 

	var Total =  ( Subtotal - Discount ) +  (( Subtotal - Discount )*Tax/100)  ;
	$('input[name=InvTotal]').val(Total);
	$('#InvTotalShow').html(Total);
	$('#SubtotalShow').html(Subtotal)
	

}


	$(document).ready(function() { 
		
		$('.addC').relCopy({}); 

		//$("input[name*='Total'] ").attr('readonly','1');
		$("input[name*='Qty'] , input[name*='Amount'] , input[name='discount'] , input[name='tax']").addClass('calculate');

		calculateSum();
		$(".calculate").keyup(function(){ calculateSum();})
		$('.remove').click(function(){ calculateSum()})
		
	});
	</script>

@stop