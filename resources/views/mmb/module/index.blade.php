@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1>
        Module Management
      </h1>
    </section>

  <div class="content">
	<div class="box box-primary">
      <div class="box-body">
<ul class="nav nav-tabs" style="margin-bottom:10px;">
    <li class="dropdown pull-left active">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-superpowers fa-lg text-green" aria-hidden="true"></i>
 Module List
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <?php $md = DB::table('tb_module')->where('module_type','!=','core')->orderBy('module_title','ASC')->get();
      foreach($md as $m) { ?>
      <li><a href="{{ url('mmb/module/permission/'.$m->module_name)}}"> {{ $m->module_title}}</a></li>
      <?php } ?>
    </ul>
  </li>  
</ul>
 <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green" onclick="$('.unziped').toggle()">
            <span class="info-box-icon"><i class="fa fa-folder-open"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ Lang::get('core.btn_install') }} Module</span>
              <span class="info-box-number">Data</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                   {{ Lang::get('core.fr_installmodule') }} 
                  </span>
            </div>
          </div>
        </div>
      </div>


	@if(Session::has('message'))
		   {{ Session::get('message') }}
	@endif	
      <div class="white-bg p-sm m-b unziped" style=" border:solid 1px #ddd; display:none; padding: 10px 5px 30px">
	   {!! Form::open(array('url'=>'mmb/module/install/', 'class'=>'breadcrumb-search','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
		<h3>Select File ( Module zip installer ) </h3>
        <p>  <input type="file" name="installer" required style="float:left;">  <button type="submit" class="btn btn-primary btn-xs" style="float:left;"  ><i class="icon-upload"></i> Install</button></p>
        </form>
		<div class="clr"></div>
      </div>



</div>
</div>
</div>
<style type="text/css">
	.info-box {cursor: pointer;}
    .dropdown-menu {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
  <script language='javascript' >
  jQuery(document).ready(function($){
    $('.post_url').click(function(e){
      e.preventDefault();
      if( ( $('.ids',$('#MmbTable')).is(':checked') )==false ){
        alert( $(this).attr('data-title') + " not selected");
        return false;
      }
      $('#MmbTable').attr({'action' : $(this).attr('href') }).submit();
    });


  })
  </script>	 

@stop