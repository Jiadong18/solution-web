@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1> Permission Settings <small>{{ $row->module_title }}</small></h1>
    </section>

   <div class="content">	
@if(Session::has('message'))
       {{ Session::get('message') }}
@endif
<div class="box box-primary unziped" style=" display:none; padding: 10px 5px 30px">
	   {!! Form::open(array('url'=>'mmb/module/install/', 'class'=>'breadcrumb-search','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
		<h3>Select File ( Module zip installer ) </h3>
        <p>  <input type="file" name="installer" required style="float:left;">  <button type="submit" class="btn btn-primary btn-xs" style="float:left;"  ><i class="fa fa-upload fa-2x" aria-hidden="true"></i> Install</button></p>
        </form>
		<div class="clr"></div>
      </div>
 {!! Form::open(array('url'=>'mmb/module/savepermission/'.$module_name, 'class'=>'form-horizontal')) !!}

<div class="box box-primary">
	<div class="box-body mdl">	

<ul class="nav nav-tabs" style="margin-bottom:10px;">
    <li class="dropdown pull-left active">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-superpowers fa-2x text-green" aria-hidden="true"></i> 
 Module List
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <?php $md = DB::table('tb_module')->where('module_type','!=','core')->orderBy('module_title','ASC')->get();
      foreach($md as $m) { ?>
      <li><a href="{{ url('mmb/module/permission/'.$m->module_name)}}"> {{ $m->module_title}}</a></li>
      <?php } ?>
    </ul>
  </li>  
        <li class="dropdown pull-left active">
        <a onclick="$('.unziped').toggle()" href="#"  style="cursor: pointer;"><i class="fa fa-upload fa-2x text-green" aria-hidden="true"></i>
 Install New Module</a>
    </li>
</ul>
		
        <table class="table table-striped table-bordered" id="table">
		<thead class="no-border">
  <tr>
	<th field="name1" width="20">No</th>
	<th field="name2">Group </th>
	<?php foreach($tasks as $item=>$val) {?>	
	<th field="name3" data-hide="phone"><?php echo $val;?> </th>
	<?php }?>

  </tr>
</thead>  
<tbody class="no-border-x no-border-y">	
  <?php $i=0; foreach($access as $gp) {?>	
  	<tr>
		<td  width="20"><?php echo ++$i;?>
		<input type="hidden" name="group_id[]" value="<?php echo $gp['group_id'];?>" /></td>
		<td ><?php echo $gp['group_name'];?> </td>
		<?php foreach($tasks as $item=>$val) {?>	
		<td  class="">
		
		<label >
			<input name="<?php echo $item;?>[<?php echo $gp['group_id'];?>]" class="c<?php echo $gp['group_id'];?>" type="checkbox"  value="1"
			<?php if($gp[$item] ==1) echo ' checked="checked" ';?> />
		</label>	
		</td>

		<?php }?>
	</tr>  
	<?php }?>
  </tbody>
</table>	

<button type="submit" class="btn btn-success"> Save Changes </button>	
	
<input name="module_id" type="hidden" id="module_id" value="<?php echo $row->module_id;?>" />
</div>	</div>
 {!! Form::close() !!}	

       

</div>	
<style type="text/css">
    .dropdown-menu {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
   
@stop