{!! Form::open(array('url'=>'core/forms/reorder/'.$row->formID, 'id'=>'formconfiguration')) !!}
<button type="button" onclick="MmbModal('{{ url("core/forms/input/".$row->formID) }}','New Input')" class="btn  btn-warning btn-sm" ><i class="fa fa-list-ul fa-2x"></i> New Field </button> 
<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save fa-2x"></i> Save Order List </button>
<button class="btn btn-info btn-sm" type="button" id="submitRbld"><i class="fa fa-repeat fa-2x"></i>  Generate Form  </button>
<br /><br />
<div class="ajaxLoading"></div>

<div id="formList" style="background: #fff; padding: 20px; border: solid 1px #ddd;">

 
 <?php $i=0; foreach($forms as $form){ ?>
	<?php echo $form; ?>
 <?php } ?>
</div>


{!! Form::close() !!}

 <style type="text/css">
 #formConfig a { font-size: 12px; padding: 2px 5px; background: #f9f9f9; border:solid 1px #999; color: #888 }

 </style>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('input[type="checkbox"],input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_square-red',
			radioClass: 'iradio_square-red',
		});	

		var fixHelperModified = function(e, tr) {
			var $originals = tr.children();
			var $helper = tr.clone();
			$helper.children().each(function(index) {
				$(this).width($originals.eq(index).width())
			});
			return $helper;
			},
			updateIndex = function(e, ui) {
				$('td.index', ui.item.parent()).each(function (i) {
					$(this).html(i + 1);
				});
				$('.reorder', ui.item.parent()).each(function (i) {
					$(this).val(i + 1);
					//alert(i + 1);
				});			
			};
			
		$("#formList").sortable({
			helper: fixHelperModified,
			stop: updateIndex
		});	


		var form = $('#formconfiguration'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley('isValid') == true){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  function() { 
						$('.ajaxLoading').show(); 
						
					},
					success:       function showResponse(data)  {	
						$('.ajaxLoading').hide();
						$.get( '<?php echo url("core/forms/configuration/".$row->formID) ;?>', function( data ) {
						  $( '#formConfig' ).html( data );
						 
						});
					}  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}	
		});		


		$('#submitRbld').click(function(){
			$('.ajaxLoading').show();
			$.get( '<?php echo url("core/forms/rebuild/".$row->formID) ;?>', function( data ) {
			 
			  $('.ajaxLoading').hide();
			 
			});
		});		

 	})

 	function removeField( id , field)
 	{
 		if(confirm('Are you sure deleting this input field  ?'))
 		{
			$('.ajaxLoading').show();
			$.get( '<?php echo url("core/forms/removefield") ;?>/'+id+'/'+field, function( data ) {
			
				$.get( '<?php echo url("core/forms/configuration/") ;?>/'+id, function( data ) {
				  	$( '#formConfig' ).html( data );
				 	$('.ajaxLoading').hide();
				});

			});


 		}	
 		return false;
 	}

 </script>