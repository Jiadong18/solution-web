@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>{{ $pageTitle }}</h1>
</section>
 <div class="content">
	<div class="box box-default">
	    <div class="box-body">
	    	<?php echo $content ;?>
	    </div>
	</div>

</div>    





@stop