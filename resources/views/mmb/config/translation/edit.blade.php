@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>{{ Lang::get('core.translation') }}</h1>
</section>

<div class="content">
	@if(Session::has('message'))
		   {{ Session::get('message') }}
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@include('mmb.config.tab')
<div class="col-md-9">
	<div class="box box-primary ">
		<div class="box-header with-border"> 
			<div class="box-header-tools pull-left" >
{{ Lang::get('core.languagemanager') }}			</div>
		</div>
		<div class="box-body"> 	
			<div class="col-md-12">
				<ul class="nav nav-tabs" >
				@foreach($files as $f)
					@if($f != "." and $f != ".." and $f != 'info.json')
					<li @if($file == $f) class="active" @endif  >
					<a href="{{ URL::to('core/config/translation?edit='.$lang.'&file='.$f)}}">{{ $f }} </a></li>
					@endif
				@endforeach
				</ul>
				<hr />
				{!! Form::open(array('url'=>'core/config/savetranslation/', 'class'=>'form-vertical ')) !!}
					<table class="table table-striped">
						<thead>
							<tr>
								<th> {{ Lang::get('core.phrase') }} </th>
								<th> {{ Lang::get('core.translation') }} </th>

							</tr>
						</thead>
						<tbody>	
							
							<?php foreach($stringLang as $key => $val) : 
								if(!is_array($val)) 
								{
								?>
								<tr>	
									<td><?php echo $key ;?></td>
									<td><input type="text" name="<?php echo $key ;?>" value="<?php echo $val ;?>" class="form-control" />
									
									</td>
								</tr>
								<?php 
								} else {
									foreach($val as $k=>$v)
									{ ?>
										<tr>	
											<td><?php echo $key .' - '.$k ;?></td>
											<td><input type="text" name="<?php echo $key ;?>[<?php echo $k ;?>]" value="<?php echo $v ;?>" class="form-control" />
											
											</td>
										</tr>						
									<?php }
								}
							endforeach; ?>
						</tbody>
						
					</table>
					<input type="hidden" name="lang" value="{{ $lang }}"  />
					<input type="hidden" name="file" value="{{ $file }}"  />
					<button type="submit" class="btn btn-info"> {{ Lang::get('core.savetranslation') }}</button>
				{!! Form::close() !!}
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>
</div>
                  			<div style="clear: both;"></div>


@endsection