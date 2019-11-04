@extends('layouts.app')

@section('content')
<?php $active='menu'; ?>
<script type="text/javascript" src="{{ asset('mmb/js/jquery.nestable.js') }}"></script>

    <section class="content-header">
      <h1> {{ Lang::get('core.menu') }}</h1>
    </section>

  <div class="content">
	@include('mmb.config.tab')

      <div class="col-sm-4" style="padding-bottom:50px;">

<div class="box box-primary ">
  <div class="box-body">
            <div class="nav-tabs-custom">

	<ul class="nav nav-tabs" style="margin:10px 0;">
		<li @if($active == 'top') class="active" @endif ><a class="btn btn-app" href="{{ URL::to('core/menu?pos=top')}}"><i class="fa fa-arrows-h"></i> {{ Lang::get('core.tab_topmenu') }} </a></li>
		<li @if($active == 'sidebar') class="active" @endif><a class="btn btn-app" href="{{ URL::to('core/menu?pos=sidebar')}}"><i class="fa fa-arrows-v"></i> {{ Lang::get('core.tab_sidemenu') }}</a></li>
<!--
		<li @if($active == 'definitions') class="active" @endif><a class="btn btn-app" href="{{ URL::to('core/menu?pos=definitions')}}"><i class="fa fa-arrows-h"></i> {{ Lang::get('core.definitions') }}</a></li>
-->
	</ul>
            </div>

            <div class="callout callout-info">
            <p> <b>{{ Lang::get('core.t_tipsdrag') }} </b> </p>
            <p> <b>{{ Lang::get('core.t_tipsnote') }}	</b></p>

            </div>


            <div id="list2" class="dd" style="min-height:350px;">
              <ol class="dd-list">
			@foreach ($menus as $menu)
				  <li data-id="{{$menu['menu_id']}}" class="dd-item dd3-item">
					<div class="dd-handle dd3-handle"></div><div class="dd3-content">{{$menu['menu_name']}}
						<span class="pull-right">
						<a href="{{ URL::to('core/menu/index/'.$menu['menu_id'].'?pos='.$active)}}"><i class="fa fa-cog fa-lg fa-spin"></i></a></span>
					</div>
					@if(count($menu['childs']) > 0)
						<ol class="dd-list" style="">
							@foreach ($menu['childs'] as $menu2)
							 <li data-id="{{$menu2['menu_id']}}" class="dd-item dd3-item">
								<div class="dd-handle dd3-handle"></div><div class="dd3-content">{{$menu2['menu_name']}}
									<span class="pull-right">
									<a href="{{ URL::to('core/menu/index/'.$menu2['menu_id'].'?pos='.$active)}}"><i class="fa fa-cog fa-lg"></i></a></span>
								</div>
								@if(count($menu2['childs']) > 0)
								<ol class="dd-list" style="">
									@foreach($menu2['childs'] as $menu3)
									 	<li data-id="{{$menu3['menu_id']}}" class="dd-item dd3-item">
											<div class="dd-handle dd3-handle"></div><div class="dd3-content">{{ $menu3['menu_name'] }}
												<span class="pull-right">
												<a href="{{ URL::to('core/menu/index/'.$menu3['menu_id'].'?pos='.$active)}}"><i class="fa fa-cog fa-lg"></i></a>
												</span>
											</div>
										</li>
									@endforeach
								</ol>
								@endif
							</li>
							@endforeach
						</ol>
					@endif
				</li>
			@endforeach
              </ol>
            </div>
		 {!! Form::open(array('url'=>'core/menu/saveorder/', 'class'=>'form-horizontal','files' => true)) !!}
			<input type="hidden" name="reorder" id="reorder" value="" />

			<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_reorder') }} </button>
		 {!! Form::close() !!}

		</div>



		</div>

		</div>

      <div class="col-sm-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@if($row['menu_id'] =='')
									Create New Menu
								@else
									Edit Current Menu
								@endif</h3>
            </div>

		 {!! Form::open(array('url'=>'core/menu/save/', 'class'=>'form-horizontal','files' => true)) !!}

				<input type="hidden" name="menu_id" id="menu_id" value="{{ $row['menu_id'] }}" />
				  <div class="form-group  ">
					<label for="ipt" class=" control-label col-md-3 text-right">  </label>
					<div class="col-md-8">
		 				<ul class="parsley-error-list">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					 </div>
				  </div>

				<input type="hidden" name="menu_id" id="menu_id" value="{{ $row['menu_id'] }}" />
				  <div class="form-group  " style="display:none;">
					<label for="ipt" class=" control-label col-md-4 text-right"> Parent Id </label>
					<div class="col-md-8">
					  {!! Form::text('parent_id', $row['parent_id'],array('class'=>'form-control', 'placeholder'=>'')) !!}
					 </div>
				  </div>
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-3 text-right">{{ Lang::get('core.fr_mtitle') }}  </label>
					<div class="col-md-8">
					  {!! Form::text('menu_name', $row['menu_name'],array('class'=>'form-control', 'placeholder'=>'')) !!}
					  @if(CNF_MULTILANG ==1)
					    <?php $lang = \App\Library\SiteHelpers::langOption();
						foreach($lang as $l) {
							if($l['folder'] !='en') {
							?>
								<div class="input-group input-group-sm" style="margin:1px 0 !important;">
								 <input name="language_title[<?php echo $l['folder'];?>]" type="text"   class="form-control" placeholder="Title for <?php echo $l['name'];?>"
								 value="<?php echo (isset($menu_lang['title'][$l['folder']]) ? $menu_lang['title'][$l['folder']] : '');?>" />
								<span class="input-group-addon xlick bg-default btn-sm " ><?php echo strtoupper($l['folder']);?></span>
							   </div>
							<?php
							}

						}
					   ?>
					  @endif

					 </div>
				  </div>
				  <div class="form-group   " >
					<label for="ipt" class=" control-label col-md-3 text-right"> {{ Lang::get('core.fr_mtype') }}  </label>
					<div class="col-md-8 menutype">


					<input type="radio" name="menu_type" value="internal" class="minimal-red"
					@if($row['menu_type']=='internal' || $row['menu_type']=='') checked="checked" @endif />

					{{ Lang::get('core.internal') }}

					<input type="radio" name="menu_type" value="external"  class="minimal-red"
					@if($row['menu_type']=='external' ) checked="checked" @endif  /> {{ Lang::get('core.external') }}

					 </div>
				  </div>

				  <div class="form-group  ext-link" >
					<label for="ipt" class=" control-label col-md-3 text-right"> Url  </label>
					<div class="col-md-8">
					   {!! Form::text('url', $row['url'],array('class'=>'form-control', 'placeholder'=>' Type External Url')) !!}
					 </div>
				  </div>

				  <div class="form-group  int-link" >
					<label for="ipt" class=" control-label col-md-3 text-right"> {{ Lang::get('core.t_module') }} </label>
					<div class="col-md-8">
					  <select name='module' rows='5' id='module'  style="width:100%"
							class='form-control '    >

							<option value=""> {{ Lang::get('core.selectmodulepage') }}  </option>
							<option value="separator" @if($row['module']== 'separator' ) selected="selected" @endif> Separator Menu </option>
							<optgroup label="Module ">
							@foreach($modules as $mod)
								<option value="{{ $mod->module_name}}"
								@if($row['module']== $mod->module_name ) selected="selected" @endif
								>{{ $mod->module_title}}</option>
							@endforeach
							</optgroup>
							<optgroup label="Page CMS ">
							@foreach($pages as $page)
								<option value="{{ $page->alias}}"
								@if($row['module']== $page->alias ) selected="selected" @endif
								>Page : {{ $page->title}}</option>
							@endforeach
							</optgroup>
					</select>
					 </div>
				  </div>


				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-3 text-right"> {{ Lang::get('core.fr_mposition') }}  </label>
					<div class="col-md-8">
						<input type="radio" name="position"  value="top" required  class="minimal-red"
						@if($row['position']=='top' ) checked="checked" @endif /> {{ Lang::get('core.tab_topmenu') }}
						<input type="radio" name="position"  value="sidebar"  required class="minimal-red"
						@if($row['position']=='sidebar' ) checked="checked" @endif  /> {{ Lang::get('core.tab_sidemenu') }} 	<!--<input type="radio" name="position"  value="definitions"  required class="minimal-red"
						@if($row['position']=='definitions' ) checked="checked" @endif  /> {{ Lang::get('core.definitions') }}-->
					 </div>
				  </div>
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-3 text-right">{{ Lang::get('core.fr_miconclass') }}  </label>
					<div class="col-md-8">
					  {!! Form::text('menu_icons', $row['menu_icons'],array('class'=>'form-control', 'placeholder'=>'')) !!}
					  <p> {{ Lang::get('core.fr_mexample') }} : <span class="label label-info"> fa fa-desktop </span> </p>
					  <p> View Icon Codes :
            <a href="javascript:void(0)" onclick="MmbModal('{{ url('core/template/icons') }}','FontAwesome Icons')">FontAwesome Icons </a>
					 </div>
				  </div>
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-3 text-right"> {{ Lang::get('core.fr_mactive') }}  </label>
					<div class="col-md-8">
					<input type="radio" name="active"  value="1"  class="minimal-red"
					@if($row['active']=='1' ) checked="checked" @endif /> {{ Lang::get('core.fr_mactive') }}
					<input type="radio" name="active" value="0"  class="minimal-red"
					@if($row['active']=='0' ) checked="checked" @endif  /> {{ Lang::get('core.fr_minactive') }}


					 </div>
				  </div>

			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-3">{{ Lang::get('core.fr_maccess') }}  <code>*</code></label>
				<div class="col-md-8">
						<?php
					$pers = json_decode($row['access_data'],true);
					foreach($groups as $group) {
						$checked = '';
						if(isset($pers[$group->group_id]) && $pers[$group->group_id]=='1')
						{
							$checked= ' checked="checked"';
						}
							?>
				  <label class="checkbox">
				  <input type="checkbox" name="groups[<?php echo $group->group_id;?>]" value="<?php echo $group->group_id;?>" <?php echo $checked;?> class="minimal-red"  />
				  <?php echo $group->name;?>
				  </label>

				  <?php } ?>
						 </div>
			  </div>

				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-3">{{ Lang::get('core.fr_mpublic') }}   </label>
					<div class="col-md-8">
					<label class="checkbox"><input  type='checkbox' name='allow_guest'  class="minimal-red"
 						@if($row['allow_guest'] ==1 ) checked  @endif
					   value="1"	/> Yes  </lable>
					</label>
				  </div>
				</div>

			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_submit') }}  </button>
				@if($row['menu_id'] !='')
					<button type="button"onclick="MmbConfirmDelete('{{ url('core/menu/destroy/'.$row['menu_id'].'?pos='.$active)}}')" class="btn btn-danger ">  {{ Lang::get('core.delete') }} </button>
				@endif
				</div>

			  </div>


		 {!! Form::close() !!}
		<div style="clear:both;"></div>
          </div>

        </div>


		<div style="clear:both;"></div>

	</div>




<script>
$(document).ready(function(){
	$('.dd').nestable();
    update_out('#list2',"#reorder");

    $('#list2').on('change', function() {
		var out = $('#list2').nestable('serialize');
		$('#reorder').val(JSON.stringify(out));

    });
		$('.ext-link').hide();

	$('.menutype input:radio').on('ifClicked', function() {
	 	 val = $(this).val();
  			mType(val);

	});

	mType('<?php echo $row['menu_type'];?>');


});

function mType( val )
{
		if(val == 'external') {
			$('.ext-link').show();
			$('.int-link').hide();
		} else {
			$('.ext-link').hide();
			$('.int-link').show();
		}
}


function update_out(selector, sel2){

	var out = $(selector).nestable('serialize');
	$(sel2).val(JSON.stringify(out));

}
</script>
@stop
