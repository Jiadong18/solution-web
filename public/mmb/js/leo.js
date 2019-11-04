jQuery(document).ready(function($){
    $('.sidebar-menu li ul li.active').parents('li').addClass('active');
    $('.clearCache').click(function(){
    $('.pageLoading').show();
          var url = $(this).attr('href');
    $.get( url  , function( data ) {
    $('.pageLoading').hide();
             notyMessage(data.message); 
                 
          });
          return false;
      }); 
   
	$('.date').datetimepicker({format: 'yyyy-mm-dd', autoclose:true , minView:2 , startView:2 , todayBtn:true }); 
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii', autoclose:true , todayBtn:true }); 

    $('input[type="checkbox"],input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_square-red',
			radioClass: 'iradio_square-red',
		});	
	$('.checkall').on('ifChecked',function(){
			$('input[type="checkbox"]').iCheck('check');
		});
	$('.checkall').on('ifUnchecked',function(){
	$('input[type="checkbox"]').iCheck('uncheck');
		});	
    $('.tips').tooltip();	
 	$('.editor').summernote();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass: 'iradio_flat-green'
	    });

    //Red color scheme for iCheck
    $('input[type="checkbox"].square-red, input[type="radio"].square-red').iCheck({
	      checkboxClass: 'icheckbox_square-red-red',
	      radioClass: 'iradio_square-red'
	    });    	


	$('.previewImage').fancybox();	
	$(".select2").select2({ width:"100%"});	
	$('.panel-trigger').click(function(e){
		e.preventDefault();
		$(this).toggleClass('active');
	});
	$('.popup').click(function (e) {
		e.stopPropagation();
	});	
     window.prettyPrint && prettyPrint();
	$(".checkall").click(function() {
		var cblist = $(".ids");
		if($(this).is(":checked"))
		{				
			cblist.prop("checked", !cblist.is(":checked"));
		} else {	
			cblist.removeAttr("checked");
		}	
	});
	


	$('.removeCurrentFiles').on('click',function(){
		var removeUrl = $(this).attr('href');
		$.get(removeUrl,function(response){
			if(response.status == 'success')
			{
				
			}
		});
		$(this).parent('div').empty();	
		return false;
	});	

	$('.dropdown, .btn-group').on('show.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
	});
	$('.dropdown, .btn-group').on('hide.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
	});	
		    	
})

function addMoreFiles(id){

   $("."+id+"Upl").append('<input type="file" name="'+id+'[]" />')
}

function MmbConfirmDelete( url )
{
	if(confirm('do you really want to delete this?'))
	{
		window.location.href = url;	
	}
	return false;
}
function MmbDelete(  )
{	
	var total = $('input[class="ids"]:checkbox:checked').length;
			$('#MmbTable').submit();
}	
function MmbModal( url , title)
{
	$('#mmb-modal-content').html(' ....Loading content , please wait ...');
	$('.modal-title').html(title);
	$('#mmb-modal-content').load(url,function(){
	});
	$('#mmb-modal').modal('show');	
}

function notyMessage(message)
{

	toastr.success("success", message);
	toastr.options = {
		  "closeButton": true,
		  "debug": false,
          "progressBar": false,
		  "positionClass": "toast-top-center",
		  "onclick": null,
		  "showDuration": "200",
		  "hideDuration": "1000",
		  "timeOut": "3000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "slideDown",
		  "hideMethod": "fadeOut"

	}	
	
}
function notyMessageError(message)
{
	
	toastr.error("error", message);
	toastr.options = {
		  "closeButton": true,
		  "debug": false,
          "progressBar": false,
		  "positionClass": "toast-top-center",
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "3000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "slideDown",
		  "hideMethod": "fadeOut"

	}	
	
}
;(function ($, window, document, undefined) {

    var pluginName = "sximMenu",
        defaults = {
            toggle: true
        };

    function Plugin(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function () {

            var $this = $(this.element),
                $toggle = this.settings.toggle;

            $this.find('li.active').has('ul').children('ul').addClass('collapse in');
            $this.find('li').not('.active').has('ul').children('ul').addClass('collapse');

            $this.find('li').has('ul').children('a').on('click', function (e) {
                e.preventDefault();

                $(this).parent('li').toggleClass('active').children('ul').collapse('toggle');

                if ($toggle) {
                    $(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
                }
            });
        }
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);
