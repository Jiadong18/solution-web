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
		<div class="box-body">
	 	{!! Form::open(array('url'=>'core/config/translation/', 'class'=>'form-vertical row')) !!}
			<div class="col-sm-9">
				<a href="{{ URL::to('core/config/addtranslation')}} " onclick="MmbModal(this.href,'{{ Lang::get('core.addnewlanguage') }}');return false;" class="btn btn-primary"><i class="fa fa-plus-circle fa-2x"></i> {{ Lang::get('core.addnewtranslation') }} </a>
				<hr />
				<table class="table table-striped">
					<thead>
						<tr>
							<th> {{ Lang::get('core.languagename') }} </th>
							<th> {{ Lang::get('core.folder') }} </th>
							<th> {{ Lang::get('core.author') }} </th>
							<th> {{ Lang::get('core.action') }} </th>
						</tr>
					</thead>
					<tbody>

					@foreach(\App\Library\SiteHelpers::langOption() as $lang)
						<tr>
							<td>  {{  $lang['name'] }}   </td>
							<td> {{  $lang['folder'] }} </td>
							<td> {{  $lang['author'] }} </td>
						  	<td>
							<a href="{{ URL::to('core/config/translation?edit='.$lang['folder'])}} " class="tips" title="Edit"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>
                            @if($lang['folder'] !='en')
							<a href="{{ URL::to('core/config/removetranslation/'.$lang['folder'])}} " class="text-red" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i>
  </a>
							@endif

						</td>
						</tr>
					@endforeach

					</tbody>
				</table>
			</div>

 		{!! Form::close() !!}


		</div>
	</div>
</div>
</div>
        <div class="clr clear"></div>

<script>
        $(function() {
         $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });

            $('.editItem').click(function() {
                $('.displayItem').hide();
                $('.displayEdit').show();
            });
            $('.closeItem').click(function() {
                $('.displayItem').show();
                $('.displayEdit').hide();
            });
        })

</script>

@endsection
