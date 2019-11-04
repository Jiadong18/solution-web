@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
</section>

  <div class="content"> 
		<div class="resultData"></div>
		<div class="ajaxLoading"></div>
		<div id="{{ $pageModule }}View"></div>			
		<div id="{{ $pageModule }}Grid"></div>
	</div>	
	<!-- End Content -->  

<script>
$(document).ready(function(){
	reloadData('#{{ $pageModule }}','{{ $pageModule }}/data');	
});	
</script>	
@endsection