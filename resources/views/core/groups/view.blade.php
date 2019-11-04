@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1>
       <i class="fa fa-users text-warning"></i>  {{ Lang::get('core.m_groups') }} 
        <small>{{ $pageNote }}</small>
      </h1>
    </section>



 <div class="content">  		   	  
<div class="box box-primary ">
	<div class="box-header with-border"> 
		<div class="box-header-tools pull-left" >
			<a href="{{ url('core/groups?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a> 
		</div>
		<div class="box-header-tools " >
			@if(Session::get('gid') ==1)

			@endif 			
		</div>

	</div>
	<div class="box-body"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>ID</td>
						<td>{{ $row->group_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Description</td>
						<td>{{ $row->description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Level</td>
						<td>{{ $row->level }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	
	</div>
</div>	

</div>
@stop	  
