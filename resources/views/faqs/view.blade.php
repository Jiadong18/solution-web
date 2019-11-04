@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>{{ Lang::get('core.faq') }}</h1>
</section>
	<div class="box-header with-border">
    <div class="box-header-tools pull-left" >
		   		<a href="{{ URL::to('faqs?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
				@if($access['is_add'] ==1)
		   		<a href="{{ URL::to('faqs/update/'.$id.'?return='.$return) }}" class="tips text-green" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{{ url('faqs/section/'.$row->faqID)}}" onclick="MmbModal(this.href,'{{ Lang::get('core.newsection') }}'); return false;" class="tips text-blue" title="{{ Lang::get('core.addnewsection') }}"><i class="fa fa-server fa-2x"></i></a>
                <a href="{{ url('faqs/item/'.$row->faqID.'/0/0')}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.editsection') }}'); return false;"  class="tips text-blue" title="{{ Lang::get('core.addnewquestion') }}"><i class="fa fa-question-circle fa-2x"></i></a>
			@endif
			</div>
    </div>
<div class="col-md-4">
 <div class="box box-primary">
        <div class="box-body">
			<ul class="faqTree">
			@foreach($faqTree as $fs)

				<li><h4>{{ $fs['title'] }}
					@if($access['is_remove'] =='1')
					<a href="{{ url('faqs/sectiondelete/'.$row->faqID.'/'.$fs['sectionID'])}}"  class="sectionDelete tips text-red pull-right" title="{{ Lang::get('core.deletesection') }}"><i class="fa fa-trash-o fa-lg"></i></a>
					@endif
					@if($access['is_edit'] =='1')
					<a href="{{ url('faqs/section/'.$row->faqID.'/'.$fs['sectionID'])}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.editsection') }}'); return false;"  class="tips text-blue  pull-right" title="{{ Lang::get('core.editsection') }}"><i class="fa fa-edit fa-lg"></i></a>
					@endif	</h4>

					<ul>
						@foreach($fs['items'] as $item)
                        <p class="text-muted well well-sm no-shadow">
<a href="?view={{$item->id}}"><i class="fa fa-angle-right fa-lg text-red"></i> {!! $item->question !!}</a>
                        </p>
						@endforeach

					</ul>
					<div class="clear clr"></div>
				</li>
			@endforeach
			</ul>
		</div>
		</div>
		</div>
<div class="col-md-8" id="sidebar">
        <div class="theiaStickySidebar">
    <div class="box box-primary">
          <div class="box-body">
			@if(isset($items) && count($items)>=1)
				<?php $items = $items[0]; ?>
					<div class=" col-md-12 text-right" style="margin: 10px 0; padding-bottom: 10px; border-bottom: dotted 1px #ddd;">
					<a href="{{ url('faqs/item/'.$row->faqID.'/'.$item->sectionID.'/'.$items->id)}}" onclick="MmbModal(this.href,'{{ Lang::get('core.editquestion') }}'); return false;" class="tips text-blue" title="{{ Lang::get('core.editfaq') }}"><i class="fa fa-edit fa-2x"></i></a>
					<a href="{{ url('faqs/itemdelete/'.$row->faqID.'/'.$items->id)}}" class="text-red itemDelete tips" title="{{ Lang::get('core.deletequestion') }}"><i class="fa fa-trash-o fa-2x"></i></a>
					</div>
                    <div class="col-md-12 text-left"><h4> {{ $items->question}} </h4></div>


					<div class="col-md-12" style="min-height: 300px; padding-bottom: 50px;">
						{!! \App\Library\PostHelpers::formatContent( $items->answer ) !!}
					</div>

			@endif

		</div>
		</div>
		</div>
		</div>
	 		<div class="clr clear"></div>

<style type="text/css">
	ul.faqTree { margin: 0; padding: 0; list-style: none;}
	ul.faqTree li {}
	ul.faqTree li h4 {  padding-bottom: 5px; border-bottom: 1px dotted #eee;}
	ul.faqTree li h4 a{ }
	ul.faqTree li ul { margin: 0; padding-top: 0; list-style: none; margin-left: -30px;}
	ul.faqTree li ul li a{ font-size: 13px;}
	.displayItem { font-size: 13px; min-height: 400px; }

</style>
	<script>
		jQuery('#sidebar').theiaStickySidebar({
			additionalMarginTop: 122
		});
	</script>

<script type="text/javascript">
$(function() {
	$('.sectionDelete , .itemDelete').click(function(){
		if(confirm('Are you sure you want to delete this section/item ?'))
		{
			return true
		} else {
			return false;
		}
		return false;
	})
	$('.editItem').click(function(){
		$('.displayItem').hide();
		$('.displayEdit').show();
	});
	$('.closeItem').click(function(){
		$('.displayItem').show();
		$('.displayEdit').hide();
	});
})
</script>

@stop
