@extends('layouts.app')

@section('content')
<section class="content-header">
      <h1>{{ Lang::get('core.formsettings') }} </h1>
    </section>
<div class="content">
    <div class="box box-primary">
    <div class="box-header with-border">
            <div class="box-header-tools pull-left">
	   		<a href="{{ url('core/forms?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('core/forms/update/'.$id.'?return='.$return) }}" class="tips text-green" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif 
					
		</div>	

            <div class="box-header-tools pull-right">
			<a href="{{ ($prevnext['prev'] != '' ? url('core/forms/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips"><i class="fa fa-arrow-left fa-2x"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('core/forms/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>


	</div>
        <div class="box-body">
    <div class="col-md-4 table-responsive">
        <table class="table table-striped table-bordered ">
			<tbody>	
					<tr>
						<td width='30%' class='label-view text-right'>Name:</td>
						<td>{{ $row->name}} </td>
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Method:</td>
						<td>{{ $row->method}} </td>
						
					</tr>
				@if ($row->method == 'table')
					<tr>
						<td width='30%' class='label-view text-right'>Tablename:</td>
						<td>{{ $row->tablename}} </td>
						
					</tr>
                @else
					<tr>
						<td width='30%' class='label-view text-right'>Send To Email :</td>
						<td>{{ $row->email}} </td>
						
					</tr>					
				@endif
					<tr>
						<td width='30%' class='label-view text-right'>Success Note:</td>
						<td>{{ $row->success}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Failed Note</td>
						<td>{{ $row->failed}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Redirect URL</td>
						<td>{{ $row->redirect}} </td>
						
					</tr>
				
			</tbody>	
		</table>   
        </div>
    <div class="col-md-8">

		<div  style="background: #e9e9e9; min-height: 600px; border: solid 1px #ddd;padding: 20px;" > 			
				<div style=" border:solid 1px #ddd; background: #fff;" id="formConfig">
					<div style="padding: 20px;"> 
					 @include('core.forms.forms.form-'.$row->formID)
					</div>
				</div>
		</div>		 
	
	
	</div>
</div>	
</div>	
</div>						<div style="clear:both"></div>	  

	  
@stop