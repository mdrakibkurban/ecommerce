<?php
use App\Models\Product;
?>
@extends('frontend.layouts.app')
@section('title','Checkout Page')
@section('content')
<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Check Out</h3>
	</div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>My Shopping Bag</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>Remove</th>
                        <th>Image</th>
						<th>Size</th>
                        <th>Quantity</th>
						<th>Product Name</th>
                        <th>Price</th>
                        
					</tr>
				</thead>
                @foreach ($collection as $cart)
                @php
					$getAttrDiscountPrice = Product::getAttrDiscountPrice($cart->product_id,$cart->size);
				@endphp
                <tr class="rem1">
                    <td class="invert-closeb">
                        <a href="{{ route('remove',$cart->id)}}">
                        <div class="rem">
                            <div class="close1"> </div>
                        </div>
                        </a>
                        <script>$(document).ready(function(c) {
                            $('.close1').on('click', function(c){
                                $('.rem1').fadeOut('slow', function(c){
                                    $('.rem1').remove();
                                });
                                });	  
                            });
                       </script>
                    </td>
                    <td class="invert-image"><a href="single.html">
                        <img style="width:50px" src="{{asset("/storage/product_featured_images/".$cart->product->featured_image)}}" alt=" " class="img-responsive" /></a>
                    </td>
                    <td class="invert">{{$cart->size}}</td>
                    <td class="invert">
                         <div class="quantity"> 
                            <div class="quantity-select">                           
                                <div class="entry value-minus">&nbsp;</div>
                                <div class="entry value"><span>{{ $cart->quantity }}</span></div>
                                <div class="entry value-plus active">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td class="invert">{{$cart->product->name}}</td>
                    <td class="invert">
                        Tk. {{ $getAttrDiscountPrice['final_price'] * $cart->quantity }}
                    </td>
                </tr>
                @endforeach
					
					
				<!--quantity-->
                <script>
                    $('.value-plus').on('click', function(){
                        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
                        divUpd.text(newVal);
                    });

                    $('.value-minus').on('click', function(){
                        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
                        if(newVal>=1) divUpd.text(newVal);
                    });
                    </script>
                <!--quantity-->		
										
			</table>
		</div>
		<div class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="{{ url('/')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
				</div>
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Shopping basket</h4>
					<ul>
						<li>Hand Bag <i>-</i> <span>$45.99</span></li>
						<li>Watches <i>-</i> <span>$45.99</span></li>
						<li>Sandals <i>-</i> <span>$45.99</span></li>
						<li>Wedges <i>-</i> <span>$45.99</span></li>
						<li>Total <i>-</i> <span>$183.96</span></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>	
<!-- //check out -->
<!-- //product-nav -->
<div class="coupons">
	<div class="container">
		<div class="coupons-grids text-center">
			<div class="col-md-3 coupons-gd">
				<h3>Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<h4>LOGIN TO YOUR ACCOUNT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<h4>SELECT YOUR ITEM</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
				<h4>MAKE PAYMENT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
@endsection