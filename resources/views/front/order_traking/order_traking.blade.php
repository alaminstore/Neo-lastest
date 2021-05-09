@extends('front.home')
@section('title','Order Traking - Neo Bazaar')

@section('content')
	<div class="banner-wrapper has_background">
		@foreach ($banner as $bn)
        <img src="{{$bn->image}}"
			 class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
		<div class="banner-wrapper-inner">
			<h1 class="page-title">Order Tracking</h1>
			<div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
				<ul class="trail-items breadcrumb">
					<li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
					<li class="trail-item trail-end active"><span>Order Tracking</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<main class="site-main  main-container no-sidebar">
		<div class="container">
			<div class="row">
				<div class="main-content col-md-12">
					<div class="page-main-content">
						<div class="kreen">
							<form class="track_order" method="post" action="{{route('customer.order_tracking.status')}}">
                                @csrf
								<p>To track your order please enter your Order ID in the box below and press
									the "Track" button. This was given to you on your receipt and in the
									confirmation email you should have received.</p>
								<p class="form-row form-row-first"><label for="orderid">Order ID</label>
									<input class="input-text" type="text" name="order_id" id="orderid"
										   value="" placeholder="Found in your order Status..." required>
                                </p>
								<div class="clear"></div>
								<p class="form-row">
									<button style="cursor: pointer;" type="submit" class="button" name="track" value="Track">Track</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
