<ul class="nav nav-tabs" style="margin-bottom:10px;">
  <li><a href="{{ url('mmb/module')}}"><i class="fa fa-tablet fa-lg text-green"></i> All </a></li>
  <li @if($active == 'config') class="active" @endif ><a href="{{ URL::to('mmb/module/config/'.$module_name)}}"><i class="fa fa-info-circle fa-lg text-green"></i> Info</a></li>
  <li @if($active == 'sql') class="active" @endif >
  @if(isset($type) && $type =='generic')

  @else
  <a href="{{ URL::to('mmb/module/sql/'.$module_name)}}"><i class="fa fa-database fa-lg text-green"></i> SQL</a></li>
  <li @if($active == 'table') class="active" @endif >
  <a href="{{ URL::to('mmb/module/table/'.$module_name)}}"><i class="fa fa-th fa-lg text-green"></i> Table</a></li>
  <li @if($active == 'form' or $active == 'subform') class="active" @endif >
  <a href="{{ URL::to('mmb/module/form/'.$module_name)}}"><i class="fa fa-list fa-lg text-green"></i> Form</a></li>
  <li @if($active == 'sub'  ) class="active" @endif >
  <a href="{{ URL::to('mmb/module/sub/'.$module_name)}}"><i class="fa fa-indent fa-lg text-green"></i> Master Detail</a></li>
  @endif
  <li @if($active == 'permission') class="active" @endif >
  <a href="{{ URL::to('mmb/module/permission/'.$module_name)}}"><i class="fa  fa-lock fa-lg text-green"></i> Permission</a></li>
  @if($type !='core' )
  <li @if($active == 'source') class="active" @endif >
  <a href="{{ URL::to('mmb/module/source/'.$module_name)}}"><i class="fa fa-code fa-lg text-green"></i> Codes </a></li>
  @endif
   <li @if($active == 'rebuild') class="active" @endif >

    @if(isset($type) && $type =='generic')

    @else
   <a href="javascript://ajax" onclick="MmbModal('{{ URL::to('mmb/module/build/'.$module_name)}}','Rebuild Module ')"><i class="fa fa-refresh fa-lg text-green"></i> Rebuild</a></li>
   @endif
    <li class="dropdown pull-right">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-superpowers fa-lg text-green" aria-hidden="true"></i>
 Swith
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <?php $md = DB::table('tb_module')->where('module_type','!=','core')->orderBy('module_title','ASC')->get();
      foreach($md as $m) { ?>
      <li><a href="{{ url('mmb/module/'.$active.'/'.$m->module_name)}}"> {{ $m->module_title}}</a></li>
      <?php } ?>
    </ul>
  </li>  
</ul>