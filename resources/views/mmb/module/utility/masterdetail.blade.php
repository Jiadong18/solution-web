
	<div class="box-body">

<div class="table-responsive">
    <table class="table table ">
        <thead>
			<tr>

				<th width="30" style="width: 30px;"></th>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(\App\Library\SiteHelpers::filterColumn($limited ))

							<th align="{{ $t['align'] }} " width="{{ $t['width']}}">{{ \App\Library\SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())) }}</th>
						@endif
					@endif
				@endforeach

			  </tr>
        </thead>

        <tbody>
        <?php $i = 0; ?>
            @foreach ($rowData as $row)
            <?php $ids = ++$i; ?>
                <tr>
					<td width="30"><a href="javascript:void(0)" class="expandable-child-{{ $key }}-{{$id}}" rel="#row-{{ $key }}-{{ $row->{$key} }}"
					data-url=""
					><i class="fa fa-plus-circle  fa-lg text-red" ></i></a></td>

				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(\App\Library\SiteHelpers::filterColumn($limited ))
						 <td>
						 	{!! \App\Library\SiteHelpers::formatRows($row->{$field['field']},$field,$row) !!}
						 </td>
						@endif
					 @endif
				 @endforeach

                </tr>


            <tr style="display:none" class="expanded" id="row-{{ $key }}-{{ $row->{$key} }}">
                	<td></td>
                	<td colspan="{{ $colspan}}" class="data">

                	@if(count($nested_subgrid)>=1)
					  <ul class="nav nav-tabs" role="tablist">
					  	<li role="presentation" class="active"><a href="#home{{ $row->{$key} }}" aria-controls="home" role="tab" data-toggle="tab">{{ $pageTitle}} :   View Detail </a></li>
						@foreach($nested_subgrid as $sub)
							<li role="presentation"><a href="#{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$key} }}" aria-controls="profile" role="tab" data-toggle="tab"
							onclick="loadNestedLookup('{!! url($sub['module']."/lookup/".implode('-',$sub)."-".$row->{$key}) !!}','#{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$key} }}')"
							>{{ $pageTitle}} :   {{ $sub['title'] }}</a></li>
						@endforeach
					  </ul>
                	@endif
                	  <!-- Tab panes -->
				  	<div class="tab-content m-t">
				  		<div role="tabpanel" class="tab-pane active" id="home{{ $row->{$key} }}">
                		<table class="table table-striped">
                			<tbody>
                			 @foreach ($tableGrid as $field)
					 			@if($field['detail'] =='1')
					 			<tr>
					 				<td width="20%"> {{ $field['label']}} </td>
					 				<td> :
						 				{!! \App\Library\SiteHelpers::formatRows($row->{$field['field']},$field,$row) !!}
						 			</td>
						 		</tr>
					 			@endif
					 		@endforeach
					 		</tbody>
                		</table>
                		</div>

				  	@foreach($nested_subgrid as $sub)
				  	<div role="tabpanel" class="tab-pane" id="{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$key} }}" ></div>
				  	@endforeach

                	</td>

                </tr>
            @endforeach

        </tbody>

    </table>
	<input type="hidden" name="md" value="" />
	</div>
	</div>

<script type="text/javascript">
	$(function(){
		<?php for($i=0 ; $i<count($nested_subgrid); $i++)  :?>


				$('#{{ $nested_subgrid[$i]['title']}} a').click(function (e) {
				  e.preventDefault()
				  $(this).tab('show')
				})

		<?php endfor;?>
	})



</script>


<script type="text/javascript">

$('.expandable-child-{{ $key }}-{{$id}}').click(function(){

		var id = $(this).attr('rel');
		//alert(id);
		selector =  id +" .data";
		if($(selector).is(':empty'))
		{
			$(id).show();
			$(this).removeClass('expandable-child-{{ $key }}-{{$id}}'); $(this).addClass('collapseable');

		} else {
			if($(this).hasClass('open'))
			{
				$(this).html('<i class="fa fa-plus-circle fa-lg text-red"></i>');
				$(this).removeClass('open');
				$(id).hide();
			} else {
				$(this).html('<i class="fa fa-minus-circle fa-lg text-red"></i>');
				$(this).addClass('open');

				$(id).show();
			}

		}
	});

</script>
